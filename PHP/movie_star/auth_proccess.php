<?php
    // Important archives imports -------------------------------
    require_once("connect.php");
    require_once("url.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    require_once("models/Message.php");

    $userDao = new UserDAO($db, $BASE_URL);

    // Create a message object
    $message = new Message($BASE_URL);

    // Identifies which type of form is beeing used
    $type = filter_input(INPUT_POST, "type");

    // If it's a login form, proceeds this way [...]
    if($type === "login") {
        $email = filter_input(INPUT_POST, "email-login");
        $password = filter_input(INPUT_POST, "password-login");

        $userDao->authenticateUser($email, $password);
    }
    // [...] but if it's not, proceed this way
    else {
        $username = filter_input(INPUT_POST, "username-register");
        $email = filter_input(INPUT_POST, "email-register");
        $password = filter_input(INPUT_POST, "password-register");
        // Reactivate for server password validation purpose
        //$confPassword = filter_input(INPUT_POST, "conf-password");

        if($userDao->findByEmail($email)) {
            $message->setMessage("There is already an account using this e-mail!", "error", "back");
        }
        else {
            $user = new User();

            //$userToken = $user->generateToken();
            $finalPassword = $user->generatePassword($password);

            $user->user = $username;
            $user->email = $email;
            $user->password = $finalPassword;
            //$user->token = $userToken;

            $userDao->create($user);

            $message->setMessage("Account created! Now log-in.", "Success", "auth.php");

            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

?>