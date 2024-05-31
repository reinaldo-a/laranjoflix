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

            $this->message->setMessage("Filme Salvo com sucesso!", "success", "dashboard.php");

        }

        public function getMovies() {

            $stmt = $this->conn->prepare("SELECT * FROM movies");
                        
            $stmt->execute();

            $moviesArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($moviesArray as $movie) {

                $movies[] = $this->buildMovie($movie);

            }
                
            return $movies;
        }

        public function findById($id) {

            if(isset($id) && !empty($id)) {
                
                $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = :id");
                
                $stmt->bindParam(":id", $id);
                
                $stmt->execute();
                
                $movieArray = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $movieData = $this->buildMovie($movieArray);
                
                return $movieData;
            } else {
                $this->message->setMessage("Filme não encontrado!", "error", "back");
            }

        }

        public function findByUsers_id($users_id) {
            
            if(isset($users_id) && !empty($users_id)) {

                $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :users_id");
                
                $stmt->bindParam(":users_id", $users_id);
                
                $stmt->execute();

                $moviesArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($moviesArray as $movie) {

                    $movies[] = $this->buildMovie($movie);
                    
                }
            }
            
            return $movies;

        }

        public function buildMovie($movieArray) {
            
            $movieData = new Movie;

                $movieData->id = $movieArray['id'];   
                $movieData->title = $movieArray['title'];   
                $movieData->length = $movieArray['length'];   
                $movieData->quality = $movieArray['quality'];   
                $movieData->category = $movieArray['category'];   
                $movieData->link = $movieArray['link'];   
                $movieData->date = $movieArray['date'];   
                $movieData->description = $movieArray['description'];   
                $movieData->image = $movieArray['image'];   
                $movieData->users_id = $movieArray['users_id'];   

            return $movieData;

        }

        public function edit($movieData) {

            $stmt = $this->conn->prepare("UPDATE movies SET 
            title = :title, 
            length = :length, 
            quality = :quality,
            category = :category,
            link = :link,
            date = :date,
            description = :description,
            image = :image 
            WHERE id = :id
            ");

            $stmt->bindParam("id", $movieData->id);
            $stmt->bindParam("title", $movieData->title);
            $stmt->bindParam("length", $movieData->length);
            $stmt->bindParam("quality", $movieData->quality);
            $stmt->bindParam("category", $movieData->category);
            $stmt->bindParam("link", $movieData->link);
            $stmt->bindParam("date", $movieData->date);
            $stmt->bindParam("description", $movieData->description);
            $stmt->bindParam("image", $movieData->image);

            $stmt->execute();

            $this->message->setMessage("Filme atualizado com sucesso!", "success", "dashboard.php");

        }

        public function delete($id) {

            $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $this->message->setMessage("Filme deletado com sucesso!", "success", "dashboard.php");
        }


    }

?>