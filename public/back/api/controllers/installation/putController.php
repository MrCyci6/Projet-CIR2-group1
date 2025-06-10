<?php

    $id = array_shift($request);

    $puissance_crete = $_PUT['puissance_crete'];
    $surface = $_PUT['surface'];
    $pente = $_PUT['pente'];
    $pente_optimum = $_PUT['pente_optimum'];
    $orientation = $_PUT['orientation'];
    $orientation_optimum = $_PUT['orientation_optimum'];
    $production_pvgis = $_PUT['production_pvgis'];
    $political = $_PUT['political'];
    $annee = $_PUT['annee'];
    $mois = $_PUT['mois'];
    $latitude = $_PUT['latitude'];
    $longitude = $_PUT['longitude'];
    $code_insee = $_PUT['code_insee'];
    $id_installateur = $_PUT['id_installateur'] ?? "";
    $id_panneau = $_PUT['id_panneau'];
    $nb_panneau = $_PUT['nb_panneau'];
    $id_onduleur = $_PUT['id_onduleur'];
    $nb_onduleur = $_PUT['nb_onduleur'];

    if( !isset($id) ||
        !isset($puissance_crete) || !isset($surface) || !isset($pente) || !isset($pente_optimum) || !isset($orientation) || !isset($orientation_optimum)
        || !isset($production_pvgis) || !isset($political) || !isset($annee) || !isset($mois) || !isset($latitude) || !isset($longitude)
        || !isset($code_insee) || !isset($id_panneau) || !isset($nb_panneau) || !isset($id_onduleur) || !isset($nb_onduleur)
    ) {    
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

  
    if(!Installation::update($id,
        $puissance_crete, $surface, $pente, $pente_optimum, $orientation, $orientation_optimum, 
        $production_pvgis, $political, $annee, $mois, $latitude, $longitude, 
        $code_insee, $id_installateur, $id_panneau, $nb_panneau, $id_onduleur, $nb_onduleur)
    ) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"Installation updated\"}", 200);
?>