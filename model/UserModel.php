<?php
include_once("Bdd.php");

class UserModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Bdd::connexion();
    }

    public function authenticate($username, $password)
    {
        $query = "SELECT id_users AS id, username FROM users WHERE username = :username AND password = :password";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($email, $username, $password)
    {
        $query = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
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
