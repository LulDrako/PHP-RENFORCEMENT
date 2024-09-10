<?php
include_once("../model/Bdd.php");

class filmModel
{
    private $bdd;

    public function __construct()
    {
        // Connexion à la base de données via la classe Bdd
        $this->bdd = Bdd::connexion();
    }

    public function dernieraccueilModel()
    {
        // Requête pour récupérer tous les films
        $query = "SELECT * FROM movie";
        $result = $this->bdd->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

