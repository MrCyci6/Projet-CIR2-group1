<?php

    $id = array_shift($request);
    if(!isset($id) || !isset($_PUT['id_marque']) || empty($_PUT['id_marque']) || !isset($_PUT['id_modele']) || empty($_PUT['id_modele'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $id_marque = $_PUT['id_marque'];
    $id_modele = $_PUT['id_modele'];
    if(!Onduleur::update($id, $id_marque, $id_modele)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }


    sendData("{\"success\": true, \"message\": \"Onduleur updated\"}", 200);
?>