<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

class Bdd{

    public static function connexion()
    {
        // Charger les variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        try {
            // Créer une connexion PDO en utilisant les informations du fichier .env
            $bdd = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
            return $bdd;
        } catch (Exception $e) {
            // Enregistrer l'erreur dans le fichier log
            $logFilePath = __DIR__ . $_ENV['LOG_FILE_PATH'];
            file_put_contents($logFilePath, $e->getMessage() . "\n", FILE_APPEND);

            die("Une erreur est survenue. Veuillez consulter le fichier log pour plus de détails.");
        }
    }
}
