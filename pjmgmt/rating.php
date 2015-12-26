<?php
    require_once("functions.php");
    if(!isset($base)){
        render_404page();
    }
    Class Rating{
        function getRating($itemId){
            if($this->hasTotalRating($itemId)){
                $query = "SELECT `rating` FROM `totalrating` WHERE `iid`=$itemId";
                if($result = mysql_query($query)){
                    while($res = mysql_fetch_array($result)){
                        return $res["total"];
                    }
                    return 0;
                }
                return 0;
            }
            return 0;
        }
        function checkItemId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function checkUserId($itemId){
            if($itemId > 0){return true;}
            return fasle;
        }
        function addRating($uid, $hash, $itemId, $rate){
            $this->checkItemId($itemId);
            $this->checkUserId($uid);
            $rate = $this->makeRating($rate);
            if(!checkCookies($uid, $hash)){return false;}
            $query = "UPDATE `rating` SET `rating`=$rate WHERE `iid` = $itemId AND `uid`=$uid;";
            if(!$this->hasRating($uid, $itemId)){
                $query = "INSERT INTO `rating` (`iid`, `uid`, `rating`) VALUES ($itemId, $uid, $rate);";
            }
            if(mysql_query($query)){return true;}
            return false;
        }
        function makeRating($rate){
            if($rate <= 0){return 0;}
            else if($rate >= 5){return 5;}
            return $rate;
        }
        function hasTotalRating($itemId){
            $itemId = mysql_real_escape_string($itemId);
            $query = "SELECT `rating` FROM `totalrating` WHERE `iid`=$itemId";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){
                    return true;
                }
                return false;
            }
            return false;
        }
        function hasRating($uid, $itemId){
            $query = "SELECT `rating` FROM `rating` WHERE `iid`=$itemId AND `uid`=$uid;";
            if($result = mysql_query($query)){
                while($res = mysql_fetch_array($result)){
                    return true;
                }
                return false;
            }
            return false;
        }
    }
?>