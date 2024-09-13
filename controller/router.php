<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Route en fonction de la page demandée
switch ($page) {
    case 'home':
        include_once(__DIR__ . "/filmController.php");
        $film = new filmController();
        $film->getAccueilController();
        break;

    case 'login':
        include_once(__DIR__ . '/AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assurez-vous que 'username' et 'password' sont présents
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $auth->loginController($_POST['username'], $_POST['password']);
            } else {
                echo "Données manquantes pour la connexion.";
            }
        } else {
            include('../views/login.php');
        }
        break;

    case 'register':
        include_once(__DIR__ . '/AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assurez-vous que 'email', 'username', et 'password' sont présents
            if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
                $auth->registerController($_POST['email'], $_POST['username'], $_POST['password']);
            } else {
                echo "Données manquantes pour l'inscription.";
            }
        } else {
            include('../views/register.php');
        }
        break;
    
        case 'like':
            include_once(__DIR__ . '/AuthController.php');
            $auth = new AuthController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id'])) {
                $movie_id = $_POST['movie_id'];
                $auth->likeMovieController($movie_id);
            }
            break;
        

    case 'logout':
        include_once(__DIR__ . '/AuthController.php');
        $auth = new AuthController();
        $auth->logoutController();
        break;
        include_once(__DIR__ . '/AuthController.php');
        $auth = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id'])) {
            $movie_id = $_POST['movie_id'];
            $auth->likeMovieController($movie_id);
        }
        break;

    default:
        include_once(__DIR__ . '/filmController.php');
        $film = new filmController();
        $film->getAccueilController();
        break;
}
?>