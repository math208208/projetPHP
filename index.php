<?php 
    session_start(); // Démarrage de la session
    require_once "View\common\header.php"; 
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
        case 'updateCart':
            $panierController->updateCart();
            break;         
        case 'removeFromCart':
            $panierController->removeFromCart();
            break;
        case 'confirmerPanier': // Nouvelle action pour confirmer le panier
            $panierController->confirmerPanier();
            break;
        case 'finaliserCommande':
            $panierController->finaliserCommande();
            break;
        default:
            echo "Action non reconnue.";
}
?>






</body>
</html>