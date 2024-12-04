<?php 
    session_start(); // Démarrage de la session
    
    require_once "View/common/header.php"; 
    require_once 'Controller/ControllerProduit.php';
    require_once 'Controller/ControllerPanier.php';
    require_once 'Controller/ControllerAdminClient.php';
    require_once 'Controller/ControllerAdminProduit.php';
    require_once 'Controller/ControllerAdminFacturation.php';
    require_once 'Controller/ControllerAdminFournisseur.php';




    $action = $_GET['action'] ?? 'afficherProduits';

    //Création du controller
    $controller = new ControllerProduit();
    $panierController = new ControllerPanier();
    $adminControllerClient=new ControllerAdminClient();
    $adminControllerProduit=new ControllerAdminProduit();
    $adminControllerFacturation=new ControllerAdminFacturation();
    $adminControllerFournisseur=new ControllerAdminFournisseur();



    switch ($action) {
        //Cas principal affichage des produits
        case 'afficherProduits':
            $controller->afficherProduits();
            break;
        
        //Gestion du panier
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

        //Confirmation du panier
        case 'confirmerPanier': 
            $panierController->confirmerPanier();
            break;
        case 'finaliserCommande':
            $panierController->finaliserCommande();
            break;
        
        //Gestion de la table Client
        case 'adminClient':
            $adminControllerClient->viewAdminClient();
            break;
        case 'deleteClient':
            $adminControllerClient->deleteClient();
            break;
        case 'addClient':
            $adminControllerClient->addClient();
            break;
        case 'findClient':
            $adminControllerClient->findClient();
            break;

        //Gestion de la table produit + gestion_stock
        case 'adminProduit':
            $adminControllerProduit->viewAdminProduit();
            break;
        case 'deleteProduit':
            $adminControllerProduit->deleteProduit();
            break;
        case 'addProduit':
            $adminControllerProduit->addProduit();
            break;
        case 'findProduit':
            $adminControllerProduit->findProduit();
            break;

        //Gestion de la table facturation
        case 'adminFacturation':
            $adminControllerFacturation->viewAdminCommande();
            break;
        case 'findCommande':
            $adminControllerFacturation->findCommande();
            break;
        case 'deleteCommande':
            $adminControllerFacturation->deleteCommande();
            break;

        //Gestion de la table fournisseur
        case 'adminFournisseur':
            $adminControllerFournisseur->viewAdminFournisseur();
            break;
        case 'findFournisseur':
            $adminControllerFournisseur->findFournisseur();
            break;
        case 'addFournisseur':
            $adminControllerFournisseur->addFournisseur();
            break;
        case 'deleteFournisseur':
            $adminControllerFournisseur->deleteFournisseur();
            break;
        
        
        default:
            echo "Action non reconnue.";
}
?>






</body>
</html>