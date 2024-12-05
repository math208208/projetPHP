<?php
class ModelAdminFournisseur {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getFournisseur() {
        $stmt = $this->db->query("SELECT * FROM fournisseur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFournisseur($nom, $produit, $quantite, $uniteMesure) {
        $stmt = $this->db->prepare("INSERT INTO fournisseur (nom, produit, quantité, unitéMesure) 
                                    VALUES (:nom, :produit, :quantite, :uniteMesure)");
        return $stmt->execute([
            ':nom' => $nom,
            ':produit' => $produit,
            ':quantite' => $quantite,
            ':uniteMesure' => $uniteMesure
        ]);
    }

    public function deleteFournisseur($id) {
        $sql = "DELETE FROM fournisseur WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

    public function findFournisseur($search){
        $sql= "SELECT * FROM fournisseur WHERE id LIKE :search OR nom LIKE :search OR produit LIKE :search OR unitéMesure LIKE :search OR quantité LIKE :search";
        $stmt = $this->db->prepare($sql);
        $search = $search . '%';
        $stmt->bindParam(':search', $search);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


}
?>