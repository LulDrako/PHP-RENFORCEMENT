<?php
include_once("controller/FilmController.php");
include_once("controller/AuthController.php");

$film = new FilmController();
$auth = new AuthController();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';  // Par défaut, la page d'accueil

switch ($page) {
    case 'home':
        // Appeler la méthode qui affiche la page d'accueil sans redirection
        $film->getAccueilController();
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->loginController($_POST['username'], $_POST['password']);
        } else {
            include('views/login.php');
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->registerController($_POST['username'], $_POST['password']);
        } else {
            include('views/register.php');
        }
        break;

    case 'film':
        if (isset($_GET['id'])) {
            $film->afficherFilm($_GET['id']);  // Appeler la méthode pour afficher les détails d'un film
        } else {
            echo "Aucun film spécifié.";
        }
        break;

    case 'logout':
        $auth->logoutController();
        break;

    default:
        // Par défaut, affiche la page d'accueil
        $film->getAccueilController();
        break;
}
?>
