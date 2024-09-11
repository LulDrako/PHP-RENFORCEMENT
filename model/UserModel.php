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
        // Note : Les mots de passe ne doivent pas être stockés en clair. Utilisez plutôt hash() pour les vérifier.
        $query = "SELECT id, username FROM users WHERE username = :username AND password = :password";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Assurez-vous que le mot de passe est correctement haché
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($email, $username, $password)
    {
        // Note : Assurez-vous que le mot de passe est haché avant de le stocker
        $query = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Assurez-vous que le mot de passe est correctement haché
        return $stmt->execute();
    }
}
