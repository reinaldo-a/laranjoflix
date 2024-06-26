<?php 

    //User object
    class User {

        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $token;
        public $image;

        public function getFullName($user) {
            return $user->name . " " . $user->lastname;
        }
        
        public function generatePassword($password) {
            return password_hash($password, PASSWORD_BCRYPT);
        }

        public function generateToken() {
            return bin2hex(random_bytes(50));
        }

        public function generateImageName($extension) {  
            $name = md5(uniqid()) . "." . $extension;
            return $name;
        }

    }

    //user inteface. 
    interface UserDAOInterface {

        public function buildUser($userData);
        public function createUser($userData);
        public function editUser($userData);
        public function editPassword($password);
        public function findByEmail($email);
        public function findById($id);
        public function findByToken($protect = false);
        public function destroyToken();

    }