<?php 

    require_once("dao/UserDAO.php");
    require_once("db.php");
    require_once("globals.php");
    require_once("models/Message.php");

    $userData = new User;
    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    /* receives process type */
    $type =  filter_input(INPUT_POST, "type");

    /* Process the regiater. */
    if($type === "register") {

        /* user data */
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPasswoed = filter_input(INPUT_POST, "confirmPassword");

        /* verify data */

        if(!empty($name) && !empty($lastname) && !empty($email) && !empty($password) && !empty($confirmPasswoed)) {

            $data = $userDao->findByEmail($email);

            if($email != $data->email) {

                if($password === $confirmPasswoed) {
                    $passwordFinal = $userData->generatePassword($password);
                } else {
                    /* messagem de erro */
                    $message->setMessage("As senhas não corespondem!", "error", "register.php");
                }

                $token = $userData->generateToken();

                $userData->name = $name;
                $userData->lastname = $lastname;
                $userData->email = $email;
                $userData->password = $passwordFinal;
                $userData->token = $token;
                
                $userDao->createUser($userData);

                $_SESSION["token"] = $userData->token;

                $message->setMessage("Usuario cadastrado com sucesso!", "success", "index.php");

            } else {
                $message->setMessage("Usuario ja cadastrado!", "error", "register.php");
            }

            } else {
                $message->setMessage("Prencha todos os campos!", "error", "register.php");
            }
            

    } else if($type === "edit") {

        $id = filter_input(INPUT_POST, "id");
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $image = filter_input(INPUT_POST, "image");

        $userData->id = $id;
        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->image = $image;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageData = $_FILES["image"];
            $image = $_FILES["image"]["tmp_name"];
            $imageType = ["image/jpeg", "image/jpg", "image/png"];

            if(in_array($imageData["type"], $imageType)) {
                
                $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
                
                $imageName = $userData->generateImageName($extension);
                
                move_uploaded_file($_FILES["image"]["tmp_name"],"$destination_file/Laranjoflix/laranjo5flix/img/users/$imageName");

                $userData->image = $imageName;

            } else {
                $message->setMessage("Add uma img em jpg ou png.", "error", "newMovie.php");
                exit;
            }
    
        }

        $userDao->editUser($userData);

        $message->setMessage("Perfil editado com sucesso.", "success", "profile.php");

    } else if($type === "editPassword") {

        $password = filter_input(INPUT_POST, "password");
        $confirmPasswoed = filter_input(INPUT_POST, "confirmPassword");

        if($password === $confirmPasswoed) {
            $passwordFinal = $userData->generatePassword($password);
        } else {
            $message->setMessage("As senhas não corespondem!", "error", "register.php");
        }

        $message->setMessage("Senha atualizada com sucesso!", "success", "back");

        $userDao->editPassword($passwordFinal);

    } else if($type === "login") {

        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        $userData = $userDao->findByEmail($email);

        if($userData->email == $email && password_verify($password, $userData->password)) {

            $_SESSION["token"] = $userData->token;

            $message->setMessage("Login realizado com sucesso!", "success", "index.php");

        } else {
            $message->setMessage("Usuário ou senha icorreto.", "error", "login.php");
        }

    } else{
        $message->setMessage("Dados invalidos!", "error", "index.php");
    }