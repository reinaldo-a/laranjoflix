<?php 

    //Review object
    class Review {

        public $id;
        public $rating;
        public $review;
        public $user_id;
        public $movie_id;

    }
    
    //Review inteface. 
    interface ReviewDAOInterface {

        public function createReview($reviewData);
        public function findByMovieId($movie_id);
        public function buildreview($reviewArray);
        
    }
?>