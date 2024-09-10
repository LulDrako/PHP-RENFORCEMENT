<?php
include_once("Bdd.php");

class filmModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    public function dernieraccueilModel()
    {
        $films = $this->model->dernieraccueilModel();

        /*desdde*/ 
        include("views/home.php");
    }
}
