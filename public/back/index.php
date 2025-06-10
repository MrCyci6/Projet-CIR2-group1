<?php

    require_once 'models/Database.php';
    require_once 'models/User.php';
    require_once 'models/Session.php';

    Session::start();

    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $ressource = array_shift($request);
    
    $routes = [
        "accueil" => "controllers/accueilController.php",
        "installations" => "controllers/installationsController.php",
        "installation" => "controllers/installationController.php",
        "login" => "controllers/loginController.php",
        "logout" => "controllers/logoutController.php"
    ];


    if(isset($routes[$ressource])) {
        require $routes[$ressource];
    } else {
        require $routes["login"];
    }
?>
