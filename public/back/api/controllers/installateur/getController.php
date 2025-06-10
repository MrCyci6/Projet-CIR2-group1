<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {
        $total = Installateur::getCount();

        sendData("{\"success\": true, \"total\": $total}", 200);
        exit();
    }

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $installateur = Installateur::get($_GET['id']);

        sendData("{\"success\": true, \"data\": ".json_encode($installateur)."}", 200);
        exit();
    }

    $rows = $_GET['rows'] ?? DEFAULT_ROWS;
    $page = $_GET['page'] ?? 1;

    $data = Installateur::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Installateur::getCount() ?? 0;
    $pages = Installateur::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);

?>