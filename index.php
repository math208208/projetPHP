<?php 
    session_start(); // Démarrage de la session
    
    require_once "View\common\header.php"; 
    require_once 'Controller/ControllerProduit.php';
    require_once 'Controller/ControllerPanier.php';
    require_once 'Controller/ControllerAdminClient.php';
    require_once 'Controller/ControllerAdminProduit.php';



    $action = $_GET['action'] ?? 'afficherProduits';

    //Création du controller
    $controller = new ControllerProduit();
    $panierController = new ControllerPanier();
    $adminControllerClient=new ControllerAdminClient();
    $adminControllerProduit=new ControllerAdminProduit();


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
        default:
            echo "Action non reconnue.";
}
?>






</body>
</html>