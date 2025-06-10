<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {
        $total = Panneau::getCount();
        $marqueTotal = Panneau::getMarqueCount();
        $modeleTotal = Panneau::getModeleCount();

        sendData("{
            \"success\": true,
            \"total\": $total,
            \"marque\": $marqueTotal,
            \"modele\": $modeleTotal
        }", 200);

        exit();
    }

    // Specific panneau
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = intval($_GET['id']);
        
        $data = Panneau::get($id);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        sendData("{\"success\": true, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    // All panneau
    $rows = $_GET['rows'] ?? DEFAULT_ROWS;
    $page = $_GET['page'] ?? 1;
    
    if(isset($ressource) && $ressource == "marques") {
        $data = Panneau::getAllMarque($page, $rows);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        $total = Panneau::getMarqueCount()["total"] ?? 0;
        $pages = Panneau::getMarquePageNumber($rows) ?? 1;

        sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    $data = Panneau::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Panneau::getCount()["total"] ?? 0;
    $pages = Panneau::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
?>