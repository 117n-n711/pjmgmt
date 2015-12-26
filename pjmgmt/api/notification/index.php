<?php
    $base = "../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);

    $noti = new Notification();

    $data = $noti->getNotification($uid, $hash);
    $returndata["data"] = $data;
    add_return_data(1, 1, "Notifications Returned.");
?>