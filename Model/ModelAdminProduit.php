<?php
class ModelAdminProduit {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getProduits() {
        $stmt = $this->db->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduit($reference,$description,$prixPublic,$prixAchat,$image,$icone,$titre,$descriptif ) {
        $sql0 = "SELECT COUNT(*) FROM produits WHERE reference = :reference OR titre = :titre";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':reference', $reference);
        $stmt0->bindParam(':titre', $titre);
        $stmt0->execute();

        $exist = $stmt0->fetchColumn() > 0;

        if ($exist == true) {
            echo 'Ce produit existe déjà dans la BD';
        } else {
            $sql = "INSERT INTO produits (reference, description, prix_public, prix_achat, image, icone, titre, descriptif) 
                    VALUES (:reference, :description, :prixPublic, :prixAchat, :image, :icone, :titre, :descriptif)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':reference', $reference);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prixPublic', $prixPublic);
            $stmt->bindParam(':prixAchat', $prixAchat);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':icone', $icone);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':descriptif', $descriptif);
            
            return $stmt->execute();

            

        }
        
    }

    public function addStock($seuil,$quantite){
        $id = $this->db->lastInsertId();
        $sql1="INSERT INTO gestion_stock (produit_id,seuil_critique,quantité) VALUES (:id,:seuil,:quantite)";
        $stmt1 = $this->db->prepare($sql1);

        $stmt1->bindParam(':id', $id);
        $stmt1->bindParam(':seuil', $seuil);
        $stmt1->bindParam(':quantite', $quantite);
        return $stmt1->execute();
    }


    public function modifierProduit($id,$qtt){
        $sql= "UPDATE gestion_stock SET quantité = :quantite WHERE produit_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':quantite', $qtt);
        return $stmt->execute();

    }

    public function deleteProduit($id) {
        $sql0 = "SELECT COUNT(*) FROM gestion_stock WHERE produit_id = :id";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':id', $id);
        $stmt0->execute();

        $exist=$stmt0->fetchColumn() > 0;

        if($exist==true){
            $sql1 = "DELETE FROM gestion_stock WHERE produit_id = :id";
            $stmt1 = $this->db->prepare($sql1);

            $stmt1->bindParam(':id', $id);
            $stmt1->execute();
        }

        $sql = "DELETE FROM produits WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }

    public function findProduit($search){
        $sql= "SELECT * FROM produits WHERE id LIKE :search OR titre LIKE :search ";
        $stmt = $this->db->prepare($sql);
        $search = $search . '%';
        $stmt->bindParam(':search', $search);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function getStock(){
        $sql= "SELECT * FROM gestion_stock";
        $stmt = $this->db->prepare($sql);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>