<?php
// Assurez-vous que la session est démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<header>
    <nav>
        <!-- Vos autres éléments de navigation -->

        <div class="user-info">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Bienvenue, <?= htmlspecialchars($_SESSION['username']) ?> !</span>
                <a href="index.php?page=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?page=login">Se connecter</a>
                <a href="index.php?page=home" class="btn">Home</a>
                <a href="index.php?page=register">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

</body>
</html>
