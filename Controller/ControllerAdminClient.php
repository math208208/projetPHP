<?php
require_once 'Model/ModelAdminClient.php';

class ControllerAdminCLient {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminClient();
    }

    
    public function viewAdminClient() {
        $clients = $this->model->getClients(); 
        require 'View/vuAdminClient.php';
    }
    
    public function deleteClient(){
        $id=$_POST['id'];
        $clients = $this->model->deleteClient($id); 
        header(header: 'Location: index.php?action=adminClient');
        exit;
    }

    public function addClient(){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $email=$_POST['email'];
        $clients = $this->model->addClient($nom,$prenom,$email ); 
        header(header: 'Location: index.php?action=adminClient');
        exit;
    }

    public function findClient(){
        $search=$_POST['search'] ?? '';

        $clients = $this->model->findClient($search ); 
        require 'View/vuAdminClient.php';

    }
}

?>