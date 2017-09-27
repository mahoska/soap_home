<?php

define('ERROR_CURL','Website not available');

class Curl
{
    private $response;
    private $ch;
    private $dataSearch;
    
     public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt( $this->ch, 
                     CURLOPT_URL, 
                     "http://footballpool.dataaccess.eu/data/info.wso?WSDL"
                    );
        
        $this->dataSearch = [];
    }

    public function __destruct()
    {
	curl_close($this->ch);
    }
    
    public function sendRequest()
    {
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
            <soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                <soap12:Body>
                    <Teams xmlns="http://footballpool.dataaccess.eu">
                    </Teams>
                </soap12:Body>
            </soap12:Envelope>';
        
        $headers = [
            "POST /data/info.wso HTTP/1.1",
            "Host: footballpool.dataaccess.eu",
            "Content-Type: application/soap+xml; charset=utf-8",
            "Content-Length:".strlen($xml_post_string)
            ];
        
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

        //converting
        $this->response = curl_exec($this->ch); 
        if (!$this->response)
            throw new Exception(ERROR_CURL);

        return $this;   
    }
    

    public function getResponceInfo()
    {
       $response1 = str_replace("<soap:Body>","",$this->response);      
       $response2 = str_replace("</soap:Body>","",$response1); 
       $this->response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response2); 
       $parser =simplexml_load_string($this->response);
        if (!$parser) {
           throw new Exception("Error download XML");
        }

        $this->dataSearch = $parser->mTeamsResponse->mTeamsResult->mtTeamInfo ;
        return $this->dataSearch;
    }
   
}



