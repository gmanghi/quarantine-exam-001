<?php
namespace Src\Ext\Exchange;

final class ExchangeRatesApi2 implements iExchange{
	
	private $data_returned;
	private $data_object;
	
	protected $api_key = '36d13602145aa9137dfec0ab';
	
	public function _call(){	
		$ch = curl_init('https://prime.exchangerate-api.com/v5/'.$this->api_key.'/latest/EUR');
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
		return $this->data_object->conversion_rates->{$currency} ?? 0;
	}
	
}