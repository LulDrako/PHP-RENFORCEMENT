<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Bdd {

    public static function connexion()
    {
        // Charger les variables d'environnement depuis le fichier .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        try {
            // Utiliser les variables d'environnement pour la connexion à la base de données
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $dbname = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            // Connexion à la base de données
            $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les erreurs PDO
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $bdd;
        } catch (Exception $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}
