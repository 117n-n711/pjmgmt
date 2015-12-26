<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //rating, itemId
    if(!isset($_POST["rating"]) || !$_POST["rating"]){add_return_data(0, 5,"Rating is a must.");}
    $rate = $_POST["rating"];
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 6,"itemId is a must.");}
    $itemId = $_POST["itemId"];

    $rating = new Rating();
    if(!$rating->addRating($uid=$uid, $hash=$hash, $itemId=$itemId, $rate=$rate)){add_return_data(0, 7,"Error while rating.");}
    add_return_data(1, 1, "Rating Added.");

?>