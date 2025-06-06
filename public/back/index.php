<?php

    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $ressource = array_shift($request);
    
    $routes = [
        "" => "controller/"
    ];


    header('Location: api');
    // if(isset($routes[$ressource])) {
    //     // require $routes[$ressource];
    // } else {
        
    //     exit();    
    // }
?>
