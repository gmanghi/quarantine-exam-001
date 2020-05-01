<?php
namespace Src\Ext\Exchange;

final class ExchangeRatesApi implements iExchange{
	
	private $data_returned;
	private $data_object;
	
	public function _call(){
		$ch = curl_init("https://api.exchangeratesapi.io/latest");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$this->data_returned = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if ($err) {
			return false;
		} else {
			$this->data_object = json_decode($this->data_returned);
		}		
		return true;
	}
	
	public function get_rate($currency){
		return $this->data_object->rates->{$currency} ?? 0;
	}
	
}