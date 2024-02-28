<?php
    // Important archives imports -------------------------------
    require_once("url.php");
    require_once("connect.php");
    require_once("dao/MovieDAO.php");
    //require_once("dao/UserDAO.php");
    require_once("dao/ReviewDAO.php");
    //require_once("models/Message.php");

    // Classes initializations ----------------------------------
    $movieDAO = new MovieDAO($db, $BASE_URL);
    //$userDAO = new UserDAO($db, $BASE_URL);
    $reviewDAO = new ReviewDAO($db, $BASE_URL);
    //$message = new Message($BASE_URL);

    // REQUESTING MOVIE QUERY
    $moviesSearch = $movieDAO->findByTitle(filter_input(INPUT_GET, "search-bar"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------------- STYLES ---------------------->
    <link rel="stylesheet" href="css/general_templates.css">

    <title>Movie Star</title>
    <link rel="icon" type="image/x-icon" href="img/moviestar.ico">
</head>

<?php
    // Header import --------------------------------------------
    require_once("templates/header.php");
?>

<main>
    <h1 class="default-title"><span></span>You searched for "<?=filter_input(INPUT_GET, "search-bar")?>"</h1>
    <h3 class="default-subtitle">Here are some results</h3>
    <section class="movies-rank">
        <?php foreach($moviesSearch as $movie): ?>
        <input type="hidden" name="id" value="<?=$movie["id"]?>">
        <div class="movie-card">
            <img src="<?=$movie["image"]?>" alt="">
            <div class="card-stars">
                <img src="img/icons/star-solid.svg" alt="">
                <p>
                    <?php
                    $rating = $reviewDAO->calcMovieRating($movie["id"]); 
                    if($rating):?>
                        <?=$rating?>
                    <?php else:?>
                        N/A
                    <?php endif;?>
                </p>
            </div>
            <p class="movie-title"><?=$movie["title"]?></p>
            <a href="get_to_know_movie.php?id=<?=$movie["id"]?>" class="btn know-btn">Get to know</a>
        </div>
        <?php endforeach; ?>
    </section>
</main>

<?php
    // Footer import --------------------------------------------
    require_once("templates/footer.php");
?>