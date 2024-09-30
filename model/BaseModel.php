<?php
abstract class BaseModel
{
    protected $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    // Méthode abstraite pour les opérations spécifiques aux modèles
    abstract public function getData();
}