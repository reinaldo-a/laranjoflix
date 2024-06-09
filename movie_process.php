<?php 

    require_once("dao/MovieDAO.php");
    require_once("dao/UserDao.php");
    require_once("globals.php");
    require_once("db.php");

    // instantiating objects
    $message = new Message($BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $movieData = new Movie;
    $userDao = new UserDAO($conn, $BASE_URL);
    
    /* checking validity of the user's token, if it is not valid the user will be redirected to carry out something */
    if(isset($_SESSION["token"])) {

        $userData = $userDao->findByToken(true);

    } else {
        $message->setMessage("É nescessario realizar login.", "error", "login.php");
    }
    
    //Receives a value relating to the process to be carried out
    $type = filter_input(INPUT_POST, "type");

    //process create film
    if($type === "create") {

        //receiving movie data
        $title = filter_input(INPUT_POST, "title");
        $length = filter_input(INPUT_POST, "length");
        $quality = filter_input(INPUT_POST, "quality");
        $category = filter_input(INPUT_POST, "category");
        $link = filter_input(INPUT_POST, "link");
        $date = filter_input(INPUT_POST, "date");
        $description = filter_input(INPUT_POST, "description");

        //creating movie object
        $movieData->title = $title;
        $movieData->length = $length;
        $movieData->quality = $quality;
        $movieData->category = $category;
        $movieData->link = $link;
        $movieData->date = $date;
        $movieData->description = $description;
        $movieData->users_id = $userData->id;

        //case image process is added
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageData = $_FILES["image"];
            $image = $_FILES["image"]["tmp_name"];
            $imageType = ["image/jpeg", "image/jpg", "image/png"];

            //checking image type
            if(in_array($imageData["type"], $imageType)) {
                
                $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
                
                //generating name for image
                $imageName = $movieData->generateImageName($extension);
                
                //adding image to desired folder
                move_uploaded_file($_FILES["image"]["tmp_name"],"$destination_file/Laranjoflix/laranjoflix/img/movies/$imageName");

                $movieData->image = $imageName;

            } else {

                //error msg if the image is not of type png or jpg
                $message->setMessage("Add uma img em jpg ou png.", "error", "newMovie.php");
                exit;
            }

        }

        //adding movie data to database
        $movieDao->create($movieData);

    //process edit film
    } elseif($type === "edit") {

        //receiving movie data
        $id = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "title");
        $length = filter_input(INPUT_POST, "length");
        $quality = filter_input(INPUT_POST, "quality");
        $category = filter_input(INPUT_POST, "category");
        $link = filter_input(INPUT_POST, "link");
        $date = filter_input(INPUT_POST, "date");
        $image = filter_input(INPUT_POST, "image");
        $description = filter_input(INPUT_POST, "description");

        //creating movie object
        $movieData->id = $id;
        $movieData->title = $title;
        $movieData->length = $length;
        $movieData->quality = $quality;
        $movieData->category = $category;
        $movieData->link = $link;
        $movieData->date = $date;
        $movieData->image = $image;
        $movieData->description = $description;

        //case image process is added
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageData = $_FILES["image"];
            $image = $_FILES["image"]["tmp_name"];
            $imageType = ["image/jpeg", "image/jpg", "image/png"];

            //checking image type
            if(in_array($imageData["type"], $imageType)) {
                
                $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
                
                //generating name for image
                $imageName = $movieData->generateImageName($extension);
                
                //adding image to desired folder
                move_uploaded_file($_FILES["image"]["tmp_name"],"$destination_file/Laranjoflix/laranjoflix/img/movies/$imageName");

                $movieData->image = $imageName;

            } else {
                //error msg if the image is not of type png or jpg
                $message->setMessage("Add uma img em jpg ou png.", "error", "newMovie.php");
                exit;
            }
    
        }

        //editing movie data in the database
        $movieDao->edit($movieData);            

    //process delete film
    } elseif($type === "delete") {

        //rwcwbwndo movie id
        $id = filter_input(INPUT_POST, "id");

        //deleting movie from database
        $movieDao->delete($id);

    } else {
        //redirection if the process is not valid
        $message->setMessage("Dados invalidos.", "error", "index.php");
    }

?>