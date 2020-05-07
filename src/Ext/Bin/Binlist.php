<?php declare(strict_types=1);
namespace Src\Ext\Bin;

use Src\Functions\APICaller;

final class Binlist extends APICaller implements iBin{
	
	public function _call($number){

		$curlopt_array = array(
			CURLOPT_URL => "https://lookup.binlist.net/".$number,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
		);

		return $this->_api_call(
			getcwd().'/files/Bin/Binlist_'.$number.'.txt', 
			$curlopt_array, 
			getenv('ENV')
		);
	}
	
	public function get_country_alpha2(){
		return $this->getDataObject()->country->alpha2;
	}
	
}