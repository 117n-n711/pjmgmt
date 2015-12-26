<?php
    require_once("functions.php");
    if(!isset($base)){
        render_404page();
    }
    Class ReplyComment{
        function addReply($uid, $hash, $itemId, $cid, $reply){
            $check = $this->checkId($itemId);
            $check = $check && $this->checkId($uid);
            $check = $check && $this->checkId($cid);
            $reply = $this->checkData($reply);
            if(!checkCookies($uid, $hash) || !$check){return false;}
            $query = "INSERT INTO `replycomment` (`iid`, `uid`, `cid`, `reply`) VALUES ($itemId, $uid, $cid, '$reply');";
            if(mysql_query($query)){return true;}
            return false;
        }
        function checkId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function checkData($comment){
            return mysql_real_escape_string($comment);
        }
    }
?>