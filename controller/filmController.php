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
}
