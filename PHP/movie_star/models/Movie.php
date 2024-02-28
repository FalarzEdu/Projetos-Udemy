<?php

    Class Movie {
        public $id;
        public $title;
        public $description;
        public $image;
        public $trailer;
        public $category;
        public $length;
        public $users_id;
    }

    interface MovieDAOInterface {
        // Build an movie object and create a movie in the DB ---
        public function buildMovie($data);
        public function create(Movie $movie);
        // Finders ----------------------------------------------
        public function findAll($id = (-1));
        public function findById($id);
        public function findByTitle($title);
        // Get an array of movies -------------------------------
        public function getLatestMovies();
        public function getMoviesByCategory($category);
        // Update and destroy movies ----------------------------
        public function update($id, $column, $value);
        public function updateAll(Movie $movie);
        public function destroy($id);
    }

?>