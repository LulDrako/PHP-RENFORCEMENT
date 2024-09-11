<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

switch ($page) {
    case 'home':
        include_once('filmController.php');
        $film = new filmController();
        $film->getAccueilController();
        break;
    case 'login':
        include_once('AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->loginController($_POST['username'], $_POST['password']);
        } else {
            include('views/login.php'); // Affiche le formulaire de connexion
        }
        break;
    case 'register':
        include_once('AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->registerController($_POST['username'], $_POST['password']);
        } else {
            include('views/register.php'); // Affiche le formulaire d'inscription
        }
        break;
    case 'logout':
        include_once('AuthController.php');
        $auth = new AuthController();
        $auth->logoutController();
        break;
    default:
        include_once('filmController.php');
        $film = new filmController();
        $film->getAccueilController();
        break;
}
