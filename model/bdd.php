<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Bdd {
    public static function connexion() {
        // Charger les variables d'environnement depuis le fichier .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo 'DB_HOST from getenv(): ' . getenv('DB_HOST') . '<br>';
echo 'DB_HOST from $_ENV: ' . $_ENV['DB_HOST'] . '<br>';
echo 'DB_HOST from $_SERVER: ' . $_SERVER['DB_HOST'] . '<br>';


        // Test de la récupération des variables d'environnement
        echo 'DB_HOST: ' . getenv('DB_HOST') . '<br>';
        echo 'DB_USER: ' . getenv('DB_USER') . '<br>';
        echo 'DB_PASS: ' . getenv('DB_PASS') . '<br>';

        try {
            // Utiliser les variables d'environnement pour la connexion à la base de données
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $dbname = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            // Connexion à la base de données
            if (!$host || !$user || !$dbname) {
                die('Erreur : Les informations de connexion sont manquantes.');
            }

            $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            echo "Connexion réussie à la base de données !";
            return $bdd;
        } catch (Exception $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}
