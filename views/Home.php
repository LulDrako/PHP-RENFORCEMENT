<?php if (!empty($films)) : ?>
    <h1>Liste des films</h1>
    <ul>
        <?php foreach ($films as $film) : ?>
            <li>
                <strong>Nom :</strong> <?= htmlspecialchars($film['name']); ?><br>
                <strong>Durée :</strong> <?= htmlspecialchars($film['movie_time']); ?><br>
                <strong>Thème :</strong> <?= htmlspecialchars($film['theme']); ?>
            </li>
        <?php endforeach; ?>
        
    </ul>
    <a href="index.php?page=register" class="btn">register</a>
    <a href="index.php?page=login" class="btn">login</a>
<?php else : ?>
    <p>Aucun film trouvé.</p>
<?php endif; ?>
