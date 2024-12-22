<?php 
require_once 'Model/ModelProduit.php';

class ControllerProduit {
    
    public function afficherProduits() {
        $model = new ModelProduit();
        $stock=$model->getStock();

        $nouveaute = ['id'=>7, 'titre'=>"Cookie aux saveurs cannelle et muscade",
        'description'=> "Laissez-vous séduire par nos nouveaux cookies aux saveurs d\'épices douces. Un mélange parfait de cannelle et de muscade pour un moment de pure gourmandise.",
        'prix_public'=> 3.50, 'image'=> 'assets/cookie7.png']; //cookie cannelle
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $produitsParPage = 8;

        $produits = $model->getProduitsPagines($page, $produitsParPage);

        $totalProduits = $model->getNombreProduits();

        // Calculer le nombre total de pages
        $totalPages = ceil($totalProduits / $produitsParPage);

        require 'View/vuPublique.php';
    }



    
}




?>