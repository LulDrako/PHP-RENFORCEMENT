<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Charger l'autoload pour Dotenv

use Dotenv\Dotenv;

class Bdd {

    public static function connexion()
    {
        // Charger les variables d'environnement à partir du fichier .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Assure-toi que ton .env est bien dans le répertoire parent
        $dotenv->load(); // Charger les variables .env dans $_ENV

        try {
            // Connexion à la base de données en utilisant les variables d'environnement
            $bdd = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
            // Activer les erreurs PDO pour un meilleur débogage
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd; // Retourner l'instance de PDO

        } catch (Exception $e) {
            // Log de l'erreur dans un fichier log
            $logMessage = date('Y-m-d H:i:s') . ' - Erreur de connexion à la BDD : ' . $e->getMessage() . "\n";
            error_log($logMessage, 3, __DIR__ . '/../logs/bdd.log'); // Log dans le fichier /logs/bdd.log
            // Message d'erreur générique pour l'utilisateur
            die("Une erreur s'est produite lors de la connexion à la base de données.");
        }
    }
}

