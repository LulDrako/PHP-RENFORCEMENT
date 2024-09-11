<?php
include_once("model/filmModel.php");

class FilmController
{
    private $model;

    public function __construct()
    {
        $this->model = new filmModel(); // Assurez-vous que le nom de la classe du modèle correspond
    }

    public function getAccueilController()
    {
        // Appelle le modèle pour récupérer les données
        $films = $this->model->dernieraccueilModel();

        // Inclut la vue qui affichera les données
        include("views/Home.php"); // Assurez-vous que le chemin de la vue est correct
    }
}
?>
