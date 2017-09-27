<?php
    $error = "";
    $client = new 
        SoapClient("http://footballpool.dataaccess.eu/data/info.wso?WSDL");
    try
    {
        $teams = $client->Teams()->TeamsResult->tTeamInfo;
    }catch(SoapFault $exception){
        $error =  $exception;
    }
    

 include("templates/index.php");



