<?php
    // Inclusion du fichier header
    include("../views/header.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    
    // Inclusion du router (gère le contenu principal de la page)
    include("../controller/router.php");

    // Inclusion du fichier footer
    include("../views/footer.php");
