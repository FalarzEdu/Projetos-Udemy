<?php

    // Fundamental archives import ---------------------------------
    require_once("url.php");
    require_once("connect.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/UserDAO.php");
    require_once("models/Message.php");
    require_once("models/Movie.php");
    require_once("models/ProccessImage.php");

    // Classes initialization --------------------------------------
    $newMovie = new Movie();
    $movieDAO = new MovieDAO($db, $BASE_URL);
    $userDAO = new UserDAO($db, $BASE_URL);
    $message = new Message($BASE_URL);

    // Data request ------------------------------------------------
    $userData = $userDAO->verifyToken(false);

    // Image proccess ----------------------------------------------
    $imgProccess = new ProccessImage($db, $BASE_URL, $userData->id);
    

    // Movie object data creation ----------------------------------
    $newMovie->title = filter_input(INPUT_POST, "title");
    $newMovie->description = filter_input(INPUT_POST, "description");
    $newMovie->trailer = filter_input(INPUT_POST, "trailer");
    $newMovie->category = filter_input(INPUT_POST, "category");
    $newMovie->length = filter_input(INPUT_POST, "length");
    $newMovie->users_id = $userData->id;
    // Checks if an image was sent
    if(!empty($_FILES["image"]["name"])) {
        // Changes de default image to the one sent by the user ----
        $newMovie->image = $imgProccess->createMoviePhoto("create");
    }
    else {
        $newMovie->image = "img/movies/movie_cover.jpg";
    }
    // Creates the movie in the DB ----------------------------------
    $movieDAO->create($newMovie);
    // Sets a success message ---------------------------------------
    $message->setMessage("Movie added succesfully!", "Success", "index.php");

?>