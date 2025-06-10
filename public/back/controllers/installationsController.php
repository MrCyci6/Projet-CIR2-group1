<?php

    if(!Session::isUserLogged()) {
        header("Location: login");
        exit();
    }

    $selected = "installations";
    
    require 'views/components/header.php';
    require 'views/installations.php';
    require 'views/components/footer.php';

?>