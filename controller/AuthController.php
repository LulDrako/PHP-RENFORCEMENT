<?php
include_once("BaseController.php");
include_once("model/UserModel.php");

class AuthController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function loginController($username, $password)
{
    $user = $this->model->authenticate($username, $password);
    if ($user) {
        $this->login($user['id']);
        header('Location: index.php?page=home'); // Redirection vers la page d'accueil après connexion
        exit(); // Arrêter le script après redirection
    } else {
        echo "Identifiants incorrects.";
    }
}


    public function registerController($username, $password)
    {
        if ($this->model->register($username, $password)) {
            echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }

    public function logoutController()
    {
        $this->logout();
        header('Location: index.php?page=home'); // Redirection après déconnexion
    }
}
