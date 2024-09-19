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
    public function likeMovie($movie_id) {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            echo "Vous devez vous connecter pour aimer ce film.";
            return;
        }
    
        // Récupérer l'ID de l'utilisateur à partir de la session
        $user_id = $_SESSION['user_id'];
    
        // Vérifier si le film existe
        $query = "SELECT id_film FROM movie WHERE id_film = :movie_id";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':movie_id', $movie_id);
        $stmt->execute();
        
        // Afficher le nombre de résultats trouvés pour débogage
        $num_rows = $stmt->rowCount();
        echo "Nombre de films trouvés : " . $num_rows;
        
        if ($num_rows == 0) {
            echo "Le film spécifié n'existe pas.";
            return;
        }
    
        // Préparer la requête pour insérer un like dans la table Liker
        $query = "INSERT INTO Liker (id_film, id_user) VALUES (:movie_id, :user_id)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':movie_id', $movie_id);
        $stmt->bindParam(':user_id', $user_id);
    
        if ($stmt->execute()) {
            echo "Film aimé avec succès.";
        } else {
            echo "Erreur lors de l'ajout du film dans les likes.";
        }
    }
}    