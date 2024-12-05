<?php
class ModelPanier {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    //Enregistrement du client + remplissage de la table facturation
    public function enregistrerClient($nom, $prenom, $email, $listeJson) {
        //Recuperation de l'email du client pour voir si le client existe deja
        $sql0 = "SELECT COUNT(*) FROM clients WHERE email = :email";
        $stmt0 = $this->db->prepare($sql0);
        $stmt0->bindParam(':email', $email);
        $stmt0->execute();

        $exist=$stmt0->fetchColumn() > 0;

        //Si le client n'existe pas le creer
        if($exist==false){
            $sql = "INSERT INTO clients (nom, prenom, email) 
            VALUES (:nom, :prenom, :email)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
        }
       
        //Recuperation de l'id du client par rapport a sont email
        $recupId = "SELECT id FROM clients WHERE email = :email";
        $stmt0 = $this->db->prepare($recupId);
        $stmt0->bindParam(':email', $email);
        $stmt0->execute();

        // Récupérer l'ID du client
        $result = $stmt0->fetch(PDO::FETCH_ASSOC); 
        $clientId = $result['id'] ?? null; 

        
        $totalHT=$_SESSION['paiement']['prixHT'];
        $totalTTC=$_SESSION['paiement']['prixTTC'];

        $sql2 = "INSERT INTO facturation (client_id, total_ht, total_ttc, produits) 
             VALUES (:client_id, :total_ht, :total_ttc, :produits)";
        $stmt2 = $this->db->prepare($sql2);

        // Lier les paramètres pour la facturation
        $stmt2->bindParam(':client_id', $clientId);
        $stmt2->bindParam(':total_ht', $totalHT);
        $stmt2->bindParam(':total_ttc', $totalTTC);
        $stmt2->bindParam(':produits', $listeJson);

        // Exécuter  requête
        return $stmt2->execute();
    }

    //Calculer le prix total du panier HT
    public function calculerPrixTotalHT($panier){
    $total = 0;

    if (isset($panier) && is_array($panier)) {
        foreach ($panier as $produit) {
            $total += $produit['prix_public'] * $produit['quantity'];
        }
    }

    return $total;
    }

    //Calculer le prix total du panier TTC

    public function calculerPrixTotalTTC($prixHT){
        $total = $prixHT * 1.2;
        $_SESSION['paiement']['prixHT'] = $prixHT; 
        $_SESSION['paiement']['prixTTC'] = $total;

        
        return $total;
    }


    
    public function send($email, $message) {
        $to = "matheo.moiron@etu.unice.fr"; 
        $subject = "Nouvelle Commande";
        $headers = "De: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
        // Envoi de l'email
        return mail("matheo.moiron@etu.unice.fr", "test", "test");
    }

} 
