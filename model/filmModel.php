<?php
class FilmModel {
    private $db;

    public function __construct() {
        $this->db = Bdd::connexion(); // Connexion à la base de données
    }

    // Récupérer les films pour la page d'accueil (les plus récents)
    public function dernieraccueilModel() {
        $query = "SELECT * FROM movie ORDER BY release_date DESC LIMIT 10";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un film spécifique par son ID
    public function getFilmById($id) {
        $query = "SELECT * FROM movie WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
