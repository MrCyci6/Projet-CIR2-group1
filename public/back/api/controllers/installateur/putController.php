<?php

    $id = array_shift($request);
    if(!isset($id) || !isset($_PUT['nom']) || empty($_PUT['nom'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $nom = $_PUT['nom'];
    if(!Installateur::update($id, $nom)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }


    sendData("{\"success\": true, \"message\": \"Installateur updated\"}", 200);
?>