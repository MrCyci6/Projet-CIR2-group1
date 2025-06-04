<?php

    require_once "models/Database.php";
    require_once "models/Reservation.php";
    require_once "models/Conso.php";
    require_once "utils.php";

    if(!Database::getConnection()) {
        sendData("{\"success\": false, \"message\": \"Database error\"}", 503);
        exit();
    }

    $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
    $request = substr($_SERVER['PATH_INFO'], 7); // /hotel -> 7
    $request = explode('/', $request);
    $ressource = array_shift($request);
    
    $routes = [
        "test" => "controllers/test/".$requestMethod."Controller.php",
    ];

    if(isset($routes[$ressource])) {
        require $routes[$ressource];
    } else {
        sendData("{\"success\": false, \"message\": \"Ressource not found\"}", 404);
        exit();    
    }
?>
