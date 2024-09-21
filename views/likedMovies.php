<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
</head>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../model/UserModel.php");

$userModel = new UserModel();
$likedMovies = $userModel->getLikedMovies($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films Aimés</title>
</head>
<body>
    <header>
        <h1>Films Aimés</h1>
        <a href="index.php">Retour à l'accueil</a>
    </header>

    <?php if (!empty($likedMovies)) : ?>
        <ul>
            <?php foreach ($likedMovies as $movie) : ?>
                <li>
                    <strong>Nom :</strong> <?= htmlspecialchars($movie['nom']); ?><br>
                    <strong>Durée :</strong> <?= htmlspecialchars($movie['movie_Time']); ?><br>
                    <img src="<?= htmlspecialchars($movie['poster']); ?>" alt="Poster du film" style="width: 150px;"><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucun film aimé.</p>
    <?php endif; ?>
</body>
</html>
