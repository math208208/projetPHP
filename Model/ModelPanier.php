<?php
class ModelPanier {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function enregistrerClient($nom, $prenom, $email) {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO clients (nom, prenom, email) 
                VALUES (:nom, :prenom, :email)";
        $stmt = $this->db->prepare($sql);

        // Lier les paramètres à la requête
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);

        // Exécuter la requête
        return $stmt->execute();
    }

    
}
