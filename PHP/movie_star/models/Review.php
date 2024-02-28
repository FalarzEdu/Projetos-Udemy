<?php
    // IMPORTANT ARCHIVES IMPORT ---------------------------------
    require_once("connect.php");
    require_once("url.php");
    require_once("models/Message.php");

    Class Review {
        // PUBLIC ATTRIBUTES -------------------------------------
        public $id;
        public $rating;
        public $review;
        public $users_id;
        public $movies_id;
    }

    interface ReviewDAOInterface {
        // BUILD AND CREATE -------------------------------------
        public function buildReview($data);
        public function create(Review $review);
        // FINDERS ----------------------------------------------
        public function findById($id);
        public function findByTitle($title);
        // CALCULATES MOVIE RATING ------------------------------
        public function calcMovieRating($movieId);
        // RETURNS USERS REVIEWS --------------------------------
        public function returnUsersReviews($movieId);
        // UPDATE -----------------------------------------------
        public function update(Review $review);
    }

?>