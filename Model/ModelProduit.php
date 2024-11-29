<?php 

class ModelProduit{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }
    
    public function getAllProduits() {
        $stmt = $this->db->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    



?>