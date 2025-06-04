<?php

    if(!isset($_GET['code_insee']) || empty($_GET['code_insee'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $code_insee = $_GET['code_insee'];
    if(!Localite::remove($code_insee)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"Localite deleted\"}", 200);
?>