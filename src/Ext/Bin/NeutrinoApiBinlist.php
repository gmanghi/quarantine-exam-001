<?php declare(strict_types=1);
namespace Src\Ext\Bin;

use Src\Functions\APICaller;

final class NeutrinoApiBinlist extends APICaller implements iBin{
	
	public function _call($number){
		$postData = array(
			"user-id" => "vecahe6587",
			"api-key" => "GLmEV80Pw5WDJdUHaUU7QLHqA3oFmPTiPTt5XSijuLlRlU6A",
			"bin-number" => $number
		);

		$curlopt_array = array(
			CURLOPT_URL => "https://neutrinoapi.net/bin-lookup",
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => 1
		);

		return $this->_api_call(
			getcwd().'/files/Bin/NeutrinoApiBinlist'.$number.'.txt', 
			$curlopt_array, 
			getenv('ENV')
		);
	}
	
	public function get_country_alpha2(){
		return json_decode($this->getDataReturned(),true)['country-code'];
	}
	
}