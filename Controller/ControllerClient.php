<?php 
require_once 'Model/ModelClient.php';

class ControllerClient {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new ModelClient();
    }

    public function afficherConnexion() {
        require 'View/vuConnexionClient.php'; 

    }
    

    public function connexionClient() {

        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'],$_POST['tel'],$_POST['tel'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $adresse = $_POST['adresse'];
            


            $_SESSION['client'] = [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'tel' => $tel,
                'adresse' => $adresse,
            ];

            $this->clientModel->enregistrerClient($nom, $prenom, $email,$tel,$adresse);

            

        }
        if($_SESSION['acceCommande']===true){
            $_SESSION['acceCommande']=false;
            header(header: 'Location: index.php?action=afficherCommande');
        }else{
            header(header: 'Location: index.php?action=viewCart');
        }
        


        
    }

    function decoClient(){
        unset($_SESSION['client']);
        echo "<div style='text-align: center; margin-top: 50px;'>
        <p style='font-size: 20px;'>Vous allez être déconnecté !</p>
        </div>";
            echo "<script>
        setTimeout(function() {
            window.location.href = 'index.php?action=afficherProduits';
        }, 4000); // Redirige après 5 secondes
        </script>";

    }

    
}   
            





?>