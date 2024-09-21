<?php
include_once("BaseController.php");
include_once("model/filmModel.php");

class FilmController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new filmModel(); // Utiliser la classe correcte
    }

    // Afficher la page d'accueil
    public function getAccueilController()
    {
        // Récupérer la requête de recherche si elle existe
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    
        // Appelle le modèle pour récupérer les données, avec la recherche si présente
        $films = $this->model->dernieraccueilModel($searchQuery);
    
        // Inclut la vue qui affichera les données
        include("views/Home.php");
    }    

    public function likeFilm($id_film, $id_user) {
        // Utiliser le modèle déjà instancié
        $this->model->addLike($id_film, $id_user);
        
        // Rediriger vers la page précédente après avoir liké
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>
