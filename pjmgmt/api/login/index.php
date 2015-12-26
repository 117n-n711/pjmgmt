<?php
    $base = "../../";
    require_once($base."users.php");
    $returndata = array();
    //uname, password
    if(!isset($_POST['uname']) || !isset($_POST['password'])){
        add_return_data(0, 2, "Both Username and Password need to be posted.");
    }
    else{
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $user = new User($uname);
        if(!$user->checklogin($uname, $password)){
            //Username password incorrect send that json.
            add_return_data(0, 3, "Incorrect username or password");
        }
        else{
            //Username and password is correct send json to say username password correct and send cookies
            $userdata = $user->get_user_data();
            $returndata["user"] = $userdata;
            $cookies = array("uid"=> $user->get_userid(), "hash"=> getCookies($user->get_userid()));
            $returndata["cookies"] = $cookies;
            add_return_data(1, 1, "Logged In!");
        }
    }
?>