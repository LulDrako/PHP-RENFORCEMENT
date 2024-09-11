<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : '';

switch ($page) {
    case 'home':
        include_once(__DIR__."/filmController.php");
        $film = new filmController();
        $film->getAccueilController();
        break;
    case 'login':
        
        include_once(__DIR__.'/AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->loginController($_POST['username'], $_POST['password']);
        } else {
            include('../views/login.php'); // Affiche le formulaire de connexion
        }
        break;
    case 'register':
        include_once(__DIR__.'/AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->registerController($_POST['email'], $_POST['username'],  $_POST['password']);
        } else {
            include('../views/register.php'); // Affiche le formulaire d'inscription
        }
        break;
    case 'logout':
        include_once(__DIR__.'/AuthController.php');
        $auth = new AuthController();
        $auth->logoutController();
        break;
    default:
        include_once(__DIR__.'/filmController.php');
        $film = new filmController();
        $film->getAccueilController();
        break;
}
