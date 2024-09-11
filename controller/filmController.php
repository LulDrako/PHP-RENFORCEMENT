<?php
include_once("model/filmModel.php");

class filmController
{
    private $model;

    public function __construct()
    {
        $this->model = new filmModel();
    }

    public function getAccueilController()
    {
        // Appelle le modèle pour récupérer les données
        $films = $this->model->dernieraccueilModel();

        // Inclut la vue qui affichera les données
        include("views/Home.php");
    }
}
