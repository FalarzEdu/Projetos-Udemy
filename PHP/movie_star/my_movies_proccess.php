<?php
    // Important archives imports -------------------------------
    require_once("connect.php");
    require_once("url.php");
    require_once("models/Movie.php");
    require_once("models/ProccessImage.php");
    require_once("dao/MovieDAO.php");
    // Classes initializations ----------------------------------
    $movieDAO = new MovieDAO($db, $BASE_URL);
    $imgProccess = new ProccessImage($db, $BASE_URL);
    // POST id request ------------------------------------------
    $movieId = filter_input(INPUT_POST, "popup-id");
    // Action selection -----------------------------------------
    if(filter_input(INPUT_POST, "delete")) {
        // Destroy movie ----------------------------------------
        $movieDAO->destroy($movieId);
    }
    else {
        //echo $movieId;
        $movieOld = $movieDAO->findById($movieId);
        //print_r($movieToUpdate);

        $movieToUpdate = new Movie();
        $movieToUpdate->id = $movieId;
        $movieToUpdate->title = filter_input(INPUT_POST, "title");
        //$movieToUpdate->image = filter_input(INPUT_POST, "image");
        $movieToUpdate->length = filter_input(INPUT_POST, "length");
        $movieToUpdate->category = filter_input(INPUT_POST, "category");
        $movieToUpdate->trailer = filter_input(INPUT_POST, "trailer");
        $movieToUpdate->description = filter_input(INPUT_POST, "description");
        $movieToUpdate->users_id = $movieOld->users_id;

        if((!$_FILES["image"]["name"])) {
            $movieToUpdate->image = $movieOld->image;
        }
        else {
            // Changes de default image to the one sent by the user ----
            $movieToUpdate->image = $imgProccess->createMoviePhoto("create");
        }

        $movieDAO->updateAll($movieToUpdate);
    }
?>