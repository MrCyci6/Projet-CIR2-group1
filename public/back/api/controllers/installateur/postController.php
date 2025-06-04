<?php

    if(!isset($_POST['nom']) || empty($_POST['nom'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $nom = $_POST['nom'];
    if(!Installateur::add($nom)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"Installateur added\"}", 201);
?>