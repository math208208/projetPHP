<?php 
    session_start(); // Démarrage de la session
    
    require_once "View\common\header.php"; 
    require_once 'Controller/ControllerProduit.php';
    require_once 'Controller/ControllerPanier.php';
    require_once 'Controller/ControllerAdminClient.php';



    $action = $_GET['action'] ?? 'afficherProduits';

    //Création du controller
    $controller = new ControllerProduit();
    $panierController = new ControllerPanier();
    $adminController=new ControllerAdminClient();


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
        case 'admin':
            $adminController->viewAdminClient();
            break;
        case 'deleteClient':
            $adminController->deleteClient();
            break;
        case 'addClient':
            $adminController->addClient();
            break;
        case 'findClient':
            $adminController->findClient();
            break;
        default:
            echo "Action non reconnue.";
}
?>






</body>
</html>