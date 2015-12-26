<?php
    require_once("functions.php");
    if(!isset($base)){
        render_404page();
    }
    Class Borrow{
        function _construct(){
            //
        }
        function borrowBook($uid, $hash, $itemId, $message){
            $message = $this->checkMessage($message);
            $this->checkItemId($itemId);
            $this->checkUserId($uid);
            if(!checkCookies($uid, $hash)){return false;}
            $query = "INSERT INTO `borrow` (`uid`, `iid`, `message`) VALUES ($uid, $itemId, '$message');";
            if(mysql_query($query)){return true;}
            return false;
        }
        function checkMessage($message){
            return mysql_real_escape_string($message);
        }
        function checkItemId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function checkUserId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function isAlreadyBorrowed($itemId){
            $itemId = mysql_real_escape_string($itemId);
            $query = "SELECT * FROM `item` WHERE `iid`=$itemId AND (`status`=1 OR `status`=2);";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){return true;}
                return false;
            }
            return true;

        }
        function returnBook($uid, $hash, $itemId){
            $this->checkItemId($itemId);
            $this->checkUserId($uid);
            if(!checkCookies($uid, $hash)){return false;}
            $query = "UPDATE `borrow` SET `isAccepted`=1, `isReturned`=1 WHERE `iid` = $itemId AND `isReturned`=0;";
            if(mysql_query($query)){return true;}
            return false;
        }
        function isBorrowedBy($uid, $itemId){
            $itemId = mysql_real_escape_string($itemId);
            $uid = mysql_real_escape_string($uid);
            $query = "SELECT * FROM `borrow`, `item` WHERE `item`.`iid`= $itemId AND `item`.`iid` = `borrow`.`iid` AND `isReturned`=0 AND `item`.`uid` = $uid;";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){return true;}
                return false;
            }
            return false;
        }
        function lendBook($uid, $hash, $itemId){
            $this->checkItemId($itemId);
            if(!checkCookies($uid, $hash)){return false;}
            $query = "UPDATE `borrow` SET `isAccepted`=1, `isReturned`=0 WHERE `iid` = $itemId AND `isReturned` = 1 AND `isAccepted` = 0;";
            if(mysql_query($query)){return true;}
            return false;
        }
        function isRequestedBy($uid, $userId, $itemId){
            $itemId = mysql_real_escape_string($itemId);
            $uid = mysql_real_escape_string($uid);
            $userId = mysql_real_escape_string($userId);
            $query = "SELECT * FROM `borrow`, `item` WHERE `item`.`iid`= $itemId AND `item`.`iid` = `borrow`.`iid` AND `isReturned`=1 AND `isAccepted`=0 AND `borrow`.`uid` = $userId AND `item`.`uid` = $uid;";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){return true;}
                return false;
            }
            return false;
        }
        function isNotReturned($itemId){
            $itemId = mysql_real_escape_string($itemId);
            $query = "SELECT * FROM `borrow` WHERE `borrow`.`iid`= $itemId AND `isReturned`=0";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){return true;}
                return false;
            }
            return false;
        }
    }

?>