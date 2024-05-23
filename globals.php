<?php 

        session_start();

    //Variable Global the rotes server
    $BASE_URL = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["REQUEST_URI"] . "?"); 
    $destination_file = $_SERVER['DOCUMENT_ROOT'];


?>