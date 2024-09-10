<?php
include_once("model/filmModel.php");

    public function getAccueilController()
    {
        $lastVelo = $this->model->dernieraccueilModel();
        include("view/accueil.php");
    }