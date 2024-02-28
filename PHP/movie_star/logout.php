<?php

    require_once("dao/UserDAO.php");
    require_once("url.php");
    require_once("connect.php");

    $newDao = new UserDAO($db, $BASE_URL);
    $newDao->destroyToken();
?>