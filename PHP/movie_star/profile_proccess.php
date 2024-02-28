<?php

    include_once("url.php");
    include_once("connect.php");
    include_once("dao/UserDAO.php");
    include_once("models/User.php");
    include_once("models/Message.php");
    include_once("models/ProccessImage.php");

    $msg = new Message($BASE_URL);
    $userDao = new UserDAO($db, $BASE_URL);
    $userData = $userDao->findById($_POST["id"]);
    $user = new User();
    $imgProccess = new ProccessImage($db, $BASE_URL);

    if(!empty($_FILES["image"])) {
        $imgProccess->changeUserPhoto($userData->id);
    }

    $dataType = array_keys($_POST)[1];
    
    if($dataType == "password") {
        // echo gettype(filter_input(INPUT_POST, "password"));
        // echo "<br>";
        // echo filter_input(INPUT_POST, "passwordConf");
        // echo "<br>";
        // echo filter_input(INPUT_POST, "newPasswordConf");
        // echo "<br>";
        // print_r($userData);
        // echo "<br>";
        // $userDao->update($userData->id, "password", $user->generatePassword("123"));
        // $pass = "$2y$10" . "$" . "CHO5DwPNIUCFOBGa0Att5.XCuYTIM.ccrWHDgvWHRzqLPsm2rqiru";
        // if(password_verify("123", $pass)) {
        //     echo "a";
        // }
        // else {
        //     echo "b";
        // }
        // exit();

        $userDao->changePassword(filter_input(INPUT_POST, "password"), filter_input(INPUT_POST, "passwordConf"), filter_input(INPUT_POST, "newPasswordConf"), $userData);
    }
    else if($dataType == "email") {
        if($_POST["email"] == "") {
            $msg->setMessage("E-mail input can't be blank!", "Error", "back");
            exit();
        }
        if($userDao->findByEmail($_POST[$dataType])) {
            $msg->setMessage("E-mail is already been used!", "Error", "back");
            exit();
        }
    }

    $userDao->update($userData->id, $dataType, $_POST[$dataType]);

    $msg->setMessage("Data changed succesfully!", "Success", "back");

?>