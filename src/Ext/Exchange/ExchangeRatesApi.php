<?php declare(strict_types=1);
namespace Src\Ext\Exchange;

use Src\Functions\APICaller;

final class ExchangeRatesApi extends APICaller implements iExchange{
	
	public function _call(){

		$curlopt_array = array(
			CURLOPT_URL => "https://api.exchangeratesapi.io/latest",
			CURLOPT_RETURNTRANSFER => true
		);

		return $this->_api_call(
			getcwd().'/files/ExchangeRates/ExchangeRatesApi.txt',
			$curlopt_array, 
			getenv('ENV')
		);

	}
	
	public function get_rate($currency){
		return $this->getDataObject()->rates->{$currency} ?? 0;
	}
	
}