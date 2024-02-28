<?php

    Class User {
        public $id;
        public $user;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $token;
        public $nationality;

        public function generateToken() {
            return bin2hex(random_bytes(50));
        }

        public function generatePassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

    }

    interface UserDAOInterface {
        // USER CREATION ----------------------------------------

        public function buildUser($data);
        public function create(User $user, $authUser = false);

        // USER UPDATE ------------------------------------------

        public function update($token, $column, $value);
        public function changePassword($pass, $confPass, $newConfPass, User $user);

        // FINDERS ----------------------------------------------

        public function findByToken($token);
        public function findById($id);
        public function findByEmail($email);

        // USER LOGOUT ------------------------------------------

        public function destroyToken();

        // USER REDIRECT PERMISSION CHECK -----------------------

        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = false);

        // USER AUTHENTICATION ----------------------------------

        public function authenticateUser($email, $password);
    
    }

?>