<?php
// Assuming $films is your array of films

// Check if a search query is submitted
$searchQuery = !empty($_GET['search']) ? $_GET['search'] : '';

// Filter films by name if search query exists
if (!empty($searchQuery)) {
    $films = array_filter($films, function ($film) use ($searchQuery) {
        return stripos($film['name'], $searchQuery) !== false;
    });
}
?>

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

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Ajouter un bouton pour aimer le film -->
                        <form method="POST" action="index.php?page=like">
    <input type="hidden" name="movie_id" value="<?= htmlspecialchars($film['id_movie']); ?>">
    <button type="submit">Aimer</button>
</form>


                    <?php else: ?>
                        <p><a href="index.php?page=login">Connectez-vous</a> pour aimer ce film.</p>
                    <?php endif; ?>
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
