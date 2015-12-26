<?php
    $base = "../../../";
    require_once($base."functions.php");
    $returndata = array();
    header('Content-type: text/html; charset=UTF-8');
    // longitude, latitude or userId
    if(!isset($_POST["q"])){add_return_data(0, 2, "query needed.");}
    $q = $_POST["q"];
    if(!$q){add_return_data(0, 3, "query is needed");}

    $item = new Users();
    $data = $item->getUsersBySearch($q);
    if(!$data){
        add_return_data(0, 4, "Fatal Error");
    }
    $returndata["data"] = $data;
    add_return_data(1, 1,"Success");

?>