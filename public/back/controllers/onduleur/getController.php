<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {

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

    $data = Onduleur::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Onduleur::getCount()["total"] ?? 0;
    $pages = Onduleur::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
?>