<?php
class ModelAdminCLient {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getClients() {
        $stmt = $this->db->query("SELECT * FROM clients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un client
    public function addClient($nom, $prenom, $email) {
        $sql0 = "SELECT COUNT(*) FROM clients WHERE email = :email";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':email', $email);
        $stmt0->execute();

        $exist=$stmt0->fetchColumn() > 0;

        if ($exist==true) {
            echo 'Ce client existe deja dans la BD';

        }else{
            $stmt = $this->db->prepare("INSERT INTO clients (nom, prenom, email) VALUES (:nom, :prenom, :email)");
            return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email]);
        }
        
    }

    // Supprimer un client
    public function deleteClient($id) {
        $sql0 = "SELECT COUNT(*) FROM clients WHERE id = :id";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':id', $id);
        $stmt0->execute();

        $exist=$stmt0->fetchColumn() > 0;

        if($exist==true){
            $sql1 = "DELETE FROM facturation WHERE client_id = :id";
            $stmt1 = $this->db->prepare($sql1);

            $stmt1->bindParam(':id', $id);
            $stmt1->execute();
        }

        $sql = "DELETE FROM clients WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }

    public function findClient($search){
        $sql= "SELECT * FROM clients WHERE id LIKE :search OR nom LIKE :search OR prenom LIKE :search OR email LIKE :search";
        $stmt = $this->db->prepare($sql);
        $search = $search . '%';
        $stmt->bindParam(':search', $search);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


}
?>