<?php

    require_once("models/Review.php");
    require_once("connect.php");
    require_once("url.php");
    require_once("models/Message.php");

    Class ReviewDAO implements ReviewDAOInterface {
        // PRIVATE ATTRIBUTES ------------------------------------
        private $db;
        private $url;
        private $message;

        public function __construct(PDO $db, $url) {
            $this->db = $db;
            $this->url = $url;
            $this->message = new Message($url);
        }

        // BUILD AND CREATE -------------------------------------
        public function buildReview($data) {
            $review = new Review();

            $review->id = $data["id"];
            $review->rating = $data["rating"];
            $review->review = $data["review"];
            $review->users_id = $data["users_id"];
            $review->movies_id = $data["movies_id"];

            return $review;
        }

        public function create(Review $review) {
            $stmt = $this->db->prepare("INSERT INTO reviews(rating, review, users_id, movies_id) VALUES (:rating, :review, :users_id, :movies_id)");

            $stmt->bindParam(":rating", $review->rating);
            $stmt->bindParam(":review", $review->review);
            $stmt->bindParam(":users_id", $review->users_id);
            $stmt->bindParam(":movies_id", $review->movies_id);

            $stmt->execute();
        }

        // FINDERS ----------------------------------------------
        public function findById($id) {

        }

        public function findByTitle($title) {

        }

        // CALCULATES MOVIE RATING ------------------------------
        public function calcMovieRating($movieId) {
            $stmt = $this->db->prepare("SELECT rating FROM reviews WHERE movies_id = $movieId");

            $stmt->execute();

            $ratingsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($ratingsArr) == 0) {
                return;
            }
            $ratings = 0;

            foreach($ratingsArr as $singleRating) {
                $ratings += $singleRating["rating"];
            }

            return round($ratings / count($ratingsArr), 1);
        }

        // RETURNS USERS REVIEWS --------------------------------
        public function returnUsersReviews($movieId) {
            $stmt = $this->db->prepare("SELECT * FROM reviews WHERE movies_id = $movieId");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // UPDATE -----------------------------------------------
        public function update(Review $review) {

        }

    }

?>