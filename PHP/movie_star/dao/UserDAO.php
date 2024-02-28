<?php

    require_once("models/User.php");
    require_once("url.php");
    require_once("models/Message.php");

    Class UserDAO implements UserDAOInterface {

        private $db;
        private $url;
        // Creates a new object message
        public $message;

        public function __construct(PDO $db, $url) {
            $this->db = $db;
            $this->url = $url;
            $this->message = new Message($url);
        } 

        public function buildUser($data) {
            $user = new User();

            $user->id = $data["id"];
            $user->user = $data["user"];
            $user->email = $data["email"];
            $user->password = $data["password"];
            $user->image = $data["image"];
            $user->bio = $data["bio"];
            $user->token = $data["token"];
            $user->nationality = $data["nationality"];

            return $user;
        }

        public function create(User $user, $authUser = false) {
            $stmt = $this->db->prepare("INSERT INTO users(email, password, image, token, bio, user, nationality) VALUES (:email, :password, :image, :token, :bio, :user, :nationality)");

            $imgPath = "img/users/user.png";
            $genericBio = "Nothing here yet! Describe yourself :)";
            $nationality = '';

            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":image", $imgPath);
            $stmt->bindParam(":token", $user->token);
            $stmt->bindParam(":bio", $genericBio);
            $stmt->bindParam(":user", $user->user);
            $stmt->bindParam(":nationality", $nationality);

            $stmt->execute();
        }

        // USER UPDATE ------------------------------------------

        public function update($id, $column, $value) {
            $stmt = $this->db->prepare("UPDATE users SET $column = :val WHERE id = :id");

            $stmt->bindParam(":val", $value);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        }

        public function changePassword($pass, $confPass, $newConfPass, User $user) {
            if(password_verify($pass, $user->password)) {
                if($confPass == $newConfPass) {
                    $newPass = $user->generatePassword($confPass);
                    $this->update($user->id, "password", $newPass);
                    $this->message->setMessage("Password changed successfully!", "Success", "back");
                }
                else {
                    $this->message->setMessage("Passwords don't match!", "Error", "back");
                }
            } 
            else {
                $this->message->setMessage("Actual password is wrong!", "Error", "back");
            }
            exit();
        }

        // FINDERS ----------------------------------------------

        public function findByToken($token) {
            if($token == "") {
                return;
            }
            else {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE token = :token");

                $stmt->bindParam(":token", $token);

                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    return $this->buildUser($data);
                }
                else {
                    return false;
                }
            }
        }

        public function findById($id) {
            if($id == "") {
                return;
            }
            else {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");

                $stmt->bindParam(":id", $id);

                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    return $this->buildUser($data);
                }
                else {
                    return false;
                }
            }
        }

        public function findByEmail($email) {
            if($email == "") {
                return;
            }
            else {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");

                $stmt->bindParam(":email", $email);

                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    return $this->buildUser($data);
                }
            }
        }

        // USER LOGOUT ------------------------------------------

        public function destroyToken() {
            $_SESSION["token"] = "";

            $this->message->setMessage("You logged out succesfully!", "Success", "auth.php");
            return;
        }

        // USER REDIRECT PERMISSION CHECK -----------------------

        public function verifyToken($protected = false) {
            if(!empty($_SESSION["token"])) {
                return $this->findByToken($_SESSION["token"]);
            }
            else {
                if($protected) {
                    $this->message->setMessage("You must authenticate to access this page!", "Error", "auth.php");
                }
            }
            return;
        }
        
        public function setTokenToSession($id, $redirect = false) {
            $userData = $this->findById($id);

            $newToken = $userData->generateToken();

            $this->update($userData->id, "token", $newToken);

            $_SESSION["token"] = $newToken; 

            // if($redirect) {
                
            // }
        }

        // USER AUTHENTICATION ----------------------------------

        public function authenticateUser($email, $password) {
            $userLogin = $this->findByEmail($email);
            if($userLogin) {
                if(password_verify($password, $userLogin->password)) {
                    $this->setTokenToSession($userLogin->id);
                    header("Location: index.php");
                    exit();
                }
                else {
                    $this->message->setMessage("Wrong password!", "Error", "back");
                }
            }
            else {
                $this->message->setMessage("Account does not exist!", "Error", "back");
                exit();
            }
        }
    }

?>