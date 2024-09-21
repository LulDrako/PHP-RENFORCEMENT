<?php
include_once("Bdd.php");

class filmModel
{
    private $bdd;

    public function __construct()
    {
        // Connexion à la base de données via la classe Bdd
        $this->bdd = Bdd::connexion();
    }

    public function dernieraccueilModel()
    {
        // Requête pour récupérer tous les films avec les thèmes associés
        $query = "
            SELECT
                movie.id_movie,
                movie.name,
                movie.movie_time,
                movie.poster,
                GROUP_CONCAT(Theme.Nom SEPARATOR ', ') AS theme
            FROM
                movie
            LEFT JOIN
                posseder ON movie.id_movie = posseder.id_movie
            LEFT JOIN
                Theme ON posseder.id_theme = Theme.id_theme
            GROUP BY
                movie.id_movie
        ";

        $result = $this->bdd->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC); // On récupère toutes les lignes
    }

    public function likeMovie($user_id, $movie_id)
    {
        try {
            $query = "INSERT INTO liker (id_users, id_movie) VALUES (:user_id, :movie_id)";
            $stmt = $this->bdd->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':movie_id', $movie_id);
    
            if ($stmt->execute()) {
                echo "Film aimé avec succès.";
            } else {
                echo "Erreur lors de l'ajout du film dans les likes.";
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    
}
?>