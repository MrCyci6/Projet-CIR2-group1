<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {
        $total = Localite::getCount();
        $regionTotal = Localite::getRegionCount();
        $departementTotal = Localite::getDepartementCount();
        $paysTotal = Localite::getPaysCount();

        sendData("{
            \"success\": true,
            \"localite\": $total,
            \"region\": $regionTotal,
            \"departement\": $departementTotal,
            \"pays\": $paysTotal
        }", 200);
        exit();
    }

    // Specific Localite
    if(isset($_GET['code_insee']) && !empty($_GET['code_insee'])) {
        $code_insee = intval($_GET['code_insee']);
        
        $data = Localite::get($code_insee);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        sendData("{\"success\": true, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    // All Localite
    $rows = $_GET['rows'] ?? DEFAULT_ROWS;
    $page = $_GET['page'] ?? 1;

    $data = Localite::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Localite::getCount() ?? 0;
    $pages = Localite::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
?>