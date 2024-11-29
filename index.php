<?php 
    require 'Controller/ControllerProduit.php';
    require 'Controller/ControllerPanier.php';
    
    
    $action = $_GET['action'] ?? 'afficherProduits';
    
    //Création du controller
    $controller = new ControllerProduit();
    $panierController = new ControllerPanier();
    
    
    switch ($action) {
        case 'afficherProduits':
            //Cas principal lors du lancement de index
            $controller->afficherProduits();
            break;
        case 'addToCart':
            $panierController->addToCart();
            break;
        case 'viewCart':
            $panierController->viewCart();
            break;
        default:
            echo "Action non reconnue.";
    }
?>