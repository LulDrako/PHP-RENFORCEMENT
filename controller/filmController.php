<?php
include_once("BaseController.php");
include_once("../model/filmModel.php");

class filmController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new filmModel();
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
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $this->model->likeMovie($user_id, $movie_id);
        } else {
            echo "Vous devez être connecté pour aimer un film.";
        }
        header('Location: index.php?page=home');
        exit();
    }
    

}