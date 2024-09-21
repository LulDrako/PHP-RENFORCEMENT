<?php
include_once("BaseController.php");
include_once("../model/FilmModel.php");

class FilmController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new FilmModel();
    }

    public function handleRequest()
    {
        $this->getAccueilController();
    }

    public function getAccueilController()
    {
        $films = $this->model->dernieraccueilModel();
        include("../views/Home.php");
    }

    public function likeMovieController($movie_id)
    {
        if ($this->isAuthenticated()) {
            $user_id = $this->getSession('user_id');
            if ($this->model->likeMovie($user_id, $movie_id)) {
                $_SESSION['message'] = "Film aimé avec succès.";
            } else {
                $_SESSION['message'] = "Erreur lors de l'ajout du film dans les likes.";
            }
        } else {
            $_SESSION['message'] = "Vous devez être connecté pour aimer un film.";
        }
        header('Location: index.php?page=home');
        exit();
    }

    public function getLikedMoviesController()
    {
        if ($this->isAuthenticated()) {
            $user_id = $this->getSession('user_id');
            $likedMovies = $this->model->getLikedMovies($user_id);
            include('../views/likedMovies.php');
        } else {
            header('Location: index.php?page=login');
            exit();
        }
    }
}
?>
