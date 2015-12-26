<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //comment, itemId
    if(!isset($_POST["comment"]) || !$_POST["comment"]){add_return_data(0, 5,"Comment is a must.");}
    $com = $_POST["comment"];
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 6,"itemId is a must.");}
    $itemId = $_POST["itemId"];

    $comment = new Comment();
    if(!$comment->addComment($uid=$uid, $hash=$hash, $itemId=$itemId, $com=$com)){add_return_data(0, 7,"Error while commenting.");}
    add_return_data(1, 1, "Commented");

?>