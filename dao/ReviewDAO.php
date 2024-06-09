<?php 

    require_once("models/Review.php");
    require_once("models/Message.php");

    class ReviewDAO implements ReviewDAOInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
            
        }

        public function createReview($reviewData) {
            
            if(isset($reviewData->user_id)) {

                $stmt = $this->conn->prepare("INSERT INTO 
                reviews(id, rating, review, users_id, movies_id) 
                VALUES (:id, :rating, :review, :user_id, :movie_id) ");

                $stmt->bindParam(":id", $reviewData->id);
                $stmt->bindParam(":rating", $reviewData->rating);
                $stmt->bindParam(":review", $reviewData->review);
                $stmt->bindParam(":user_id", $reviewData->user_id);
                $stmt->bindParam(":movie_id", $reviewData->movie_id);

                $stmt->execute();

                $this->message->setMessage("Avaliação enviada com sucesso!", "success", "back");

            } else {
                $this->message->setMessage("Dados invalidos!", "error", "back");
            }

        }

        public function findByMovieId($movie_id) {

            $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movie_id ORDER BY id DESC");

            $stmt->bindParam(":movie_id", $movie_id);

            $stmt->execute();

            $reviewsArray =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            $reviews = [];

            foreach($reviewsArray as $review) {
            
                $reviews [] = $this->buildreview($review);

            }

            return $reviews;

        }

        public function buildreview($reviewArray) {

            $reviewData = new Review;
            

                $reviewData->id = $reviewArray["id"];
                $reviewData->rating = $reviewArray["rating"];
                $reviewData->review = $reviewArray["review"];
                $reviewData->user_id = $reviewArray["users_id"];
                $reviewData->movie_id = $reviewArray["movies_id"];
            
            return $reviewData;
        }

    }

?>