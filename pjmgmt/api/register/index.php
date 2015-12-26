<?php
    $base = "../../";
    require_once($base."functions.php");
    $returndata = array();
    $uname = "";
    $password = "";
    $gender = "";
    $fname = "";
    $email = "";
    $contact = "";
    $role = "0";
    //uname, password, email , (gender, fname, contact)
    if(!isset($_POST["uname"])){add_return_data(0, 3, "Username required");}
    $uname = $_POST["uname"];
    if(!$uname){add_return_data(0, 3, "Username required");}
    if(!isset($_POST["password"])){add_return_data(0, 4, "Password required");}
    $password = $_POST["password"];
    if(!$password){add_return_data(0, 4, "Password required");}
    if(isset($_POST["gender"])){$gender = $_POST['gender'];}
    if(isset($_POST["fname"])){$fname = $_POST['fname'];}
    if(!isset($_POST["email"])){add_return_data(0, 5, "E-mail required");}
    $email = $_POST["email"];
    if(!$email){add_return_data(0, 5, "E-mail required");}
    if(isset($_POST["contact"])){$contact = $_POST['contact'];}
    if(isset($_POST["role"]) && $_POST["role"]){$role = $_POST['role'];}

    $user = new User($uname);
    if($user->getuser()){
        add_return_data(0, 2, "User already exists");
    }
    $data = array("uname" => $uname,
                  "password"=>$password,
                  "gender"=>$gender,
                  "fname"=> $fname,
                  "email"=> $email,
                  "contact" => $contact,
                  "role"=>$role
                  );
    $useId = $user->insert($data);
    $cookies = array("uid"=> $useId, "hash"=> getCookies($useId));
    $returndata["cookies"] = $cookies;
    if($useId){
        $picId = uploadPic("profilePic", $useId, "userFace");
        if($picId){
            if($user->updateProfileImage($useId, $picId)){
                add_return_data(1, 1, "User successfully created");
            }
        }
        add_return_data(1, 2, "User successfully created but picture cannot be added.");
    }



?>