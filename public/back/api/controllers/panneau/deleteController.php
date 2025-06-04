<?php

    if(!isset($_GET['id']) || empty($_GET['id'])) {
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

    $id = $_GET['id'];
    if(!Panneau::remove($id)) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"Panneau deleted\"}", 200);
?>