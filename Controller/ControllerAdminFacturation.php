<?php
require_once 'Model/ModelAdminFacturation.php';

class ControllerAdminFacturation {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminFacturation();
    }

    
    public function viewAdminCommande() {
        $facturations= $this->model->getCommande(); 
        require 'View/vuAdminFacturation.php';
    }
    
    public function deleteCommande(){
        $id=$_POST['id'];
        $facturations = $this->model->deleteCommande($id); 
        header(header: 'Location: index.php?action=adminFacturation');
        exit;
    }


    public function findCommande(){
        $search=$_POST['search'] ?? '';

        $facturations = $this->model->findCommande($search ); 

        require 'View/vuAdminFacturation.php';

    }
}

?>