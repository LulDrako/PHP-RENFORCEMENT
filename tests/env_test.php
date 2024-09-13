<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$logFile = __DIR__ . '/../logs/env.log';

$logMessage = "Variables d'environnement :\n";
$logMessage .= "DB_HOST=" . $_ENV['DB_HOST'] . "\n";
$logMessage .= "DB_PORT=" . $_ENV['DB_PORT'] . "\n";
$logMessage .= "DB_NAME=" . $_ENV['DB_NAME'] . "\n";
$logMessage .= "DB_USER=" . $_ENV['DB_USER'] . "\n";
$logMessage .= "DB_PASS=" . $_ENV['DB_PASS'] . "\n";

file_put_contents($logFile, $logMessage);

echo "Les variables d'environnement ont été enregistrées dans le fichier env.log";
