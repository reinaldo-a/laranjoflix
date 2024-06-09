<?php 

    require_once("dao/UserDAO.php");
    require_once("globals.php");
    require_once("db.php");

    //instantiating objects
    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    $userData = $userDao->findByToken();

    //Get message
    $flassMessage = $message->getMessage();
    
    if(!empty($flassMessage["msg"])) {
        $message->dropMessage();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShareFlix</title>
    <link rel="icon" href="<?= $BASE_URL ?>/img/favicon.ico" type="image/svg+xml">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">  
                            <ul>
                                <li><a href="<?= $BASE_URL ?>/index.php">Pagina Inicial</a></li>
                                <li><a href="./categories.html">Categorias<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="./categories.html">Categories</a></li>
                                        <li><a href="./anime-details.html">Anime Details</a></li>
                                        <li><a href="./anime-watching.html">Anime Watching</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                        <li><a href="./signup.html">Sign Up</a></li>
                                        <li><a href="./login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= $BASE_URL ?>/newMovie.php">Adicionar Filme</a></li>
                                <?php if(!empty($userData)): ?>
                                    <li><a href="dashboard.php">Meus Filmes</a></li>
                                <?php endif;?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        <?php if(!empty($userData)): ?>
                            <?php if(!empty($userData->image)): ?>
                                <a href="<?= $BASE_URL ?>/profile.php"><img class="profile-image-container" src="<?= $BASE_URL ?>/img/users/<?= $userData->image ?>" alt="user image"></a>
                            <?php else: ?>
                            <a href="<?= $BASE_URL ?>/profile.php"><span class="icon_profile"></span></a>
                            <?php endif; ?>
                            <a href="<?= $BASE_URL ?>/logout.php">Sair</a>
                        <?php else: ?>
                        <a href="<?= $BASE_URL ?>/login.php"><span class="icon_profile"></span></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php 
        if(!empty($flassMessage["msg"])) {
            echo "<p class='msg $flassMessage[type]'>$flassMessage[msg]</p>";
        }
    ?>