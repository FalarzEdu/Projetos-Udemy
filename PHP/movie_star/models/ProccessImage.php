<?php

    include_once("models/Message.php");
    include_once("dao/UserDAO.php");
    include_once("dao/MovieDAO.php");

    Class ProccessImage {
        //private $userId;
        private $image;
        private $imageFile;
        private $imageName;
        private $imagePath;
        private $userDAO;
        private $movieDAO;
        //private $userData;
        private $message;

        public function __construct(PDO $db, $url) {
            $this->userDAO = new UserDAO($db, $url);
            $this->movieDAO = new MovieDAO($db, $url);
            $this->message = new Message($url);
        }

        private function generateImageArchive() {
            // Verifica o form de imagem foi acionado.
            if(isset($_FILES["image"])) {
                // Verifica se a imagem existe pelo nome.
                if($_FILES["image"]["name"] != "") {
                    $this->image = $_FILES["image"];

                    // Verifica o tipo de imagem (PNG, JPG ou JPEG) e cria um arquivo com o formato.
                    if(in_array($this->image["type"], ["image/jpeg", "image/jpg"])) {
                        $this->imageFile = imagecreatefromjpeg($this->image["tmp_name"]);
                    }
                    else {
                        $this->imageFile = imagecreatefrompng($this->image["tmp_name"]);
                    }
                    // Usa o método para criar um nome codificado para a imagem.
                    $this->imageName = $this->generateImageName();

                    return;
                }
                else {
                    // Dispara uma mensagem de erro caso a imagem não seja válida.
                    $this->message->setMessage("Invalid image!", "Error", "back");
                }

                exit();
            }
        }

        private function generateImageName() {
            return bin2hex(random_bytes(50)) . ".jpg";
        }

        public function changeUserPhoto($id) {
            $this->generateImageArchive();

            // Cria um arquivo local da imagem.
            imageJpeg($this->imageFile, "./img/users/" . $this->imageName, 100);

            // Junta o caminho da foto com o seu nome para passar para o DB.
            $imgPath = "img/users/" . $this->imageName;

            // Atualiza o banco com a imagem.
            $this->userDAO->update($id, "image", $imgPath);

            // Dispara uma mensagem de sucesso.
            $this->message->setMessage("Image changed!", "Success", "back");

            return;
        }

        public function createMoviePhoto($type, $id = NULL) {
            $this->generateImageArchive();
            
            // Cria um arquivo local da imagem.
            imageJpeg($this->imageFile, "./img/movies/" . $this->imageName, 100);

            // Junta o caminho da foto com o seu nome para passar para o DB.
            $imgPath = "img/movies/" . $this->imageName;

            if($type == "create") {
                return $imgPath;
            }
            else {
                // Atualiza o banco com a imagem.
            $this->movieDAO->update($id, "image", $imgPath);
            }

            return;
        }
    }
    

?>