<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

</head>
<body>
<main>
        <h1>Votre Panier</h1>
        <div>
        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $produit): ?>
                <div>
                    <h3><?= $produit['titre'] ?></h3>
                    <p><?= $produit['description'] ?></p>
                    <h4>Prix: <?= $produit['prix_public'] ?> €</h4>

                    <form method="post" action="index.php?action=updateCart">
                    <input type="hidden" name="product_id" value="<?= $produit['id'] ?>">
                    <label for="quantity">Quantité :</label>
                    <input type="number" name="quantity" value="<?= $produit['quantity'] ?>" min="1">
                    <button type="submit">Mettre à jour</button>
                    </form>
                    
                    <form method="post" action="index.php?action=removeFromCart">
                    <input type="hidden" name="product_id" value='<?= $produit['id'] ?>'>
                    <button type="submit">Supprimer</button>
                    </form>

                    
                </div>
                
                <?php endforeach; ?>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>
    <div>
    <form action="index.php?action=confirmerPanier" method="post">
    <button type="submit">Confirmer le panier</button>
    </form>
    </div>
    
	</main>



    <footer>
        <p>&copy; 2024 FootFusion. Tous droits réservés.</p>
    </footer>
</body>
</html>