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

        header('Location: index.php?action=afficherProduits#nos-cookies');
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

    public function sendEmailWebMaster() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message="Il y a une nouvelle commande de cookie !";

            $cartModel = new ModelPanier();

            // Appel au modèle pour envoyer l'email
            $success = $cartModel->sendEmailWebMaster($message);
        }
    }

    public function sendEmailClient($email,$nom,$prenom,$articlesJson) {
        $cartModel = new ModelPanier();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $totalHT=$_SESSION['paiement']['prixHT'];
            $totalTTC=$_SESSION['paiement']['prixTTC'];
            $cart= $_SESSION['panier'];
            
            
        $message = "
                <html lang='fr'>
                <head>
                    <title>Panier - M&A Cookies</title>
                    <meta charset='UTF-8'>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .produits { margin-top: 20px; }
                        .element { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
                        .empty-cart { color: red; }
                    </style>
                </head>
                <body>
                    <main>
                        <h1>Votre Panier</h1>
                        <div class='produits'>";

                foreach ($cart as $produit) {
                    $message .= "
                        <div class='element'>
                            <div class='infos-produits'>
                                <h3>" . htmlspecialchars($produit['titre']) . "</h3>
                                <p>" . htmlspecialchars($produit['description']) . "</p>
                                <h4>Prix: " . htmlspecialchars($produit['prix_public']) . " €</h4>
                            </div>
                            <p>Quantité: " . htmlspecialchars($produit['quantity']) . "</p>
                        </div>";
                }

                $message .= "
                        <p>Total HT : " . htmlspecialchars($totalHT) . " €</p>
                        <p>Montant à payer (TTC): " . htmlspecialchars($totalTTC) . " €</p>";

            $message .= "
                        </div>
                    </main>
                </body>
                </html>";


            // Appel au modèle pour envoyer l'email
            $success = $cartModel->sendClient($message,$email);
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
                $this->sendEmailWebMaster();
                $this->sendEmailClient($email,$nom,$prenom,$articlesJson);
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
