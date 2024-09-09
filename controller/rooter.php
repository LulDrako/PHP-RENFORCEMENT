<?php

    $page = "";
if (isset($_GET['page'])){
    $page = $_GET['page'];
} 


switch ($page) {
    case 'film':
        include_once('filmController.php');
        $film=new filmController();
        $film->getfilmController();
        break;

        case 'information':
            include_once('filmController.php');
            $film = new filmController();
            $film->showfilmDetails();
            break;


        case 'contact':
            include_once('contactController.php');
            $contact=new contactController();
            $contact->getcontactController();
            break;


        case 'commander':

            include_once('filmController.php');
            $film=new filmController();
            $films = $film->getAllfilmsController();

            break;



        case 'accueil':
            include_once('filmController.php');
            $film=new filmController();
            $film->getAccueilController();
            break;


        default:
            include_once('filmController.php');

            $film=new filmController();
            $film->getAccueilController();
            break;

}