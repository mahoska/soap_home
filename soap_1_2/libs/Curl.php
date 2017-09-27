<?php

define('ERROR_CURL','Website not available');

class Curl
{
    private $response;
    private $ch;
    private $data;
    private $dataSearch;
    
     public function __construct($search)
    {
        $this->data = $this->setCheck($search);
        $this->ch = curl_init();
        curl_setopt( $this->ch, 
                     CURLOPT_URL, 
                     "https://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL"
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
            <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                             xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                            xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                <soap12:Body>
                  <GetCursOnDate xmlns="http://web.cbr.ru/">
                        <On_date>'.$this->data.'</On_date>
                 </GetCursOnDate>
                </soap12:Body>
            </soap12:Envelope>';
        
        $headers = [
               "POST /DailyInfoWebServ/DailyInfo.asmx HTTP/1.1",
                "Host: www.cbr.ru",
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

        $this->response = curl_exec($this->ch); 
        if (!$this->response)
            throw new Exception(ERROR_CURL);

        return $this;   
    }
    

    public function getResponceInfo()
    {
        $response1 = str_replace("<soap:Body>","",$this->response);      
        $response2 = str_replace("</soap:Body>","",$response1); 
        $response3=str_replace('diffgr:','',$response2);
        $parser =simplexml_load_string($response3);
        if (!$parser) {
           throw new Exception("Error download XML");
        }

        $this->dataSearch = $parser->GetCursOnDateResponse->GetCursOnDateResult->diffgram->ValuteData->ValuteCursOnDate;
       
        return $this->dataSearch;
    }
    
    public function setCheck($search)
    {
        $search = htmlspecialchars($search);
        return $search;
    }
   
    
}



