<?php declare(strict_types=1);
namespace Src\Modules;

final class Commissions {
	
	private $data;
	private $bin;
	private $exchange;
	private $is_production;
	private $countries = array("AT","BE","BG","CY","CZ","DE","DK","EE","ES","FI","FR","GR","HR","HU","IE","IT","LT","LU","LV","MT","NL","PO","PT","RO","SE","SI","SK");
	
	public function __construct($params, $bin, $exchange){
		$this->ensureParameters($params);
		$this->bin = $bin;
		$this->exchange = $exchange;
	}
	
	public function calculate(){	
		if(!$this->bin->_call($this->data->bin)) throw new \Exception("Bin Request Failed!");
		$isEu = false;
		
		if(in_array($this->bin->get_country_alpha2(), $this->countries)){
			$isEu = true;
		}
		
		if(!$this->exchange->_call()) throw new \Exception("Exchange Request Failed!");
		$rate = $this->exchange->get_rate($this->data->currency);

		if ($this->data->currency == 'EUR' or $rate == 0) {
			$amntFixed = $this->data->amount;
		}
		
		if ($this->data->currency != 'EUR' or $rate > 0) {
			$amntFixed = $this->data->amount / $rate;
		}
		return round(ceil($amntFixed * ($isEu ? 0.01 : 0.02)*1000)/1000,2);
	}
	
	private function ensureParameters($params){
		if(!$json = json_decode($params)){
			throw new \InvalidArgumentException('JSON incorrect format');
		}
		
		if(!property_exists($json, 'bin')){
			throw new \InvalidArgumentException('Property "bin" missing');
		}
		
		if (!filter_var($json->bin, FILTER_VALIDATE_INT)) {
			throw new \InvalidArgumentException('Invalid "bin" value');
		}
		
		if(!property_exists($json, 'amount')){
			throw new \InvalidArgumentException('Property "amount" missing');
		}
		
		if(!preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $json->amount)){
			throw new \InvalidArgumentException('Invalid "amount" value');
		}
		
		if(!property_exists($json, 'currency')){
			throw new \InvalidArgumentException('Property "currency" missing');
		}
		
		if(!preg_match('/^[A-Z]{3}$/', $json->currency)){
			throw new \InvalidArgumentException('Invalid "currency" value');
		}
		
		$this->data = $json;
		return true;
		
	}
	
}

