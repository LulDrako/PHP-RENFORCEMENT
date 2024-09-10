<?php
include_once("model/veloModel.php");

class filmController
{
    private $model;

    public function __construct()
    {
        $this->model = new filmModel();
    }
}
public function getAccueilController()
    {
        $lastVelo = $this->model->dernieraccueilModel();
        include("views/home.php");
    }