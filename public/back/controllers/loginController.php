<?php

    if(Session::isUserLogged()) {
        header("Location: accueil");
        exit();
    }

    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    
    $id = User::login($username, $password);
    if($id) {
        Session::loginUser($id);
        header("Location: accueil");
        exit();
    }

    require "views/login.php";
?>