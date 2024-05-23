<?php

  require_once("templates/header.php");

  if($userDao) {
    $userDao->destroyToken();
  }

  $message->setMessage("", "success", "login.php");
  
  require_once("templates/footer.php");
  
?>