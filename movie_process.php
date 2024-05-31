<?php 

    require_once("dao/MovieDAO.php");
    require_once("dao/UserDao.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $movieData = new Movie;
    $userDao = new UserDAO($conn, $BASE_URL);

    if(isset($_SESSION["token"])) {

        $userData = $userDao->findByToken(true);

    } else {
        $message->setMessage("É nescessario realizar login.", "error", "login.php");
    }
    
    $type = filter_input(INPUT_POST, "type");

    if($type === "create") {

        $title = filter_input(INPUT_POST, "title");
        $length = filter_input(INPUT_POST, "length");
        $quality = filter_input(INPUT_POST, "quality");
        $category = filter_input(INPUT_POST, "category");
        $link = filter_input(INPUT_POST, "link");
        $date = filter_input(INPUT_POST, "date");
        $description = filter_input(INPUT_POST, "description");

        $movieData->title = $title;
        $movieData->length = $length;
        $movieData->quality = $quality;
        $movieData->category = $category;
        $movieData->link = $link;
        $movieData->date = $date;
        $movieData->description = $description;
        $movieData->users_id = $userData->id;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageData = $_FILES["image"];
            $image = $_FILES["image"]["tmp_name"];
            $imageType = ["image/jpeg", "image/jpg", "image/png"];

            if(in_array($imageData["type"], $imageType)) {
                
                $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
                
                $imageName = $movieData->generateImageName($extension);
                
                move_uploaded_file($_FILES["image"]["tmp_name"],"$destination_file/Laranjoflix/laranjo5flix/img/movies/$imageName");

                $movieData->image = $imageName;

            } else {
                $message->setMessage("Add uma img em jpg ou png.", "error", "newMovie.php");
                exit;
            }

        }

        $movieDao->create($movieData);

    } elseif($type === "edit") {

        $id = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "title");
        $length = filter_input(INPUT_POST, "length");
        $quality = filter_input(INPUT_POST, "quality");
        $category = filter_input(INPUT_POST, "category");
        $link = filter_input(INPUT_POST, "link");
        $date = filter_input(INPUT_POST, "date");
        $image = filter_input(INPUT_POST, "image");
        $description = filter_input(INPUT_POST, "description");

        $movieData->id = $id;
        $movieData->title = $title;
        $movieData->length = $length;
        $movieData->quality = $quality;
        $movieData->category = $category;
        $movieData->link = $link;
        $movieData->date = $date;
        $movieData->image = $image;
        $movieData->description = $description;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageData = $_FILES["image"];
            $image = $_FILES["image"]["tmp_name"];
            $imageType = ["image/jpeg", "image/jpg", "image/png"];

            if(in_array($imageData["type"], $imageType)) {
                
                $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
                
                $imageName = $movieData->generateImageName($extension);
                
                move_uploaded_file($_FILES["image"]["tmp_name"],"$destination_file/Laranjoflix/laranjo5flix/img/movies/$imageNam/Laranjoflix/laranjo5flixe");

                $movieData->image = $imageName;

            } else {
                $message->setMessage("Add uma img em jpg ou png.", "error", "newMovie.php");
                exit;
            }
    
        }

        $movieDao->edit($movieData);            

    } elseif($type === "delete") {

        $id = filter_input(INPUT_POST, "id");
        $movieDao->delete($id);

    } else {
        $message->setMessage("Dados invalidos.", "error", "index.php");
    }

?>