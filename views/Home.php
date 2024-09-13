<?php
// Inclusion du header
include 'header.php';

// Requête pour chercher les films si un critère de recherche est présent
$searchQuery = !empty($_GET['search']) ? $_GET['search'] : '';

// Si un critère de recherche est fourni, filtrer les films
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
        <!-- Barre de recherche -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Chercher par nom..." value="<?= htmlspecialchars($searchQuery ?? '') ?>">
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
                    <!-- Ajouter un lien autour de l'image pour rediriger vers la page du film -->
                    <a href="index.php?page=film&id=<?= htmlspecialchars($film['id']); ?>">
                        <img src="<?= htmlspecialchars($film['poster']); ?>" alt="Poster du film" style="width: 150px;">
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucun film trouvé.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Inclusion du footer
include 'footer.php';
?>
