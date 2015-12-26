<?php
    $base = "../../";
    require_once($base."functions.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    if(!isset($_POST["itemId"])){add_return_data(0, 2, "Item Id is required.");}
    if(!$_POST["itemId"]){add_return_data(0, 3, "Item Id is required.");}
    $itemId = $_POST["itemId"];
    $items = new Items();
    $item = $items->getItemById($itemId);
    $item["user"] = $items->getUserInformation($itemId);
    $borrow = new Borrow();
    $item["available"] = "no";
    if(!$borrow->isNotReturned($itemId)){
        $item["available"] = "yes";
    }

    $returndata["data"] = $item;
    add_return_data(1, 1, "Success");
?>