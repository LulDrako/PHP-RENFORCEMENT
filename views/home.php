<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <header>
        <h1>Liste des films</h1>
        <!-- Search bar -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Chercher par nom..." value="<?= htmlspecialchars($searchQuery ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>
    </header>
    <?php if (!empty($films)) : ?>
    <ul>
        <?php foreach ($films as $film) : ?>
            <li>
                <strong>Nom :</strong> <?= htmlspecialchars($film['nom']); ?><br>
                <strong>Durée :</strong> <?= htmlspecialchars($film['movie_Time']); ?><br>
                <strong>Thème :</strong> <?= htmlspecialchars($film['theme']); ?><br>
                <img src="<?= htmlspecialchars($film['poster']); ?>" alt="Poster du film" style="width: 150px;"><br>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="index.php?page=like">
                        <input type="hidden" name="movie_id" value="<?= htmlspecialchars($film['id_film']); ?>">
                        <button type="submit">Aimer</button>
                    </form>
                <?php else: ?>
                    <p><a href="index.php?page=login">Connectez-vous</a> pour aimer ce film.</p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php?page=likedMovies" class="btn">Voir les films aimés</a>
<?php else : ?>
    <p>Aucun film trouvé.</p>
<?php endif; ?>
