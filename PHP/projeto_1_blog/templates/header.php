<?php

  include_once("helpers/url.php");
  include_once("data/categories.php");
  include_once("data/posts.php");
  include_once("data/tags.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- STYLES -->

  <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
  <link rel="stylesheet" href="<?= $BASE_URL ?>/css/reset.css">

  <!-- FONTS -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Goldman:wght@400;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <title>Coding Blog</title>
</head>
<body>
    <header id="page-header">
        <div id="logo-container">
            <a href="<?=$BASE_URL?>">
                <img src="./img/logo.svg" alt="">
            </a>
        </div>
        <div>
            <ul id="navbar">
                <li><a href="<?= $BASE_URL ?>">Home</a></li>
                <li><a href="">Categories</a></li>
                <li><a href="">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </div>
    </header>  