<?php
namespace Src\Ext\Bin;

final class RapidApiBinlist implements iBin{
	
	private $number;
	private $data_returned;
	private $data_object;
	
	public function _call($number){
		$this->number = $number;
        
		// Requests are throttled at 10 per minute with a burst allowance of 10. If you hit the speed limit the service will return a 429 http status code.
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://binlist.p.rapidapi.com/json/".$this->number,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"x-rapidapi-host: binlist.p.rapidapi.com",
				"x-rapidapi-key: 5505261545msh671e81c85cf34dep1df0f1jsnee3f2a3968ce"
			),
		));

		$this->data_returned = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return false;
		} else {
			$this->data_object = json_decode($this->data_returned);
		}
		
		return true;
	}
	
	public function get_country_alpha2(){
		return $this->data_object->country_code;
	}
	
}