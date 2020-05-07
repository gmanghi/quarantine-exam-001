<?php declare(strict_types=1);

namespace Src\Functions;

use Src\Functions\FileHandler;

class APICaller {

    private $data_returned;
    private $data_object;

    public function _api_call($file, $curlopt_array, $env){
       
		$curl = curl_init();
		curl_setopt_array($curl, $curlopt_array);

		$this->data_returned = curl_exec($curl);
		// echo $this->data_returned;
		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// echo 'hhtp_code='.$http_code;
		$err = curl_error($curl);
		
		curl_close($curl);

		if ($err || $http_code != 200) { 
			switch($env){
				case "local":
				case "dev":
				case "staging":
				default:
					$filehandler = new FileHandler($file);
					$this->data_returned = $filehandler->readfile();
					if(!$this->data_returned){
						return false;
					}
				break;

				case 'prod':
					return false;
				break;
			}
		} 
		else {
			$filehandler = new FileHandler($file);
            $filehandler->writefile($this->data_returned);
            // $this->data_object = $this->data_returned;
        }
        
		return true;
    }

    public function getDataObject(){
        return json_decode($this->data_returned);
    }

    public function getDataReturned(){
        return $this->data_returned;
    }
}