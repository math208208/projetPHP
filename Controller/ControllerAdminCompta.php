<?php 
require_once 'Model/ModelAdminCompta.php';

class ControllerAdminCompta {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminCompta();
    }

    public function viewAdminCompta() {
        
        /* pour pouvoir choisir deux dates */
        $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : date('Y-01-01');
        $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : date('Y-m-d');
        
        $model = $this->model;
        
        $nbCommande = $model->nbCommmande($date_debut, $date_fin);
        $nbCookieVendu = $model->nbCookieVendu($date_debut, $date_fin);
        $plusGrosseCom = $model->grosseCommande($date_debut, $date_fin);
        $nbComFourni = $model->nbCommandeFournisseur($date_debut, $date_fin);
        $nbTotalCookieAchette = $model->totalCookieAchete($date_debut, $date_fin);
        $totalDepense = $model->totalDepense($date_debut, $date_fin);
        $CAht = $model->caHT($date_debut, $date_fin);
        $result = $model->result($date_debut, $date_fin);



        require 'View/vuAdminCompta.php';

    }

    
    
    

}




?>