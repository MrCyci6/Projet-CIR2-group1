<?php

    $puissance_crete = $_GET['puissance_crete'];
    $surface = $_GET['surface'];
    $pente = $_GET['pente'];
    $pente_optimum = $_GET['pente_optimum'];
    $orientation = $_GET['orientation'];
    $orientation_optimum = $_GET['orientation_optimum'];
    $production_pvgis = $_GET['production_pvgis'];
    $political = $_GET['political'];
    $annee = $_GET['annee'];
    $mois = $_GET['mois'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $code_insee = $_GET['code_insee'];
    $id_installateur = $_GET['id_installateur'];
    $id_panneau = $_GET['id_panneau'];
    $nb_panneau = $_GET['nb_panneau'];
    $id_onduleur = $_GET['id_onduleur'];
    $nb_onduleur = $_GET['nb_onduleur'];

    if(
        !isset($puissance_crete) || !isset($surface) || !isset($pente) || !isset($pente_optimum) || !isset($orientation) || !isset($orientation_optimum)
        || !isset($production_pvgis) || !isset($political) || !isset($annee) || !isset($mois) || !isset($latitude) || !isset($longitude)
        || !isset($code_insee) || !isset($id_installateur) || !isset($id_panneau) || !isset($nb_panneau) || !isset($id_onduleur) || !isset($nb_onduleur)
    ) {    
        sendData("{\"success\": false, \"message\": \"Bad Request\"}", 400);
        exit();
    }

  
    if(!Installation::add(
        $puissance_crete, $surface, $pente, $pente_optimum, $orientation, $orientation_optimum, 
        $production_pvgis, $political, $annee, $mois, $latitude, $longitude, 
        $code_insee, $id_installateur, $id_panneau, $nb_panneau, $id_onduleur, $nb_onduleur)
    ) {
        sendData("{\"success\": false, \"message\": \"Internal Server Error\"}", 500);
        exit();
    }

    sendData("{\"success\": true, \"message\": \"User added\"}", 201);
?>