<?php 

class ModelProduit{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getStock(){
        $sql= "SELECT * FROM gestion_stock";
        $stmt = $this->db->prepare($sql);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
    public function getProduitsPagines($page, $produitsParPage) {
        $start = ($page - 1) * $produitsParPage;
        $sql = "SELECT * FROM produits LIMIT :start, :produitsParPage";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':produitsParPage', $produitsParPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNombreProduits() {
        $sql = "SELECT COUNT(*) AS total FROM produits";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
    



?>