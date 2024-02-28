<?php
    require_once("dao/UserDAO.php");
    require_once("models/Message.php");
    require_once("url.php");
    require_once("connect.php");

    // Classes initialization --------------------------------------
    $userDAO = new UserDAO($db, $BASE_URL);

    // Data request ------------------------------------------------
    $userData = $userDAO->verifyToken(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------------- STYLES ---------------------->
    <link rel="stylesheet" href="css/general_templates.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>/css/add_movie.css">

    <title>Movie Star</title>
    <link rel="icon" type="image/x-icon" href="img/moviestar.ico">
</head>

<?php
    require_once("templates/header.php")
?>

<main>
    <h1 class="default-title"><span></span>Add a movie</h1>
    <h3 class="default-subtitle">Share a movie with everyone!</h3>
    <section class="content">
        <form autocomplete="off" action="add_movie_proccess.php" method="POST" enctype="multipart/form-data" class="form-container">
            <div class="input-fields-wrap">
                <section class="form-section">
                    <div class="input-data">
                        <label for="title">Movie title</label>
                        <input type="text" id="title" name="title" class="form-inputs">
                    </div>
                    <div class="input-data">
                        <label for="image">Movie image</label>
                        <input type="file" id="image" name="image" class="form-inputs form-inputs-image">
                    </div>
                    <div class="input-data">
                        <label for="length">Movie duration</label>
                        <input type="text" id="length" name="length" class="form-inputs">
                    </div>
                </section>
                <section class="form-section">
                    <div class="input-data">
                        <label for="category">Movie category</label>
                        <select name="category" id="category" class="form-inputs">
                            <option value="">Select a category</option>
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Crime">Crime</option>
                            <option value="Horror">Horror</option>
                            <option value="Romance">Romance</option>
                            <option value="Science fiction">Science fiction</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Western">Western</option>
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
            <button class="btn" type="submit">Add movie</button>
        </form>
    </section>
</main>

<?php
    require_once("templates/footer.php")
?>
