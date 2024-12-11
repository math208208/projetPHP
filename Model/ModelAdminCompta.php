<?php
class ModelAdminCompta {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function nbCommmande(){
        $sql= "SELECT count(*) FROM facturation ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function nbCookieVendu(){
        $sql= "SELECT SUM(quantity) AS total_quantite FROM facturation, JSON_TABLE(produits, '$[*]' COLUMNS (quantity INT PATH '$.quantity')) AS prod;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
            
        return $stmt->fetchColumn();
        }

    public function grosseCommande(){
        $sql= "SELECT total_ht FROM facturation WHERE total_ht = (SELECT MAX(total_ht) FROM facturation);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();    }

    public function nbCommandeFournisseur(){
        $sql= "SELECt COUNT(*) FROM fournisseur";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();    }


    public function totalCookieAchete(){
        $sql= "SELECt SUM(quantité) FROM fournisseur";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();    }

    public function totalDepense(){
        $sql= "SELECT SUM(fournisseur.quantité*produits.prix_achat) FROM fournisseur, produits WHERE fournisseur.id_cookie=produits.id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();    }

    public function caHT(){
        $sql= "SELECT SUM(total_ht) FROM facturation  ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();    }

    public function result(){
        $ca=$this->caHT();
        $depense=$this->totalDepense();

        return $ca-$depense;

        
    }
}



?>