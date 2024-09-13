<?php
// Inclusion du header
include 'header.php';

// Récupérer l'ID du film depuis l'URL
$filmId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($filmId) {
    // Inclure le contrôleur
    include_once('controller/FilmController.php');
    $filmController = new filmController();
    
    // Récupérer les informations du film
    $film = $filmController->getFilmById($filmId);

    if ($film) {
        // Afficher les détails du film
        echo "<h1>" . htmlspecialchars($film['name']) . "</h1>";
        echo "<p>Durée : " . htmlspecialchars($film['movie_time']) . "</p>";
        echo "<p>Thème : " . htmlspecialchars($film['theme']) . "</p>";
        echo "<img src='" . htmlspecialchars($film['poster']) . "' alt='Poster du film' style='width: 150px;'>";

        // Intégration du lecteur vidéo (assurez-vous que 'stream_id' est correctement configuré dans la base)
        if (!empty($film['stream_id'])) {
            echo "<iframe src='https://streamtape.com/e/" . htmlspecialchars($film['stream_id']) . "' width='600' height='400' allowfullscreen></iframe>";
        } else {
            echo "<p>Le lecteur vidéo n'est pas disponible pour ce film.</p>";
        }

        // Afficher le résumé si disponible
        if (!empty($film['resume'])) {
            echo "<p><strong>Résumé :</strong> " . nl2br(htmlspecialchars($film['resume'])) . "</p>";
        } else {
            echo "<p>Résumé non disponible.</p>";
        }

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $movieId = $film['id'];

            // Formulaire pour enregistrer le film
            echo "<form method='POST' action='index.php?page=save_movie'>";
            echo "<input type='hidden' name='movie_id' value='" . $movieId . "'>";
            echo "<button type='submit'>Enregistrer ce film</button>";
            echo "</form>";
        }

    } else {
        echo "<p>Film non trouvé.</p>";
    }
} else {
    echo "<p>Aucun film spécifié.</p>";
}

// Inclusion du footer
include 'footer.php';
?>
