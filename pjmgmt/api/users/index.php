<?php
    $base = "../../";
    require_once($base."functions.php");
    $returndata = array();
    header('Content-type: text/html; charset=UTF-8');
    // longitude, latitude
    if((!isset($_POST["longitude"]) || !isset($_POST["latitude"]))){add_return_data(0, 2, "Longitude and Latitude needed.");}
    $longitude = -450;
    $latitude = -450;
    if(isset($_POST["longitude"]) && isset($_POST["latitude"])){$longitude = $_POST["longitude"];$latitude=$_POST["latitude"];}
    $item = new Users();

    $returndata["data"] = $item->getUsersByLocation($longitude, $latitude);
    add_return_data(1, 1,"Success");

?>