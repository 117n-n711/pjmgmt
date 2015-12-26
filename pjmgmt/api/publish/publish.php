<?php

    header('Content-type: text/html; charset=UTF-8');
?>
<html>
    <head>
        <title>
            Publish
        </title>
    </head>
    <body>
        <form action="./" method="POST" enctype="multipart/form-data">
            itemName: <input type="text" name="itemName" value="New Item"><br>
            money: <input type="text" name="money" value="10"><br>
            period: <input type="text" name="period" value="20"><br>
            longitude: <input type="text" name="longitude" value="121.528765"><br>
            latitude: <input type="text" name="latitude" value="31.103271"><br>
            address: <input type="text" name="address" value="Minhang, Shanghai，上海"><br>
            expressType: <input type="text" name="expressType" value="快递"><br>
            itemIntroduction: <input type="text" name="itemIntroduction" value="哈哈哈哈"><br>
            itemImageSrc: <input type="file" name="itemImageSrc"><br>
            Username: <input type="text" name="uid" value="6"><br>
            Password: <input type="text" name="hash" value="335c12b47bbd6061ee09456c1d8f01bbd3f3a7a1"><br>
            <input type="submit">
        </form>
    </body>
</html>