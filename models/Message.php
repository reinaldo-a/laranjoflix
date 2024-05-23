<?php

use function PHPSTORM_META\type;

    class Message {

        private $url;

        public function __construct($url) {
            $this->url = $url;
        }

        public function setMessage($msg, $type, $redirect = "index.php") {

            $_SESSION["msg"] = $msg;
            $_SESSION["type"] = $type;
            
            if($redirect != "back") {
                header("Location: $this->url/" . $redirect);
            } else {
                header("Location:" . $_SESSION["HTTP_REFERER"]);
            }
            
        }
        
        public function getMessage() {
            
            if(!empty($_SESSION["msg"]) && !empty($_SESSION["type"])) {
                
                return ["msg" => $_SESSION["msg"], 
                       "type" => $_SESSION["type"]
                ];

            } else {
                return false;
            }

            

        }

        public function dropMessage() {
            $_SESSION["msg"] = "";
            $_SESSION["type"] = "";
        }

    }