<?php
    // IMPORTANT ARCHIVES IMPORT --------------------------------
    require_once("dao/ReviewDAO.php");
    require_once("models/Review.php");
    require_once("models/Message.php");
    require_once("connect.php");
    require_once("url.php");

    // CLASSES INITIALIZATION -----------------------------------
    $reviewDAO = new ReviewDAO($db, $BASE_URL);
    $review = new Review();
    $message = new Message($BASE_URL);

    // REVIEW DATA BUILD ----------------------------------------
    $review->rating = filter_input(INPUT_POST, "rating");
    $review->review = filter_input(INPUT_POST, "review");
    $review->users_id = filter_input(INPUT_POST, "users_id");
    $review->movies_id = filter_input(INPUT_POST, "movies_id");

    // INSERTS DATA ON THE DB -----------------------------------
    $reviewDAO->create($review);
    $message->setMessage("Comment added successfully!", "Success", "back");
?>