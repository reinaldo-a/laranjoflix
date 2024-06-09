<?php

  require_once("templates/header.php");

  //the user will be logged out
  if($userDao) {
    $userDao->destroyToken();
  }  
?>