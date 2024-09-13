<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Bdd {

    public static function connexion()
    {
        // Charger les variables d'environnement à partir du fichier .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        try {
            // Connexion à la base de données
            $bdd = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
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
