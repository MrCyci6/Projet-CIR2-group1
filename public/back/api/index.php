<?php

    require_once "../models/Database.php";
    require_once "../models/Installation.php";
    require_once "../models/Installateur.php";
    require_once "../models/Panneau.php";
    require_once "../models/Onduleur.php";
    require_once "../models/Localite.php";
    require_once "../models/Departement.php";
    require_once "utils.php";

    if(!Database::getConnection()) {
        sendData("{\"success\": false, \"message\": \"Database error\"}", 503);
        exit();
    }

    $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $ressource = array_shift($request);
    
    $routes = [
        "installation" => "controllers/installation/".$requestMethod."Controller.php",
        "installateur" => "controllers/installateur/".$requestMethod."Controller.php",
        "panneau" => "controllers/panneau/".$requestMethod."Controller.php",
        "onduleur" => "controllers/onduleur/".$requestMethod."Controller.php",
        "localite" => "controllers/localite/".$requestMethod."Controller.php",
        "departement" => "controllers/departement/".$requestMethod."Controller.php"
    ];
    
    if(isset($routes[$ressource])) {
        if($requestMethod == "put") {
            parse_str(file_get_contents('php://input'), $_PUT);
        }
        
        require $routes[$ressource];
    } else {
        if($ressource == "") {
            sendData("{\"success\": true, \"message\": \"Welcome to SolarSight-API\", \"version\": \"1.0.0\"}", 200);
            exit();
        }

        sendData("{\"success\": false, \"message\": \"Ressource not found\"}", 404);
        exit();    
    }
?>
