<?php
    $base = "../../";
    require_once($base."functions.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    if(!isset($_POST["userId"])){add_return_data(0, 2, "user Id is required.");}
    if(!$_POST["userId"]){add_return_data(0, 3, "user Id is required.");}
    $userId = $_POST["userId"];
    $user = new Useres();
    $item = $user->getUserById($uid, $hash, $userId);
    if($item == -1){add_return_data(0, 4, "Fatal Error");}
    $returndata["data"] = $item;
    add_return_data(1, 1, "Success");
?>