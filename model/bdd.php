<?php

class Bdd{

    public static function connexion()
    {
        try {
            $bdd= new PDO("mysql:host=localhost;port=3306;dbname=film","root","768223");
            return $bdd;
        } catch (Exception $e) {
            die( $e->getMessage());
        }
    }
}
