<?php 
require_once 'Model/ModelCommandeClient.php';

class ControllerCommandeClient {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new ModelCommandeClient();
    }

    public function afficherCommande() {
        $idClient=$this->clientModel->getIdClient($_SESSION['client']['email']);
        $commandes=$this->clientModel->getCommandeById($idClient);
        include_once 'View/vuCommandeClient.php'; 



    }
}
            





?>