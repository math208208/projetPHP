<?php 
require_once 'Model/ModelAdminCompta.php';

class ControllerAdminCompta {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminCompta();
    }

    public function viewAdminCompta() {
        $model = $this->model;
        
        $nbCommande= $model->nbCommmande();
        $nbCookieVendu=$model->nbCookieVendu();
        $plusGrosseCom=$model->grosseCommande();
        $nbComFourni=$model->nbCommandeFournisseur();
        $nbTotalCookieAchette=$model->totalCookieAchete();
        $totalDepense=$model->totalDepense();
        $CAht=$model->caHT();
        $result=$model->result();

        require 'View/vuAdminCompta.php';
    }
    
    

}




?>