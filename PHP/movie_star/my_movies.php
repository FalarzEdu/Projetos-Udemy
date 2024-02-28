<?php
    // Important archives imports -------------------------------
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/reviewDAO.php");
    require_once("models/Message.php");
    require_once("url.php");
    require_once("connect.php");
    // Class initializations ------------------------------------
    $userDAO = new UserDAO($db, $BASE_URL);
    $movieDAO = new MovieDAO($db, $BASE_URL);
    $reviewDAO = new reviewDAO($db, $BASE_URL);
    // User data request ----------------------------------------
    $userData= $userDAO->verifyToken(true);
    // User movies request --------------------------------------
    $userMovies = $movieDAO->findAll($userData->id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------------- STYLES ---------------------->
    <link rel="stylesheet" href="css/general_templates.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>/css/my_movies.css">

    <title>Movie Star</title>
    <link rel="icon" type="image/x-icon" href="img/moviestar.ico">
</head>

<?php
    require_once("templates/header.php")
?>

<main>
    <h1 class="default-title"><span></span>Your movies</h1>
    <section class="user-movies">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Stars</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userMovies as $movie):?>
                    <tr>
                        <td class="movie-title"><?=$movie["title"]?></td>
                        <td class="movie-stars"><?=$reviewDAO->calcMovieRating($movie["id"])?></td>
                        <td class="movie-length"><?=$movie["length"]?></td>
                        <input type="hidden" name="movieId" value="<?=$movie["id"]?>">
                        <td class="movie-actions">
                            <img class="delete-movie" src="img/icons/x-solid-red.svg" alt="">
                            <img class="update-movie" src="img/icons/pen-to-square-solid.svg" alt="">
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </section>
</main>
<aside class="delete-popup">
    <form action="my_movies_proccess.php" method="POST" enctype="multipart/form-data" class="close-popup-container">
        <img src="img/icons/x-solid-white.svg" alt="" class="close-popup" id="close-delete-popup">
        <h3 class="h3-popup">Are you sure you want to delete this movie?</h3>
        <input type="hidden" name="delete" value="1">
        <input type="hidden" name="popup-id" id="delete-popup-id" value="">
        <button class="btn" type="submit">Delete</button>
    </form>
</aside>
<aside class="update-popup pop-up">
    <form autocomplete="off" action="my_movies_proccess.php" method="POST" enctype="multipart/form-data" class="form-container">
        <img src="img/icons/x-solid-white.svg" alt="" class="close-popup" id="close-update-popup">
        <h3 class="h3-popup">Change the movie details</h3>
        <input type="hidden" name="update" value="1">
        <input type="hidden" name="popup-id" id="update-popup-id" value="">
        <div class="input-fields-wrap">
            <section class="form-section">
                <div class="input-data">
                    <label for="title">Movie title</label>
                    <input type="text" id="title" name="title" class="form-inputs" required>
                </div>
                <div class="input-data">
                    <label for="image">Movie image</label>
                    <input type="file" id="image" name="image" class="form-inputs form-inputs-image">
                </div>
                <div class="input-data">
                    <label for="length">Movie duration</label>
                    <input type="text" id="length" name="length" class="form-inputs" required>
                </div>
            </section>
            <section class="form-section">
                <div class="input-data">
                    <label for="category">Movie category</label>
                    <select name="category" id="category" class="form-inputs" required>
                        <option value="">Select a category</option>
                        <option value="Action">Action</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Romance">Romance</option>
                        <option value="Sci-fi">Sci-fi</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>
                <div class="input-data">
                    <label for="trailer">Movie trailer</label>
                    <input type="text" id="trailer" name="trailer" class="form-inputs">
                </div>
                <div class="input-data">
                    <label for="description">Movie description</label>
                    <input type="text" id="description" name="description" class="form-inputs">
                </div>
            </section>
        </div>
        <button class="btn" type="submit">Update</button>
    </form>
</aside>
<script src="js/desktop/my_movies.js"></script>
<?php
    require_once("templates/footer.php")
?>