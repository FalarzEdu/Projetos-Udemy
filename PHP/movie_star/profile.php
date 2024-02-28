<?php
    require_once("url.php");
    require_once("connect.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDAO = new UserDAO($db, $BASE_URL);
    $message = new Message($BASE_URL);

    //$userDAO->verifyToken(true);

    $userData = $userDAO->verifyToken(true);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------------- STYLES ---------------------->
    <link rel="stylesheet" href="css/general_templates.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>/css/profile.css">

    <title>Movie Star</title>
    <link rel="icon" type="image/x-icon" href="img/moviestar.ico">
</head>

<?php
    require_once("templates/header.php");
?>

<main>
    <section class="user-photo-field">
        <img src="<?=$userData->image?>" alt="" class="user-photo" id="user-photo">
        <!-- <p class="img-text">Change photo</p> -->
        <form action="profile_proccess.php" method="POST">
            <input type="hidden" name="id" value="<?=$userData->id?>">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="bio" readonly><?=$userData->bio?></textarea>
            <div>
                <button type="submit" class="confirm-change">
                    <img src="img/icons/check-solid.svg" alt="" >
                </button>
                <img src="img/icons/x-solid.svg" alt="" name="x-bio" class="deny-change">
            </div>
        </form>
    </section>
    <section class="user-info">
        <div class="user-info-column">
            <form action="profile_proccess.php" method="POST" class="data-group">
                <input type="hidden" name="id" value="<?=$userData->id?>">
                <label for="user">Username</label>
                <div class="input-field-group">
                    <input type="text" class="form-inputs" id="user" name="user" value="<?=$userData->user?>" required readonly>
                    <img src="img/icons/pencil-solid.svg" alt="" class="change-pencil">
                    <button type="submit" class="confirm-change">
                        <img src="img/icons/check-solid.svg" alt="" >
                    </button>
                    <img src="img/icons/x-solid.svg" alt="" class="deny-change">
                </div>
            </form>
            <form action="profile_proccess.php" method="POST" class="data-group">
                <input type="hidden" name="id" value="<?=$userData->id?>">
                <label for="email">E-mail</label>
                <div class="input-field-group">
                    <input type="text" class="form-inputs" id="email" name="email" value="<?=$userData->email?>" required readonly pattern="[a-zA-Z0-9]+@[a-zA-Z]{3,}(\.[a-z]{2,})+">
                    <img src="img/icons/pencil-solid.svg" alt="" class="change-pencil">
                    <button type="submit" class="confirm-change">
                        <img src="img/icons/check-solid.svg" alt="" >
                    </button>
                    <img src="img/icons/x-solid.svg" alt="" class="deny-change">
                </div>
            </form>
        </div>
        <div class="user-info-column">
            <form action="profile_proccess.php" method="POST" class="data-group" id="data-group-password">
                <input type="hidden" name="id" value="<?=$userData->id?>">
                <label for="password">Password</label>
                <div class="input-field-group">
                    <input type="password" class="form-inputs" id="password" name="password" value="" required readonly>
                    <img src="img/icons/pencil-solid.svg" alt="" class="change-pencil" name="pencil-password">
                    <button type="submit" class="confirm-change">
                        <img src="img/icons/check-solid.svg" alt="" >
                    </button>
                    <img src="img/icons/x-solid.svg" alt="" name="x-password" class="deny-change">
                </div>
                <div id="new-pass-group">
                    <label for="passwordConf">New password</label>
                    <input type="password" class="form-inputs" id="passwordConf" name="passwordConf" required value="">
                </div>
                <div id="conf-new-pass-group">
                    <label for="newPasswordConf">Confirm</label>
                    <input type="password" class="form-inputs" id="newPasswordConf" name="newPasswordConf" required value="">
                </div>
            </form>
            <form action="profile_proccess.php" method="POST" class="data-group">
                <input type="hidden" name="id" value="<?=$userData->id?>">
                <label for="nationality">Nationality</label>
                <div class="input-field-group">
                    <input type="text" class="form-inputs" id="nationality" name="nationality" value="<?=$userData->nationality?>" required readonly>
                    <img src="img/icons/pencil-solid.svg" alt="" class="change-pencil">
                    <button type="submit" class="confirm-change">
                        <img src="img/icons/check-solid.svg" alt="" >
                    </button>
                    <img src="img/icons/x-solid.svg" alt="" class="deny-change">
                </div>
            </form>
        </div>
    </section>
</main>
<aside class="pop-up">
    <form action="profile_proccess.php" method="POST" enctype="multipart/form-data" id="change-photo-form">
        <img src="img/icons/x-solid.svg" alt="" class="close-popup">
        <h3 class="h3-popup">Select your image</h3>
        <input type="hidden" name="id" value="<?=$userData->id?>">
        <input type="file" name="image" id="image">
        <button type="submit">Change photo</button>
    </form>
</aside>
<script src="js/desktop/editProfile.js"></script>

<?php
    require_once("templates/footer.php");
?>