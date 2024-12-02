<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Panier - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/vuPanier.css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
    
</head>
<body>
    <main>
        <h1>Votre Panier</h1>


        <div class="produits">
            <?php if (!empty($cart)): ?>


                <?php foreach ($cart as $produit): ?>


                    <div class="element">

                        <div class="infos-produits">

                            <h3><?= $produit['titre'] ?></h3>

                            <p><?= $produit['description'] ?></p>

                            <h4>Prix: <?= $produit['prix_public'] ?> €</h4>
                        </div>


                        <form method="post" action="index.php?action=updateCart" class="quantity-form">
                            <input type="hidden" name="product_id" value="<?= $produit['id'] ?>">
                            <label for="quantity">Quantité</label>
                            <input type="number" name="quantity" value="<?= $produit['quantity'] ?>" min="1">
                            <button type="submit">Mettre à jour</button>
                        </form>


                        <form method="post" action="index.php?action=removeFromCart">
                            <input type="hidden" name="product_id" value='<?= $produit['id'] ?>'>
                            <button type="submit">Supprimer</button>
                        </form>

                    </div>

                <?php endforeach; ?>
                
                <p>Total HT : <?= htmlspecialchars($prixTotalHT) ?> €</p>
                <p>Montant a payer (TTC): <?= htmlspecialchars($prixTotalTTC) ?> €</p>

                <div class="cart-confirmation">
                    <form action="index.php?action=confirmerPanier" method="post">
                        <button type="submit">Confirmer le panier</button>
                    </form>
                </div>

            <?php else: ?>
                
                <p class="empty-cart">Votre panier est vide.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
