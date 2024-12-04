<?php
require_once 'Model/ModelPanier.php';

class ControllerPanier {
    private $cartModel;

    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    //Ajouter un élément au pannier
    public function addToCart() {

        //Incrémentation du nombre d'aticle dans le panier
        if (!isset($_SESSION['quantite']['panierQuantity'])) {
            $_SESSION['quantite']['panierQuantity'] = 1; 
        } else {
            $_SESSION['quantite']['panierQuantity']++; 
        }
        

        if (isset($_POST['product'])) {
            $product = json_decode($_POST['product'], true);

            
            $found = false;
            foreach ($_SESSION['panier'] as &$item) {
                if ($item['id'] === $product['id']) {
                    $item['quantity']++; //Incrémentation de la quantité de l'article
                    $found = true;
                    break;
                }

                
            }
            //Si l'article n'existe pas deja dans le panier le creer
            if (!$found) {
                $_SESSION['panier'][] = [
                    'id' => $product['id'],
                    'titre' => $product['titre'],
                    'description' => $product['description'],
                    'prix_public' => $product['prix_public'],
                    'quantity' => 1 ,
                ];
                
            }}

        header('Location: index.php?action=afficherProduits');
        exit;
        
    }
    
    //Suppression d'un article du panier
    public function removeFromCart() {
        
        if (isset($_POST['product_id']) && isset($_SESSION['panier'])) {
            $productId = $_POST['product_id'];
            // Parcours le panier et supprime l'article correspondant
            foreach ($_SESSION['panier'] as $index => $item) {
                if ($item['id'] == $productId) {
                    $_SESSION['quantite']['panierQuantity']-=$item['quantity'];
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

    //Mise a jour de la quantité d'un article
    public function updateCart() {
         

        if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_SESSION['panier'])) {
            $productId = $_POST['product_id'];
            foreach ($_SESSION['panier'] as $index => $item) {
                if ($item['id'] == $productId) {
                    $_SESSION['quantite']['panierQuantity']-=$item['quantity'];
                    break;
                }
            }
    
            $quantity = intval($_POST['quantity']); // Transforme en entier


            // Parcours le panier et met à jour la quantité
            foreach ($_SESSION['panier'] as &$item) {
                if ($item['id'] == $productId) {
                    $item['quantity'] = max(1, $quantity); // Définit une quantité minimale de 1
                    break;
                }
            }
            $_SESSION['quantite']['panierQuantity']+=$quantity; // Incrémente de 1 si elle existe déjà


        }
        header('Location: index.php?action=viewCart');
        exit;
    }

    //Confirmation du panier renvois sur la vu permettant d'entrer les données du client
    public function confirmerPanier() {
    
        // Vérifie si le panier existe
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            require 'View/vuConfirmerPanier.php'; 
        } else {
            header('Location: index.php?action=afficherProduits');
            exit;
        }
    }

    public function sendEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = "M&ACookieCommande@gmail.com";
            $message="Il y a une nouvelle commande de cookie !";


            // Appel au modèle pour envoyer l'email
            $emailModel = new ModelPanier();
            $success = $emailModel->send($email, $message);
        }
    }
    //Confirmation de la commande aprés que le client est entré ses données
    public function finaliserCommande() {

        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email']) && isset($_SESSION['panier'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            
            $listeSimplifiee = [];

            foreach ($_SESSION['panier'] as $article) {
                if (isset($article['id'], $article['quantity'], $article['prix_public'])) {
                    $listeSimplifiee[] = [
                        'id' => $article['id'],
                        'quantity' => $article['quantity'],
                        'prix_public' => $article['prix_public']
                    ];
                }
            }

            $articlesJson=json_encode($listeSimplifiee);

            
            
            
            $clientModel = new ModelPanier();
            
            if ($clientModel->enregistrerClient($nom, $prenom, $email, $articlesJson)) {
                //$this->sendEmail();
                $_SESSION['quantite']['panierQuantity']=0;

                 // Afficher le message de confirmation avec un délai
                echo "<div style='text-align: center; margin-top: 50px;'>
                <p style='font-size: 20px;'>Merci, votre commande a bien été enregistrée. Vous allez recevoir un email de confirmation.</p>
                </div>";
                 echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php?action=afficherProduits';
                }, 4000); // Redirige après 5 secondes
                </script>";

                // Vider le panier après la commande
                unset($_SESSION['panier']);

            
            } else {
                echo "<div style='text-align: center; margin-top: 50px;'>
                <p style='font-size: 20px; color: red;'>Une erreur est survenue lors de l'enregistrement de votre commande.</p>
                </div>";
            }
        } else {
            header(header: 'Location: index.php?action=afficherProduits');
            exit;
        }
    }



    









    public function viewCart() {
        $cart = $_SESSION['panier']; // Récupérer le panier depuis la session
        $model = new ModelPanier();

        // Vérifie si le panier existe
        $panier = $_SESSION['panier'] ?? [];
        $prixTotalHT = $model->calculerPrixTotalHT($panier);
        $prixTotalTTC = $model->calculerPrixTotalTTC($prixTotalHT);


        require 'View/vuPanier.php';
    }


   
}
