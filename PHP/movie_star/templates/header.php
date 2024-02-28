<?php

    include_once("url.php");
    include_once("connect.php");
    include_once("models/Message.php");
    include_once("dao/UserDAO.php");

    $msg = new Message($BASE_URL);

    $msgData = $msg->getMessage();

    $userDAO = new UserDao($db, $BASE_URL);

    $userData = $userDAO->verifyToken(false);
?>

<body>
    <header>
        <nav>
            <!------------------- LOGO ------------------>
            <div>
                <a class="header-logo" href="index.php">
                    <img src="img/logo.svg" alt="">
                    <p>MovieStar</p>
                </a>
            </div>
        
            <!-------------- SEARCH FEATURE ------------->
            <form action="search.php" method="GET" class="header-search-bar">
                <input type="text" placeholder="Search Movies" name="search-bar">
                <button>
                    <img src="img/icons/magnifying-glass-solid.svg" alt="">
                </button>
            </form>
            <!-------------- USER NOT LOGGED ------------>
            <?php  if($userData == false):?>
        
            <!----------------- MOBILE ------------------>

            <img class="menu-mobile-icon" src="img/icons/bars-solid.svg" alt="">
            <aside class="menu-mobile">
                <img class="menu-mobile-close" src="img/icons/x-solid-white.svg" alt="">
                <div class="header-buttons-guest">
                    <a href="auth.php">Login / Register</a>
                </div>
            </aside>

            <!----------------- DESKTOP ----------------->
            <div class="header-buttons-guest desktop-only">
                <a href="auth.php">Login / Register</a>
            </div>

            <!---------------- USER LOGGED -------------->
            <?php  else: ?>

            <!----------------- MOBILE ------------------>
            <img class="menu-mobile-icon" src="img/icons/bars-solid.svg" alt="">
            <aside class="menu-mobile">
                <img class="menu-mobile-close" src="img/icons/x-solid-white.svg" alt="">
                <div class="header-buttons-logged">
                    <a href="add_movie.php">Add movie</a>
                    <a href="my_movies.php">My movies</a>
                    <a href="profile.php"><?= $userData->user?></a>
                    <a href="logout.php">Exit</a>
                </div>
            </aside>

            <!----------------- DESKTOP ----------------->
            <div class="header-buttons-logged desktop-only">
                <a href="add_movie.php">Add movie</a>
                <a href="my_movies.php">My movies</a>
                <a href="profile.php"><?= $userData->user?></a>
                <a href="logout.php">Exit</a>
            </div>

            <?php  endif; ?>
        </nav>
    </header>

<?php if(!empty($msgData)) {  ?>
    <div class="messageDisplay 
    <?php if($msgData["msgType"] == "Success"): ?>
        msgSuccess
    <?php else: ?>
        msgError 
    <?php endif; ?>
    ">
        <p><?= $msgData["msg"]?></p>
    </div>
<?php 
    $msg->clearMessage();
}; 
?>