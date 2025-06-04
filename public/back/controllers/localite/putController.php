<?php

    $id = array_shift($request);
    if(
        !isset($_POST['nom']) || empty($_POST['nom'])
        || !isset($_POST['cp']) || empty($_POST['cp'])
        || !isset($_POST['population']) || empty($_POST['population'])  
        || !isset($_POST['code_insee']) || empty($_POST['code_insee'])  
    ) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $nom = $_POST['nom'];
    $cp = $_POST['cp'];
    $population = $_POST['population'];
    $code_insee = $_POST['code_insee'];
    if(!Localite::update($code_insee, $nom, $cp, $population)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }


    sendData("{\"success\": true, \"message\": \"Localite updated\"}", 200);
?>