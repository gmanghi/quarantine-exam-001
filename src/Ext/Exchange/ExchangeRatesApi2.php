<?php declare(strict_types=1);
namespace Src\Ext\Exchange;

use Src\Functions\APICaller;

final class ExchangeRatesApi2 extends APICaller implements iExchange{
	
	protected $api_key = '36d13602145aa9137dfec0ab';
	
	public function _call(){	

		$curlopt_array = array(
			CURLOPT_URL => "https://prime.exchangerate-api.com/v5/".$this->api_key."/latest/EUR",
			CURLOPT_RETURNTRANSFER => true
		);

		return $this->_api_call(
			getcwd().'/files/ExchangeRates/ExchangeRatesApi2.txt',
			$curlopt_array, 
			getenv('ENV')
		);
	}
	
	public function get_rate($currency){
		return $this->getDataObject()->conversion_rates->{$currency} ?? 0;
	}
	
}