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

    // Récupération des films avec option de filtrage par nom via la barre de recherche
    public function dernieraccueilModel($searchQuery = '')
    {
        // Requête SQL pour filtrer par nom de film si une recherche est faite
        $query = "
            SELECT
                movie.id_film,
                movie.nom AS name,
                movie.movie_time,
                movie.poster,
                GROUP_CONCAT(Theme.Nom SEPARATOR ', ') AS theme
            FROM
                movie
            LEFT JOIN
                posseder ON movie.id_film = posseder.id_film
            LEFT JOIN
                Theme ON posseder.id_theme = Theme.id_theme
            WHERE
                movie.nom LIKE :searchQuery
            GROUP BY
                movie.id_film
        ";

        $stmt = $this->bdd->prepare($query);
        $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajout d'un "like" pour un film par un utilisateur
    public function addLike($id_film, $id_user)
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