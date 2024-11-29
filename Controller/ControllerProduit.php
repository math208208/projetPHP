<?php 
require 'Model/ModelProduit.php';

class ControllerProduit {
    
    public function afficherProduits() {
        //Création du model
        $model = new ModelProduit();
        $produits = $model->getAllProduits();
        include 'View/vuPublique.php';
    }
    
    
}



?>