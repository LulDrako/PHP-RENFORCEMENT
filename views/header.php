<?php
// Assurez-vous que la session est démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav>
        <!-- Vos autres éléments de navigation -->

        <div class="user-info">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Bienvenue, <?= htmlspecialchars($_SESSION['username']) ?> !</span>
                <a href="index.php?page=logout">Déconnexion</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
