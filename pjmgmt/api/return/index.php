<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //itemId
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 5,"itemId is a must.");}
    $itemId = $_POST["itemId"];

    $return = new Borrow();
    if(!$return->isBorrowedBy($uid = $uid, $itemId = $itemId)){add_return_data(0, 6, "Uid haven't given this book to anyone");}
    if(!$return->returnBook($uid = $uid, $hash=$hash, $itemId=$itemId)){add_return_data(0, 7, "Return Error.");}
    add_return_data(1, 1, "Book Returned.");
?>