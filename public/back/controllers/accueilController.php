<?php
    if(!Session::isUserLogged()) {
        header("Location: login");
        exit();
    }
    
    $selected = "accueil";
    
    require 'views/components/header.php';
    require 'views/accueil.php';
    require 'views/components/footer.php';

?>