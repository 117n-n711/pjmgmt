<?php
    //

    $base = "../../";
    require_once($base."functions.php");
    header('Content-type: text/html; charset=UTF-8');

    $uid = getUid();
    $hash = getCookieHash();
    checkCookieHash($uid, $hash);
    //itemName, money, period, longitude, latitude, (address, expressType, itemIntroduction, itemImageSrc)
    if(!isset($_POST["itemName"]) && !isset($_POST["money"]) && !isset($_POST["period"]) && !isset($_POST["longitude"]) && !isset($_POST["latitude"])){add_return_data(0, 5,"Longitude, Latitude, itemName, money, period are must.");}
    if(!$_POST["itemName"] && !$_POST["money"] && !$_POST["period"] && !$_POST["longitude"] && !$_POST["latitude"]){add_return_data(0, 6,"Longitude, Latitude, itemName, money, period can't be empty.");}
    $itemName = $_POST["itemName"];
    $money = $_POST["money"];
    $period = $_POST["period"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];
    $expressType = "";
    $itemIntroduction = "";
    $itemImageSrc = "";
    $address = "";
    if(isset($_POST["address"])){$address = $_POST["address"];}
    if(isset($_POST["expressType"])){$expressType = $_POST["expressType"];}
    if(isset($_POST["itemIntroduction"])){$itemIntroduction = $_POST["itemIntroduction"];}
    if(isset($_POST["itemImageSrc"])){$itemImageSrc = $_POST["itemImageSrc"];}
    $arr = array("longitude" => $longitude,
                    "latitude" => $latitude,
                    "itemName" => $itemName,
                    "money" => $money,
                    "period" => $period,
                    "expressType" => $expressType,
                    "itemIntroduction" => $itemIntroduction,
                    "itemImageSrc" => $itemImageSrc,
                    "uid" => $uid,
                    "address" => $address
    );
    $item = new Item($data = $arr);
    $iteId = $item->publish($uid, $hash);
    if(!$iteId){add_return_data(0, 7, "Error while updating.");}
	$returndata["data"] = array("itemId"=>$iteId);
    $iteImg = uploadPic("itemPic", $iteId, "itemImageSrc");
    if($item->updateItemImage($uid, $hash, $iteId, $iteImg)){add_return_data(1, 1, "Success");}
    add_return_data(1, 2, "Success uploding data except Image");
?>