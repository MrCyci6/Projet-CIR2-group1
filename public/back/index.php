<?php

    require_once 'models/Database.php';
    require_once 'models/User.php';

    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $ressource = array_shift($request);
    
    $routes = [
        "accueil" => "controllers/accueilController.php",
        "installations" => "controllers/installationsController.php",
        "installation" => "controllers/installationController.php",
        "installateurs" => "controllers/installateursController.php",
        "panneaux" => "controllers/panneauxController.php",
        "onduleurs" => "controllers/onduleursController.php",
        "localites" => "controllers/localitesController.php"
    ];


    if(isset($routes[$ressource])) {
        require $routes[$ressource];
    } else {
        require $routes["accueil"];
    }
?>
