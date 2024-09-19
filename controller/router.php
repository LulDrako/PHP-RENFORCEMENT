<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Route en fonction de la page demandée
switch ($page) {
    case 'home':
        include_once(__DIR__ . "/filmController.php");
        $film = new FilmController();
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
            include(__DIR__ . '/../views/login.php');
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
            include(__DIR__ .'/../views/register.php');
        }
        break;

    case 'logout':
        include_once(__DIR__ . '/AuthController.php');
        $auth = new AuthController();
        $auth->logoutController();
        break;

    default:
        include_once(__DIR__ . '/filmController.php');
        $film = new FilmController();
        $film->getAccueilController();
        break;
}

// Gestion de l'action 'likeFilm' indépendamment de la page
if ($action === 'likeFilm' && isset($_GET['id_film']) && isset($_GET['id_user'])) {
    include_once(__DIR__ . '/filmController.php');
    $filmController = new FilmController();
    $filmController->likeFilm($_GET['id_film'], $_GET['id_user']);
}
?>
