<?php 
require_once 'Model/ModelProduit.php';

class ControllerProduit {
    
    public function afficherProduits() {

        $model = new ModelProduit();
        $produits = $model->getAllProduits(); 
        $stock=$model->getStock();
        #pour pouvoir afficher la box nouveaute avec le cookie cannelle 
        $nouveaute = ['id'=>7, 'titre'=>"Cookie aux saveurs cannelle et muscade",
        'description'=> "Laissez-vous séduire par nos nouveaux cookies aux saveurs d\'épices douces. Un mélange parfait de cannelle et de muscade pour un moment de pure gourmandise.",
        'prix_public'=> 3.50, 'image'=> 'assets/cookie7.png']; //cookie cannelle
        
 
        include_once 'View/vuPublique.php'; 
    }
}




?>