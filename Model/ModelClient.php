<?php 

class ModelClient{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }
    
    
    public function enregistrerClient($nom, $prenom, $email, $tel, $adresse) {
        //Recuperation de l'email du client pour voir si le client existe deja
        $sql0 = "SELECT COUNT(*) FROM clients WHERE email = :email";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':email', $email);
        $stmt0->execute();

        $exist=$stmt0->fetchColumn() > 0;

        //Si le client n'existe pas le creer
        if($exist==false){
            $sql = "INSERT INTO clients (nom, prenom, email, tel, adresse) 
            VALUES (:nom, :prenom, :email, :tel, :adresse)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', var: $email);
            $stmt->bindParam(':tel', var: $tel);
            $stmt->bindParam(':adresse', var: $adresse);


            $stmt->execute();
        }
       
        return;
    }

    

}
    



?>