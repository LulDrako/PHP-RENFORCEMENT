<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Bdd {

    public static function connexion()
    {
        try {
            $bdd= new PDO("mysql:host=localhost;port=3306;dbname=film","","");
            return $bdd;

        } catch (Exception $e) {
            // Log de l'erreur
            $logMessage = date('Y-m-d H:i:s') . ' - Erreur de connexion à la BDD : ' . $e->getMessage() . "\n";
            error_log($logMessage, 3, __DIR__ . '/../logs/bdd.log');
            // Message d'erreur générique pour l'utilisateur
            die("Une erreur s'est produite lors de la connexion à la base de données.");
        }
    }
}
