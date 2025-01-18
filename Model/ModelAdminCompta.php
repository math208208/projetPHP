<?php
class ModelAdminCompta {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function nbCommmande($date_debut, $date_fin){

        $sql = "SELECT count(*) FROM facturation WHERE date_creation BETWEEN ? AND ?"; //prend les parametres qu'on a mis donc between date_debut et date_fin
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function nbCookieVendu($date_debut, $date_fin){

        $sql = "SELECT SUM(quantity) AS total_quantite FROM facturation, JSON_TABLE(produits, '$[*]' COLUMNS (quantity INT PATH '$.quantity')) AS prod 
                WHERE date_creation BETWEEN ? AND ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function grosseCommande($date_debut, $date_fin){

        $sql = "SELECT total_ht FROM facturation WHERE date_creation BETWEEN ? AND ? AND total_ht = (SELECT MAX(total_ht) FROM facturation 
                WHERE date_creation BETWEEN ? AND ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin, $date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function nbCommandeFournisseur($date_debut, $date_fin){

        $sql = "SELECT COUNT(*) FROM fournisseur WHERE date_commande BETWEEN ? AND ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function totalCookieAchete($date_debut, $date_fin){

        $sql = "SELECT SUM(quantité) FROM fournisseur WHERE date_commande BETWEEN ? AND ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function totalDepense($date_debut, $date_fin){

        $sql = "SELECT SUM(fournisseur.quantité*produits.prix_achat) FROM fournisseur, produits WHERE fournisseur.id_cookie=produits.id AND fournisseur.date_commande BETWEEN ? AND ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function caHT($date_debut, $date_fin){

        $sql = "SELECT SUM(total_ht) FROM facturation WHERE date_creation BETWEEN ? AND ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date_debut, $date_fin]);
        return $stmt->fetchColumn();
    }
 
    public function result($date_debut, $date_fin){

        $ca = $this->caHT($date_debut, $date_fin);
        $depense = $this->totalDepense($date_debut, $date_fin);
        
        return $ca - $depense;
    }
        

       
    }




?>