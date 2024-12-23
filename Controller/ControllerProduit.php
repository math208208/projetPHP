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


    public function searchProduits() {
        $model = new ModelProduit();
        $stock=$model->getStock();
        $nouveaute = ['id'=>7, 'titre'=>"Cookie aux saveurs cannelle et muscade",
        'description'=> "Laissez-vous séduire par nos nouveaux cookies aux saveurs d\'épices douces. Un mélange parfait de cannelle et de muscade pour un moment de pure gourmandise.",
        'prix_public'=> 3.50, 'image'=> 'assets/cookie7.png']; //cookie cannelle


        $searchTerm = $_POST['search']; // Terme de recherche
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $produitsParPage = 8; // Produits par page

        // Calcul de l'offset pour la pagination
        $page = ($page - 1) * $produitsParPage;

        // Récupérer les produits filtrés
        $produits = $model->getProduitsBySearch($searchTerm, $produitsParPage, $page);

        // Calculer le nombre total de pages
        $totalProduits = $model->countProduitsBySearch($searchTerm);
        $totalPages = ceil($totalProduits / $produitsParPage);

        // Inclure la vue
        include 'View/vuPublique.php';
    }

    public function filterByCategory() {
        $model = new ModelProduit();
        $stock=$model->getStock();
        $nouveaute = ['id'=>7, 'titre'=>"Cookie aux saveurs cannelle et muscade",
        'description'=> "Laissez-vous séduire par nos nouveaux cookies aux saveurs d\'épices douces. Un mélange parfait de cannelle et de muscade pour un moment de pure gourmandise.",
        'prix_public'=> 3.50, 'image'=> 'assets/cookie7.png']; //cookie cannelle

        $category = $_POST['category'] ?? 'all';
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $produitsParPage = 8; // Nombre de produits par page
        $page = ($page - 1) * $produitsParPage;
    
        // Récupérer les produits filtrés avec pagination
        $produits = $model->getProduitsByCategoryAndPagination($category, $produitsParPage, $page);
    
        // Calculer le nombre total de pages
        $totalProduits = $model->countProduitsByCategory($category);
        $totalPages = ceil($totalProduits / $produitsParPage);
    
        // Inclure la vue
        include_once 'View/vuPublique.php';
    }
    

    
}




?>