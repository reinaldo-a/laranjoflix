<?php 

    require_once("models/User.php");
    require_once("models/Message.php");
    //require_once("db.php");

    class UserDAO implements UserDAOInterface {

        private $conn;
        private $url;
        private $message;

        //Connect database
        public function __construct(PDO $conn, $url)
        {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($conn);
        }

        
        //Insert user into the database
        public function createUser($userData) {
            
            //Prepare SQL statement with parameters
            $stmt = $this->conn->prepare("INSERT INTO users (name, lastname, email, password, token) VALUES (:name, :lastname, :email, :password, :token)");
            
            //Associate parameter values with the actual values you want to insert into the database    
            $stmt->bindParam(':name', $userData->name);
            $stmt->bindParam(':lastname', $userData->lastname);
            $stmt->bindParam(':email', $userData->email);
            $stmt->bindParam(':password', $userData->password);
            $stmt->bindParam(':token', $userData->token);

            // Run the prepared statement
            $stmt->execute();

        }

        public function editUser($userData) {

            $stmt = $this->conn->prepare("UPDATE users SET 
            name = :name, 
            lastname = :lastname, 
            email = :email,
            image = :image
            WHERE id = :id
            ");

            $stmt->bindParam(":name", $userData->name);
            $stmt->bindParam(":lastname", $userData->lastname);
            $stmt->bindParam(":email", $userData->email);
            $stmt->bindParam(":image", $userData->image);
            $stmt->bindParam(":id", $userData->id);

            return $stmt->execute();

        }

        public function editPassword($password) {

            $stmt = $this->conn->prepare("UPDATE users SET 
            password = :password 
            ");

            $stmt->bindParam(":password", $password);

            return $stmt->execute();
        }

        //Generate user
        public function buildUser($userArray) {

            $userData = new User;

            $userData->id = $userArray["id"];
            $userData->name = $userArray["name"];
            $userData->lastname = $userArray["lastname"];
            $userData->email = $userArray["email"];
            $userData->password = $userArray["password"];
            $userData->image = $userArray["image"];
            $userData->token = $userArray["token"];

            return $userData;

        }

        //Buscar por email
        public function findByEmail($email) {

            if(isset($email)) {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            
            $stmt->bindParam(":email", $email);

            //Run the Query
            $stmt->execute();

            // Fetch all results
            $userArray = $stmt->fetch();

            $userData = $this->buildUser($userArray);

            return $userData;

            } else {
                return false;
            }

        }

        //
        public function findByToken($protect = false) {

            if(!empty($_SESSION['token'])) {

                $token = $_SESSION['token'];
                
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
                $stmt->bindParam(":token", $token);

                // Executar a consulta
                $stmt->execute();

                // Buscar todos os resultados
                $userArray = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $userData = $this->buildUser($userArray);

                return $userData;   

            } else if($protect === true) {

                $this->message->getMessage("É necessario fazer login!", "error", "register.php ");

            } else {
                return false;
            }
        }

        public function destroyToken() {

            $_SESSION["token"] = "";
            $_SESSION["type"] = "";

        }

    }