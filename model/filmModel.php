<?php
include_once("Bdd.php");

class VeloModel
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
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}