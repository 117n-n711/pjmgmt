<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //cid, itemId, reply
    if(!isset($_POST["reply"]) || !$_POST["reply"]){add_return_data(0, 5,"Comment reply is a must.");}
    $reply = $_POST["reply"];
    if(!isset($_POST["itemId"]) || !$_POST["itemId"]){add_return_data(0, 6,"itemId is a must.");}
    $itemId = $_POST["itemId"];
    if(!isset($_POST["cid"]) || !$_POST["cid"]){add_return_data(0, 6,"cid is a must.");}
    $cid = $_POST["cid"];

    $comment = new ReplyComment();
    if(!$comment->addReply($uid=$uid, $hash=$hash, $itemId=$itemId, $cid=$cid, $reply=$reply)){add_return_data(0, 7,"Error while replying to a comment.");}
    add_return_data(1, 1, "Replied to a comment");

?>