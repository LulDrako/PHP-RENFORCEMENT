<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films</title>
</head>
<body>
    <header>
        <h1>Liste des films</h1>
        <!-- Search bar -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Chercher par nom..." value="<?= htmlspecialchars($searchQuery) ?>">
            <button type="submit">Rechercher</button>
        </form>
    </header>

    <?php if (!empty($films)) : ?>
        <ul>
            <?php foreach ($films as $film) : ?>
                <li>
                    <strong>Nom :</strong> <?= htmlspecialchars($film['name']); ?><br>
                    <strong>Durée :</strong> <?= htmlspecialchars($film['movie_time']); ?><br>
                    <strong>Thème :</strong> <?= htmlspecialchars($film['theme']); ?><br>
                    <!-- Ajouter une image du film -->
                    <img src="<?= htmlspecialchars($film['poster']); ?>" alt="Poster du film" style="width: 150px;"><br>

                    <!-- Formulaire pour ajouter un like -->
                    <form method="POST" action="index.php?page=like">
                        <input type="hidden" name="movie_id" value="<?= htmlspecialchars($film['id_film']); ?>">
                        <button type="submit">Like</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php?page=register" class="btn">register</a>
        <a href="index.php?page=login" class="btn">login</a>
    <?php else : ?>
        <p>Aucun film trouvé.</p>
    <?php endif; ?>
</body>
</html>
