<?php
class ModelAdminFacturation {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getCommande() {
        $stmt = $this->db->query("SELECT * FROM facturation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        
    public function deleteCommande($id) {
        
        $sql = "DELETE FROM facturation WHERE id = :id";
        $stmt= $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }

    public function findCommande($search){
        $sql= "SELECT * FROM facturation WHERE id LIKE :search OR date_creation LIKE :search OR client_id LIKE :search ";
        $stmt = $this->db->prepare($sql);
        $search = $search . '%';
        $stmt->bindParam(':search', $search);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    }

?>