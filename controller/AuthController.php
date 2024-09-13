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
            $this->setSession('user_id', $user['id']);
            $this->setSession('username', $user['username']);
            
            // Redirection après connexion
            header('Location: index.php?page=home');
            exit();
        } else {
            header('Location: index.php?page=register');
            exit();
        }
    }
    
    public function likeMovieController($movie_id)
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $this->model->likeMovie($user_id, $movie_id);
        }
        header('Location: index.php?page=home');
        exit();
    }
    
    public function registerController($email, $username, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide.";
            return;
        }

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
?>
