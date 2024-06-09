<?php 

    require_once("dao/ReviewDAO.php");
    require_once("globals.php");
    require_once("db.php");

    // instantiating objects
    $reviewDao = new ReviewDAO($conn, $BASE_URL);
    $reviewData = new Review;

    $type = filter_input(INPUT_POST, "type");

    //process to create assessment
    if($type == "createReview") {
        
        $rating = filter_input(INPUT_POST, "rating");
        $review = filter_input(INPUT_POST, "review");
        $user_id = filter_input(INPUT_POST, "user_id");
        $movie_id = filter_input(INPUT_POST, "movie_id");

        $reviewData->rating = $rating;
        $reviewData->review = $review;
        $reviewData->user_id = $user_id;
        $reviewData->movie_id = $movie_id;

        $reviewDao->createReview($reviewData);

    }

?>