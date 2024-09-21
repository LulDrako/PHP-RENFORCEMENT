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
                movie.id_film,
                movie.nom,
                movie.movie_Time,
                movie.poster,
                GROUP_CONCAT(theme.Nom SEPARATOR ', ') AS theme
            FROM
                movie
            LEFT JOIN
                posseder ON movie.id_film = posseder.id_film
            LEFT JOIN
                theme ON posseder.id_theme = theme.id_theme
            GROUP BY
                movie.id_film
        ";

        $result = $this->bdd->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC); // On récupère toutes les lignes
    }

    public function likeMovie($user_id, $movie_id)
    {
        try {
            $query = "INSERT INTO liker (id_film, id_user) VALUES (:movie_id, :user_id)";
            $stmt = $this->bdd->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':movie_id', $movie_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    
    public function getLikedMovies($user_id)
    {
        $query = "SELECT movie.* FROM liker JOIN movie ON liker.id_film = movie.id_film WHERE liker.id_user = :user_id";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
?>
