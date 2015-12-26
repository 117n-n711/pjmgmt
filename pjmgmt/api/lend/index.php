<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //itemId, userId
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 5,"itemId is a must.");}
    $itemId = $_POST["itemId"];

    $lend = new Borrow();

    if(!$lend->lendBook($uid = $uid, $hash=$hash, $itemId=$itemId)){add_return_data(0, 7, "Accept Error.");}
    add_return_data(1, 1, "Book Lended.");

?>