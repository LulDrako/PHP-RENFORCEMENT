<?php
include_once("BaseController.php");
include_once("model/filmModel.php");

class FilmController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new filmModel();
    }

    // Afficher la page d'accueil
    public function getAccueilController()
    {
        // Récupérer les films pour la page d'accueil
        $films = $this->model->dernieraccueilModel();
        include('views/Home.php');
    }

    // Afficher un film spécifique par son ID
    public function afficherFilm($id)
    {
        $film = $this->model->getFilmById($id);
        if ($film) {
            include('views/film.php'); // Page vue pour afficher les détails du film
        } else {
            echo "Film non trouvé.";
        }
    }
}
