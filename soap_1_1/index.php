<?php

    $error = "";
    $valutes = "";
    $search = isset($_POST['data']) ? $_POST['data'] : "";
    $search = htmlspecialchars($search);

    $client = new 
        SoapClient("https://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");
    try
    {
        date_default_timezone_set('Europe/Kiev');
        $search = $search!="" ? $search:date("Y-m-d");
        $param["On_date"]= $search;
        $res = $client->GetCursOnDate($param)->GetCursOnDateResult->any;
        $data = new SimpleXMLElement($res);
        $valutes = $data->ValuteData->ValuteCursOnDate;
    }catch(SoapFault $exception){
        $error =  $exception;
    }
    

 include("templates/index.php");



