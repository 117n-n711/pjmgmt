<?php
    $base = "../../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);

    //uid, ruid, hash, message
    if(!isset($_POST["ruid"]) && !isset($_POST["message"])){add_return_data(0, 5,"ruid and message are must.");}
    if(!$_POST["ruid"] && !$_POST["message"]){add_return_data(0, 6,"ruid and message can't be empty.");}
    $ruid = $_POST["ruid"];
    $message = $_POST["message"];
    $msg = new Message();
    $retVal = $msg->addMessage($uid, $hash, $ruid, $message);
    if(($retVal == 4) || ($retVal == 3)){add_return_data(0, 7, "Receiver not found");};
    if($retVal == 1){add_return_data(1, 2, "Success sending message.");}
    add_return_data(0, 8, "Failure while sending.");

?>