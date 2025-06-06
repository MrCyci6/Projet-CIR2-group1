<?php

    $ressource = array_shift($request);
    if(isset($ressource) && $ressource == "stats") {
        $surfaceTotal = Installation::getSurfaceTotal(); // m²
        $productionTotal = Installation::getProductionTotal(); // kWh
        $puissanceTotal = Installation::getPuissanceTotal(); // kWc
        
        $surfaceAverage = Installation::getSurfaceAverage(); // m²
        $productionAverage = Installation::getProductionAverage(); // kWh
        $puissanceAverage = Installation::getPuissanceAverage(); // kWc

        $byYear = Installation::getByAnne();
        $byRegion = Installation::getByRegion();

        sendData("{
            \"success\": true, 
            \"surface_m2\": {
                \"total\": $surfaceTotal, 
                \"average\": $surfaceAverage
            }, 
            \"production_kwh\": {
                \"total\": $productionTotal, 
                \"average\": $productionAverage
            }, 
            \"puissance_kwc\": {
                \"total\": $puissanceTotal, 
                \"average\": $puissanceAverage
            }, 
            \"by_year\": ".json_encode($byYear).", 
            \"by_region\": ".json_encode($byRegion)."
        }", 200);
        exit();
    }else if(isset($ressource) && $ressource == "search") {
        $page = $_GET['page'] ?? 1;
        $rows = $_GET['rows'] ?? DEFAULT_ROWS;
        $id_onduleur = $_GET['id_onduleur'] ?? null;
        $id_panneau = $_GET['id_panneau'] ?? null;
        $code_departement = $_GET['code_departement'] ?? null;
        $annee = $_GET['annee'] ?? null;

        if(!isset($_GET['query']) || empty($_GET['query'])) {
            sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
            exit();
        }

        $query = $_GET['query'];
        $data = Installation::search(
            $query, 
            $page, 
            $rows, 
            $id_onduleur == 0 ? null : $id_onduleur, 
            $id_panneau == 0 ? null : $id_panneau, 
            $code_departement == 0 ? null : $code_departement, 
            $annee);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        $total = Installation::getSearchCount($query, $page, $rows, $id_onduleur, $id_panneau, $code_departement, $annee);
        $pages = ceil($total/$rows);

        sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
        exit();
    }

    // Specific installation
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = intval($_GET['id']);
        

        $data = Installation::get($id);
        if(!is_array($data) && !$data) {
            sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
            exit();
        }

        sendData("{\"success\": true, \"data\": ".json_encode($data)."}", 200);

        exit();
    }

    // All installations
    $rows = $_GET['rows'] ?? DEFAULT_ROWS;
    $page = $_GET['page'] ?? 1;

    $data = Installation::getAll($page, $rows);
    if(!is_array($data) && !$data) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    $total = Installation::getCount()["total"] ?? 0;
    $pages = Installation::getPageNumber($rows) ?? 1;

    sendData("{\"success\": true, \"total\": $total, \"pages\": $pages, \"per_page\": $rows, \"data\": ".json_encode($data)."}", 200);
?>