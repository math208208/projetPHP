<?php 
session_start();
      
require_once "View/common/header.php"; 
require_once 'Controller/ControllerProduit.php';
require_once 'Controller/ControllerPanier.php';

$action = $_GET['action'] ?? 'afficherProduits';

$controller = new ControllerProduit();
$panierController = new ControllerPanier();

switch ($action) {


    case 'afficherProduits':
        
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
    case 'confirmerPanier': 
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
