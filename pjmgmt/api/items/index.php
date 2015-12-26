<?php
    $base = "../../";
    require_once($base."functions.php");
    $returndata = array();
    header('Content-type: text/html; charset=UTF-8');
    // longitude, latitude or userId
    if((!isset($_POST["longitude"]) || !isset($_POST["latitude"])) && !isset($_POST["userId"])){add_return_data(0, 2, "Longitude and Latitude or userId needed.");}
    $isUserId = false;
    $userId = "";
    $longitude = -450;
    $latitude = -450;
    if(isset($_POST["userId"]) && $_POST["userId"]){$isUserId = true;$userId = $_POST["userId"];}
    if(!$isUserId && isset($_POST["longitude"]) && isset($_POST["latitude"])){$isUserId = false;$longitude = $_POST["longitude"];$latitude=$_POST["latitude"];}
    if(($longitude == -450 || $latitude == -450) && $userId == ""){add_return_data(0, 3,"Longitude and Latitude or userId needed.");}
    $item = new Items();

    if($isUserId){
        $returndata["data"] = $item->getByUserId($userId);
        add_return_data(1, 1,"Success");
    }else{
        $returndata["data"] = $item->getByItemsLocation($longitude=$longitude, $latitude=$latitude, $diff=2.0);
        add_return_data(1, 1,"Success");
    }
?>