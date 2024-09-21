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
        // Vérification si l'utilisateur a déjà liké ce film
        $checkLike = $this->bdd->prepare('SELECT * FROM Liker WHERE id_film = :id_film AND id_user = :id_user');
        $checkLike->execute([
            'id_film' => $id_film,
            'id_user' => $id_user
        ]);

        // Si l'utilisateur n'a pas encore liké, on insère un nouveau like
        if ($checkLike->rowCount() == 0) {
            $insertLike = $this->bdd->prepare('INSERT INTO Liker (id_film, id_user) VALUES (:id_film, :id_user)');
            $insertLike->execute([
                'id_film' => $id_film,
                'id_user' => $id_user
            ]);

            // Retourne "true" si le like a bien été inséré
            return true;
        }

        // Si le film est déjà liké, retourner "false"
        return false;
    }
}
?>
