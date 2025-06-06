<?php

    if(!isset($_POST['id_marque']) || empty($_POST['id_marque']) || !isset($_POST['id_modele']) || empty($_POST['id_modele'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $id_marque = $_POST['id_marque'];
    $id_modele = $_POST['id_modele'];
    if(!Onduleur::add($id_marque, $id_modele)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"Onduleur added\"}", 201);
?>