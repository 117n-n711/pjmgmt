<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //itemId, (message)
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 5,"itemId is a must.");}
    $itemId = $_POST["itemId"];
    $message = "";
    if(isset($_POST["message"])){$message = $_POST["message"];}

    $borrow = new Borrow();
    $user = new Items();
    $ruid = $user->getUserId($itemId);
    if($borrow->isAlreadyBorrowed($itemId)){add_return_data(0, 6, "Is Already Borrowed");}
	if($ruid == -1 || $ruid==$uid){add_return_data(0, 8, "Cannot borrow your own book");}
    if(!$borrow->borrowBook($uid=$uid, $hash=$hash, $itemId=$itemId, $message=$message)){add_return_data(0, 7, "Borrow Error.");}

    $msg = new Message();

    $ruid = $user->getUserId($itemId);
    if($ruid == -1){add_return_data(1, 2, "Borrowed but cannot send message.");}
    $retVal = $msg->addMessage($uid, $hash, $ruid, $message);
    if($retVal != 1){add_return_data(1, 3, "Borrowed but cannot send message");}
    add_return_data(1, 1, "Book Borrow Requested.");
?>