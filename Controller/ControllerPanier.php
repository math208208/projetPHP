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
        $cartModel = new ModelPanier();

        
        //Incrémentation du nombre d'aticle dans le panier
        
        

        if (isset($_POST['product'])) {
            $product = json_decode($_POST['product'], true);

            $quantityMax=$cartModel->qttMaxProduit($product['id']);
            $quantityMax=intval($quantityMax);
            
            $found = false;
            foreach ($_SESSION['panier'] as &$item) {
                if ($item['id'] === $product['id']) {
                    if ($quantityMax<$item['quantity']+1){
                        $found = true;
                        echo "<div style='text-align: center; margin-top: 50px;'>
                        <p style='font-size: 20px;'>Désolé vous avez déjà dans votre panier la quantité restante pour ce produit.</p>
                        </div>";
                        echo "<script>
                        setTimeout(function() {
                        window.location.href = 'index.php?action=afficherProduits';
                        }, 1000); // Redirige après 5 secondes
                        </script>";
                        exit;
                    }else{
                        $item['quantity']++; //Incrémentation de la quantité de l'article
                        $found = true;
                        if (!isset($_SESSION['quantite']['panierQuantity'])) {
                            $_SESSION['quantite']['panierQuantity'] = 1; 
                        } else {
                            $_SESSION['quantite']['panierQuantity']++; 
                        }
                        break;
                    }
                    
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
                    'image' => $product['image'],
                ];
                if (!isset($_SESSION['quantite']['panierQuantity'])) {
                    $_SESSION['quantite']['panierQuantity'] = 1; 
                } else {
                    $_SESSION['quantite']['panierQuantity']++; 
                }
                
            }}

        header("Location: " . $_SERVER['HTTP_REFERER']);


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
         
        $cartModel = new ModelPanier();

        if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_SESSION['panier'])) {
            $productId = $_POST['product_id'];
            foreach ($_SESSION['panier'] as $index => $item) {
                if ($item['id'] == $productId) {
                    $_SESSION['quantite']['panierQuantity']-=$item['quantity'];
                    break;
                }
            }
    
            $quantity = intval($_POST['quantity']); // Transforme en entier
            $quantityMax=$cartModel->qttMaxProduit($_POST['product_id']);
            $quantityMax=intval($quantityMax);

            
            // Parcours le panier et met à jour la quantité
            foreach ($_SESSION['panier'] as &$item) {
                
                if ($item['id'] == $productId) {
                    if($quantity>$quantityMax){
                        $item['quantity'] = max(1, $quantityMax);
                        $_SESSION['quantite']['panierQuantity']+=$quantityMax; // Incrémente de 1 si elle existe déjà
                        echo "<div style='text-align: center; margin-top: 50px;'>
                        <p style='font-size: 20px;'>Désolé vous avez déjà dans votre panier la quantité restante pour ce produit.</p>
                        </div>";
                        echo "<script>
                        setTimeout(function() {
                        window.location.href = 'index.php?action=viewCart';
                        }, 1000); // Redirige après 5 secondes
                        </script>";
                        exit;
                    }else{
                        $item['quantity'] = max(1, $quantity); // Définit une quantité minimale de 1
                        $_SESSION['quantite']['panierQuantity']+=$quantity; // Incrémente de 1 si elle existe déjà
                        break;
                    }
                }
            }
           


        }
        header('Location: index.php?action=viewCart');
        exit;
    }

    //Confirmation du panier renvois sur la vu permettant d'entrer les données du client
    public function confirmerPanier() {
    
        // Vérifie si le panier existe
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            if(isset($_SESSION['client'])){
                $this->finaliserCommande();
            }else{
                require 'View/afficherProduits.php'; 
            }
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
                <meta charset='UTF-8'>
                <style>
                
                    body {
                        font-family: Montserrat;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }
            
                    h1 {
                        color: #504031;
                        text-align: center;
                        margin-bottom: 30px;
                        font-size: 24px;
                    }

                    h4{                    
                        color:  #504031;
                        text-align: start;
                        font-size: 17px;
                        margin-bottom: 14px;

                    }
            
                    .produit {

                        margin-bottom: 25px;
                        padding: 15px;
                        background-color: #f8f4f0;
                        border-radius: 10px;
                    }
            
                    .titre {

                        color: #b08968;
                        font-size: 18px;
                        font-weight:bold;
                        margin-bottom: 10px;
                    }
            
                    .detail {
                        color: #666;
                        margin: 5px 0;
                    }
            
                    .prix {

                        color: #504031;
                        font-weight: bold;
                        margin-top: 10px;
                    }
            
                    .total {

                        margin-top: 30px;
                        font-size: 18px;
                        color: #504031;
                    }
            
                    .total-ttc {

                        color: #b08968;
                        font-weight: bold;
                        font-size: 20px;
                    }

                </style>
            </head>
            <body>
            
                <h1>Récapitulatif de votre commande</h1>
                <h4>Nous vous remercions pour vos achats sur M&A Cookies.
                Votre commande est en cours de préparation.</h4>";
            
                foreach ($cart as $produit) {

                    $message .= "
                    <div class='produit'>

                        <div class='titre'>" . htmlspecialchars($produit['titre']) . "</div>
                        <div class='detail'>" . htmlspecialchars($produit['description']) . "</div>
                        <div class='detail'>Quantité : " . htmlspecialchars($produit['quantity']) . "</div>
                        <div class='prix'>Prix : " . htmlspecialchars($produit['prix_public']) . " €</div>

                    </div>";
                }
            
                $message .= "

                <div class='total'>
                    <div>Total HT : " . htmlspecialchars($totalHT) . " €</div>
                    <div class='total-ttc'>TOTAL TTC : " . htmlspecialchars($totalTTC) . " €</div>
                </div>

            </body>
            </html>";


            // Appel au modèle pour envoyer l'email
            $success = $cartModel->sendClient($message,$email);
        }

    }




    //Confirmation de la commande aprés que le client est entré ses données
    public function finaliserCommande() {
        $clientModel = new ModelPanier();
            
        $listeSimplifiee = [];

        foreach ($_SESSION['panier'] as $article) {
            if (isset($article['id'], $article['quantity'], $article['prix_public'])) {
                $clientModel->decrementQttStock($article['id'],$article['quantity']);
                $listeSimplifiee[] = [
                    'id' => $article['id'],
                    'quantity' => $article['quantity'],
                    'prix_public' => $article['prix_public']
                ];
            }
        }

        $articlesJson=json_encode($listeSimplifiee);
        $mailClient=$_SESSION['client']['email'];
        $clientModel->enregistrerClient($mailClient,$articlesJson);
        $this->sendEmailWebMaster();
        $this->sendEmailClient($_SESSION['client']['email'],$_SESSION['client']['nom'],$_SESSION['client']['prenom'],$articlesJson);
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
        exit;
        
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