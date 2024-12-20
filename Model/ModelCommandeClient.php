<?php 

class ModelCommandeClient{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }
    
    
    public function getIdClient($mail){
        $sql = "SELECT id FROM clients WHERE email = :mail";

    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR); 
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['id'];
        }

        return null;

    
    }

    public function getCommandeById($idClient){
        $sql= "SELECT * FROM facturation WHERE client_id=:id_client";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_client', $idClient);



        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    

}
    



?>