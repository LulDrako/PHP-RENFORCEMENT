<?php
// Inclusion du fichier header
include("views/header.php");

// Inclusion du router (gère le contenu principal de la page)
include("controller/router.php");

// Si tu souhaites inclure un fichier spécifique pour le contenu de la page d'accueil
include("view/home.php"); 

// Inclusion du fichier footer (depuis la branche main)
include("views/footer.php");
?>
