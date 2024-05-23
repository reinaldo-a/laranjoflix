<?php 

    class User {

        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $token;
        public $image;

        
        public function generatePassword($password) {
            return password_hash($password, PASSWORD_BCRYPT);
        }

        public function generateToken() {
            return bin2hex(random_bytes(50));
        }

    }

    interface UserDAOInterface {

        public function buildUser($userData);
        public function createUser($userData);
        public function findByEmail($email);
        public function findByToken($protect = false);
        public function destroyToken();

    }