<?php
include_once("../model/Bdd.php");

class filmModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    public function dernieraccueilModel()
    {
        $query = "SELECT * FROM movie";
        $result = $this->bdd->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

