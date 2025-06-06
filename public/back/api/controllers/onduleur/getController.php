<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {
        $total = Onduleur::getCount() ?? 0;
        $marqueTotal = Onduleur::getMarqueCount() ?? 0;
        $modeleTotal = Onduleur::getModeleCount() ?? 0;

        sendData("{
            \"success\": true,
            \"total\": $total,
            \"marque\": $marqueTotal,
            \"modele\": $modeleTotal
        }", 200);
        exit();
    }

    // Specific Onduleur
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = intval($_GET['id']);
        
        $data = Onduleur::get($id);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        sendData("{\"success\": true, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    // All Onduleur
    $rows = $_GET['rows'] ?? DEFAULT_ROWS;
    $page = $_GET['page'] ?? 1;
    
    if(isset($ressource) && $ressource == "marques") {
        $data = Onduleur::getAllMarque($page, $rows);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        $total = Onduleur::getMarqueCount()["total"] ?? 0;
        $pages = Onduleur::getMarquePageNumber($rows) ?? 1;

        sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    $data = Onduleur::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Onduleur::getCount()["total"] ?? 0;
    $pages = Onduleur::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
?>