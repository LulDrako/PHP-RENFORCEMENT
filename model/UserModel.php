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
        $query = "SELECT id, username FROM users WHERE username = :username AND password = :password";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($username, $password)
    {
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
