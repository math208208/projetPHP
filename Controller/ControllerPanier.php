<?php
require_once 'Model/ModelPanier.php';

class ControllerPanier {
    private $cartModel;

    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function addToCart() {
        if (isset($_POST['product'])) {
            $product = json_decode($_POST['product'], true);

            // Vérifie si le produit est déjà dans le panier
            $found = false;
            foreach ($_SESSION['panier'] as &$item) {
                if ($item['id'] === $product['id']) {
                    $item['quantity']++; // Incrémente la quantité si le produit existe déjà
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $_SESSION['panier'][] = [
                    'id' => $product['id'],
                    'titre' => $product['titre'],
                    'description' => $product['description'],
                    'prix_public' => $product['prix_public'],
                    'quantity' => 1 // Ajoute la quantité initiale
                ];
        }}
        header('Location: index.php?action=afficherProduits');
        exit;
        
    }
    

    public function removeFromCart() {

        if (isset($_POST['product_id']) && isset($_SESSION['panier'])) {
            $productId = $_POST['product_id'];

            // Parcours le panier et supprime l'article correspondant
            foreach ($_SESSION['panier'] as $index => $item) {
                if ($item['id'] == $productId) {
                    unset($_SESSION['panier'][$index]);
                    break;
                }
            }
    
            // Réindexe le tableau pour éviter des indices décalés
            $_SESSION['panier'] = array_values($_SESSION['panier']);
        }

        header('Location: index.php?action=viewCart');
        exit;
    }
    public function updateCart() {
    
        if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_SESSION['panier'])) {
            $productId = $_POST['product_id'];
            $quantity = intval($_POST['quantity']); // Transforme en entier
    
            // Parcours le panier et met à jour la quantité
            foreach ($_SESSION['panier'] as &$item) {
                if ($item['id'] == $productId) {
                    $item['quantity'] = max(1, $quantity); // Définit une quantité minimale de 1
                    break;
                }
            }
        }
    
        
        // Recharge la vue du panier
        header('Location: index.php?action=viewCart');
        exit;
    }


    public function confirmerPanier() {
    
        // Vérifie si le panier existe
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            require 'View/vuConfirmerPanier.php'; // Charge la vue pour entrer les informations client
        } else {
            // Si le panier est vide, rediriger vers la page des produits
            header('Location: index.php?action=afficherProduits');
            exit;
        }
    }


    public function finaliserCommande() {

        // Vérifie si le panier existe et si les informations client ont été soumises
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email']) && isset($_SESSION['panier'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
    
            $clientModel = new ModelPanier();

            if ($clientModel->enregistrerClient($nom, $prenom, $email)) {
                // Message de confirmation
                echo "Merci, votre commande a bien été enregistrée. Vous allez recevoir un email de confirmation.";

                // Vider le panier après la commande
                unset($_SESSION['panier']);
            } else {
                echo "Une erreur est survenue lors de l'enregistrement de votre commande.";
            }
        } else {
            // Si le panier est vide ou les informations manquent, rediriger
            header('Location: index.php?action=afficherProduits');
            exit;
        }
    }
    public function viewCart() {
        $cart = $_SESSION['panier']; // Récupérer le panier depuis la session
        require 'View/vuPanier.php'; // Charger la vue du panier
    }


   
}
