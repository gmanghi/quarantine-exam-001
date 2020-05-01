<?php
namespace Src\Ext\Bin;

final class NeutrinoApiBinlist implements iBin{
	
	private $number;
	private $data_returned;
	private $data_object;
	
	public function _call($number){
		$this->number = $number;
		
		$postData = array(
			"user-id" => "android.gmanghi",
			"api-key" => "xy4OukSaTlTRF8ZYxNNEF6F30jSeW4xNZitL6MWTIfFAedCS",
			"ip" => "162.209.104.195"
		);
		
		$ch = curl_init("https://neutrinoapi.net/ip-info");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$this->data_returned = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if ($err) {
			return false;
		} else {
			$this->data_object = json_decode($this->data_returned, true);
		}
		
		return true;
	}
	
	public function get_country_alpha2(){
		return $this->data_object['country-code'];
	}
	
}