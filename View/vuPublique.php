<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" href="css/vuPublique.css"">
     <link rel="icon" href="assets/preview.webp" type="image/webp">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootFusion</title>
</head>
<body>
    <header class="site-header">
        <div class="header-logo">
            <img src="assets/preview.webp" width="150" height="150" alt="Logo de FootFusion">
            <h1>FootFusion</h1>
            <form method="get" action="index.php">
            	<input type="hidden" name="action" value="viewCart">
            	<button type="submit">Mon Panier</button>
        	</form>
        </div>
    </header>
   
    <main>
        <div class="produits">
        <?php foreach ($produits as $produit): ?>
            <div class="produit">
                <h2><?= $produit['titre'] ?></h2>
                <p><?= $produit['description'] ?></p>
                <p>Prix: <?= $produit['prix_public'] ?> €</p>
                <form method="post" action="index.php?action=addToCart">
                    <input type="hidden" name="product_id" value="<?= $produit['id'] ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
                
            </div>
        <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 FootFusion. Tous droits réservés.</p>
    </footer>
</body>
</html>