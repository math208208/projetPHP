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

    public function addFournisseur($nom, $id_cookie, $quantite,) {
        $stmt = $this->db->prepare("INSERT INTO fournisseur (nom, id_cookie, quantité) 
                                    VALUES (:nom, :id_cookie, :quantite)");
        return $stmt->execute([
            ':nom' => $nom,
            ':id_cookie' => $id_cookie,
            ':quantite' => $quantite,
        ]);
    }

    public function deleteFournisseur($id) {
        $sql = "DELETE FROM fournisseur WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

    public function findFournisseur($search){
        $sql= "SELECT * FROM fournisseur WHERE id LIKE :search OR nom LIKE :search OR id_cookie LIKE :search OR quantité LIKE :search";
        $stmt = $this->db->prepare($sql);
        $search = $search . '%';
        $stmt->bindParam(':search', $search);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function modifierProduit($id,$qtt){
        $sql= "UPDATE gestion_stock SET quantité = quantité+:quantite WHERE produit_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':quantite', $qtt);
        return $stmt->execute();

    }
}
?>