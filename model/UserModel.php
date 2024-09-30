<?php
include_once("Bdd.php");

class UserModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    // Authentification de l'utilisateur
    public function authenticate($username, $password)
    {
        $query = "SELECT id_user AS id, username FROM Utilisateur WHERE username = :username AND password = :password";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Enregistrement d'un nouvel utilisateur
    public function register($email, $username, $password)
    {
        $query = "INSERT INTO Utilisateur (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    // Enregistrement d'un film liké par l'utilisateur
    public function likeMovie($user_id, $movie_id)
{
    try {
        $query = "INSERT INTO liker (id_film, id_user) VALUES (:movie_id, :user_id)";
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

    public function getLikedMovies($user_id)
{
    $query = "
        SELECT movie.id_film, movie.nom, movie.movie_Time, movie.poster
        FROM liker
        JOIN movie ON liker.id_film = movie.id_film
        WHERE liker.id_user = :user_id
    ";
    $stmt = $this->bdd->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function emailExists($email)
{
    $query = "SELECT COUNT(*) FROM Utilisateur WHERE email = :email";
    $stmt = $this->bdd->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}


}

?>