<?php
    include('libs/Curl.php');

    $error = "";
    $valutes = [];
    $search = isset($_POST['data']) ? $_POST['data'] : "";
    if($search == "") $error = "Enter date";
    else{
        try{
            $curl = new Curl($search);
            $valutes = $curl->sendRequest()->getResponceInfo();

        }catch(Exception $err){
             $error =  $err->getMessage();
        }
    }
    include("templates/index.php");
?>

