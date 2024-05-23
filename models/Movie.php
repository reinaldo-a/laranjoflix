<?php 

    class Movie {

        public $id;
        public $title;
        public $length;
        public $quality;
        public $category;
        public $link;
        public $date;
        public $description;
        public $image;
        public $users_id;

        public function generateImageName($extension) {  
            $name = md5(uniqid()) . "." . $extension;
            return $name;
        }

    }

    interface MovieDAOInterface {

        public function create($userData);
        
    }

?>