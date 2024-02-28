<?php
    // Important archives imports -------------------------------
    require_once("url.php");
    require_once("connect.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/UserDAO.php");
    require_once("dao/ReviewDAO.php");
    require_once("models/Message.php");

    // Classes initializations ----------------------------------
    $movieDAO = new MovieDAO($db, $BASE_URL);
    $userDAO = new UserDAO($db, $BASE_URL);
    $reviewDAO = new ReviewDAO($db, $BASE_URL);
    $message = new Message($BASE_URL);

    // DATA REQUESTS --------------------------------------------
    $movieData = $movieDAO->findById(filter_input(INPUT_GET, "id"));
    $userData = $userDAO->verifyToken(false);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------------- STYLES ---------------------->
    <link rel="stylesheet" href="css/general_templates.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>/css/get_to_know_movie.css">

    <title>Movie Star</title>
    <link rel="icon" type="image/x-icon" href="img/moviestar.ico">
</head>

<?php
    // Header import --------------------------------------------
    require_once("templates/header.php");
?>

<main>
    <section class="movie-container">
        <div class="movie-content">
            <section class="movie-main-content">
                <h1 class="movie-title"><?=$movieData->title?></h1>
                <div class="movie-info">
                    <p>Duration: <?=$movieData->length?></p>
                    <p class="movie-category"><?=$movieData->category?></p>
                    <div class="valuation-stars">
                        <img src="img/icons/star-solid.svg" alt="">
                        <p>
                            <?php
                                $rating = $reviewDAO->calcMovieRating(filter_input(INPUT_GET, "id"));
                                if($rating): 
                            ?>
                                <?=$rating;?>
                            <?php
                                else:
                            ?>  
                                N/A
                            <?php endif; ?>         
                        </p>
                    </div>
                </div>
                <iframe width="560" height="315" src="<?=$movieData->trailer?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </section>
            <section class="movie-photo-container">
                <img class="movie-photo" src="<?=$movieData->image?>" alt="">
            </section>
        </div>
        <p class="movie-description"><?=$movieData->description?></p>
    </section>
    <section class="comments-content">
        <h2 class="comment-title">Feedbacks:</h2>
        <?php 
            $comments = $reviewDAO->returnUsersReviews($movieData->id);
            foreach($comments as $comment):
                $userId = $userDAO->findById($comment["users_id"]);
        ?>
            <div class="comment-unit">
                <div class="comment-user">
                    <img class="comment-profile-photo" src="img/users/user.png" alt="">
                    <div class="comment-user-info">
                        <p class="username"><?=$userId->user?></p>
                        <div class="valuation-stars">
                            <img src="img/icons/star-solid.svg" alt="">
                            <p><?=$comment["rating"]?></p>
                        </div>
                    </div>
                </div>
                <div class="comment-content-section">
                    <h4 class="comment-subtitle">Comment:</h4>
                    <p class="comment-content"><?=$comment["review"]?></p>
                </div>
            </div>

        <?php
            endforeach;
        ?>

    </section>
    <section>
        <form action="get_to_know_movie_proccess.php" method="POST" class="write-comment-form">
            <h2 class="write-comment-title">Give it a feedback:</h2>
            <label for="rating">Rate this movie:</label>
            <input type="number" name="rating" id="rating">
            <label for="review">Write a comment:</label>
            <textarea name="review" id="review" class="write-comment-content" placeholder="Write your comment" required></textarea>
            <input type="hidden" name="users_id" value="<?=$userData->id?>">
            <input type="hidden" name="movies_id" value="<?=$movieData->id?>">
            <button type="submit" class="write-comment-button btn">Submit</button>
        </form>
    </section>
</main>

<?php
    // Footer import --------------------------------------------
    require_once("templates/footer.php");
?>