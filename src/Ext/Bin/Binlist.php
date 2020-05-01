<?php
namespace Src\Ext\Bin;

final class Binlist implements iBin{
	
	private $number;
	private $data_returned;
	private $data_object;
	
	public function _call($number){
		$this->number = $number;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://lookup.binlist.net/".$this->number,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
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
		return $this->data_object->country->alpha2;
	}
	
}