<?php
include_once("BaseController.php");
include_once("../model/UserModel.php");

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
            header('Location: index.php?page=home');
        } else {
            echo "Identifiants incorrects.";
        }
    }

    public function registerController($email, $username, $password)
    {
        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide.";
            return; // Stoppe l'exécution si l'email est invalide
        }

        // Tentative d'inscription de l'utilisateur
        if ($this->model->register($email, $username, $password)) {
            echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }

    public function logoutController()
    {
        $this->logout();
        header('Location: index.php?page=home');
    }
}
