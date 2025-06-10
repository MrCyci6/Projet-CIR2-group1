<?php
    if(!Session::isUserLogged()) {
        header("Location: login");
        exit();
    }
    
    $selected = "installations";
    
    require 'views/components/header.php';
    require 'views/installation.php';
    require 'views/components/footer.php';

?>