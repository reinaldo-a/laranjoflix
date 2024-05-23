<?php 

    require_once("models/Movie.php");
    require_once("models/Message.php");

    class MovieDAO implements MovieDAOInterface {

        private $message;
        private $conn;
        private $url;

        public function __construct($conn, $url)
        {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function create($userData) {

           // var_dump($userData->title);exit;

            $stmt = $this->conn->prepare(" INSERT INTO
            movies(title, description, category, link, quality, image, date, length, users_id) 
            VALUES (:title, :description, :category, :link, :quality, :image, :date, :length, :users_id)");

            $stmt->bindParam("title", $userData->title);
            $stmt->bindParam(":description", $userData->description);
            $stmt->bindParam(":category", $userData->category);
            $stmt->bindParam(":link", $userData->link);
            $stmt->bindParam(":quality", $userData->quality);
            $stmt->bindParam(":image", $userData->image);
            $stmt->bindParam(":date", $userData->date);
            $stmt->bindParam(":length", $userData->length);
            $stmt->bindParam(":users_id", $userData->users_id);

            $stmt->execute();

            $this->message->setMessage("Filme Salvo com sucesso!", "success", "newMovie.php");

        }

    }

?>