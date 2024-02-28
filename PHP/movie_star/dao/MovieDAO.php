<?php

    // Fundamental archives import ---------------------------------
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("url.php");

    Class MovieDAO implements MovieDAOInterface {
        private $db;
        private $url;
        public $message;

        public function __construct(PDO $db, $url) {
            $this->db = $db;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data) {
            $movie = new Movie();

            $movie->id = $data["id"];
            $movie->title = $data["title"];
            $movie->description = $data["description"];
            $movie->image = $data["image"];
            $movie->trailer = $data["trailer"];
            $movie->category = $data["category"];
            $movie->length = $data["length"];
            $movie->users_id = $data["users_id"];

            return $movie;
        }
        public function create(Movie $movie) {
            $stmt = $this->db->prepare("INSERT INTO movies(id, title, description, image, trailer, category, length, users_id) VALUES (:id, :title, :description, :image, :trailer, :category, :length, :users_id)");

            $stmt->bindParam(":id", $movie->id);
            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":length", $movie->length);
            $stmt->bindParam(":users_id", $movie->users_id);

            $stmt->execute();
        }
        // Finders ----------------------------------------------
        public function findAll($id = (-1)) {
            if($id >= 0) {
                $stmt = $this->db->prepare("SELECT * FROM movies WHERE users_id = :id");
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else {
                $stmt = $this->db->prepare("SELECT * FROM movies");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
        }
        public function findById($id) {
            $stmt = $this->db->prepare("SELECT * FROM movies WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $movie = $stmt->fetch();
            
            return $this->buildMovie($movie);;
        }

        public function findByTitle($title) {
            $stmt = $this->db->prepare("SELECT * FROM movies WHERE title LIKE :title");
            $stmt->bindValue(":title", "%" . $title . "%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Get an array of movies -------------------------------
        public function getLatestMovies() {
            $stmt = $this->db->prepare("SELECT * FROM movies ORDER BY id DESC LIMIT 6");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getMoviesByCategory($category) {
            $stmt = $this->db->prepare("SELECT * FROM movies WHERE category = :category ORDER BY id DESC LIMIT 6");
            $stmt->bindParam(":category", $category);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Update and destroy movies ----------------------------
        public function update($id, $column, $value) {
            $stmt = $this->db->prepare("UPDATE movies SET $column = :val WHERE id = :id");
    
            $stmt->bindParam(":val", $value);
            $stmt->bindParam(":id", $id);
    
            $stmt->execute();
        }

        public function updateAll($movie) {
            $stmt = $this->db->prepare("UPDATE movies SET title = :title, description = :description, image = :image, trailer = :trailer, category = :category, length = :length WHERE id = :id");
    
            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":length", $movie->length);
            $stmt->bindParam(":id", $movie->id);
    
            $stmt->execute();

            $this->message->setMessage("Movie update succesfully!", "Success", "back");
        }

        public function destroy($id) {
            $stmt = $this->db->prepare("DELETE FROM movies WHERE :id = id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $this->message->setMessage("Movie deleted successfully!", "Success", "back");
        }
    }

?>