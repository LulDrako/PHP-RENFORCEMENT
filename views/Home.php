<?php
// Inclure le fichier qui contient la classe filmModel
include_once("C:/wamp64/www/Nouveau dossier/PHP-RENFORCEMENT/model/filmModel.php");

// Créer une instance de filmModel
$filmModel = new filmModel();

// Appeler la méthode dernieraccueilModel pour récupérer tous les films
$films = $filmModel->dernieraccueilModel();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Page d'accueil</h1>

    <?php if ($films && count($films) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Durée</th>
                    <th>Thème</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($films as $film): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($film['name']); ?></td>
                        <td><?php echo htmlspecialchars($film['movie_time']); ?></td>
                        <td><?php echo htmlspecialchars($film['theme']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun film trouvé.</p>
    <?php endif; ?>
</body>
</html>
