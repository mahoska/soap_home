<?php
    include('libs/Curl.php');

    $error = "";
    $teams = [];
    try{
        $curl = new Curl();
        $teams = $curl->sendRequest()->getResponceInfo();

    }catch(Exception $err){
         $error =  $err->getMessage();
    }

    include("templates/index.php");
?>

