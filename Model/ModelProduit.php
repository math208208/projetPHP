<?php 

class ModelProduit{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }
    
    //Permet de recuperer tout les produits de la table produits
    public function getAllProduits() {
        $stmt = $this->db->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    



?>
