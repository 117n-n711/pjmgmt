<?php
    require_once("functions.php");
    if(!isset($base)){
        render_404page();
    }
    Class Comment{
        function addComment($uid, $hash, $itemId, $com){
            $check = $this->checkItemId($itemId);
            $check = $check && $this->checkUserId($uid);
            $com = $this->checkData($com);
            if(!checkCookies($uid, $hash) || !$check){return false;}
            $query = "INSERT INTO `comment` (`iid`, `uid`, `comment`) VALUES ($itemId, $uid, '$com');";
            if(mysql_query($query)){return true;}
            return false;
        }
        function checkItemId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function checkUserId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function checkData($comment){
            return mysql_real_escape_string($comment);
        }
        function getComments($itemId){
            //
        }
    }
?>