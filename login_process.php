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
        $message->setMessage("Dados invalidos!", "error", "register.php");
    }