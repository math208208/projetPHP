<?php 
require_once 'Model/ModelProduit.php';

class ControllerProduit {
    
    public function afficherProduits() {

        $model = new ModelProduit();
        $produits = $model->getAllProduits(); 
        
 
        include_once 'View/vuPublique.php'; 
    }
}




?>