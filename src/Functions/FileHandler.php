<?php declare(strict_types=1);

namespace Src\Functions;

class FileHandler {
    private $file;
    public function __construct($file){
        $this->file = $file;
    }

    public function readfile(){
        if ( !file_exists($this->file) ) {
            throw new \Exception('File not found.');
        }

        $handle = fopen($this->file, "r");
        if(!$handle){
            throw new \Exception('File open failed.');
        }

        $contents = fread($handle, filesize($this->file));      
        
        fclose($handle);
        
        return $contents;
    } 

    public function writefile($content){
        $handle = fopen($this->file, "c+");

        if(!$handle){
            throw new \Exception('File error.');
        }

        fwrite($handle, $content);

        fclose($handle);

        return $content;
    }
}
