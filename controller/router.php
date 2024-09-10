<?php
    $page = isset($_GET['page']) ? $_GET['page'] : '';

    switch ($page) {
        case 'home':
            include_once('filmController.php');
            $film = new filmController();
            $film->getAccueilController();
            break;
        
        default:
            include_once('filmController.php');
            $film = new filmController();
            $film->getAccueilController();
            break;
    }
?>
