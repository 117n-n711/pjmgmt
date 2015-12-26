<?php
    $base = "../../../";
    require_once($base."functions.php");
    require_once($base."loginCheck.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);

    //uid, ruid, hash, message
    if(!isset($_POST["ruid"])){add_return_data(0, 5,"ruid is must.");}
    if(!$_POST["ruid"]){add_return_data(0, 6,"ruid can't be empty.");}
    $limit = 100;
    $from = 0;
    $before = 0;
    if(isset($_POST["limit"]) && $_POST["limit"]){$val = $_POST["limit"];if($val > 0){$limit = $val;}}
    if(isset($_POST["from"]) && $_POST["from"]){$val = $_POST["from"];if($val > 0){$from = $val;}}
    if(isset($_POST["before"]) && $_POST["before"]){$val = $_POST["before"];if($val > 0){$before = $val;}}

    $ruid = $_POST["ruid"];
    $msg = new Message();
    if($from == 0 && $before > 0){
        $data = $msg->getMessagesBefore($uid=$uid, $hash=$hash, $ruid=$ruid, $limit=$limit, $before=$before);
        if(is_int($data)){add_return_data(0, 8, "Error while fetching");}
        $returndata["data"] = array("messages" => $data);
        add_return_data(1, 2, "Success");
    }else{
        $data = $msg->getMessagesFrom($uid=$uid, $hash=$hash, $ruid=$ruid, $limit=$limit, $from=$from);
        if(is_int($data)){add_return_data(0, 7, "Error while fetching");}
        $returndata["data"] = array("messages" => $data);
        add_return_data(1, 1, "Success");
    }
?>