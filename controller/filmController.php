<?php
include_once("model/filmModel.php");

class FilmController {
    public function getAccueilController()
    {
        $lastVelo = $this->model->dernieraccueilModel();
        include("view/home.php");
    } 
}


    