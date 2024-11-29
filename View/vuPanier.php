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
            
        </div>
    </header>
   
    <main>
        <h1>Votre Panier</h1>
        <div class="panier">
            <?php if (!empty($cart)): ?>
                <?php foreach ($cart as $item): ?>
                    <div class="item">
                        <h2><?= htmlspecialchars($item['titre']) ?></h2>
                        <p>Prix: <?= htmlspecialchars($item['prix_public']) ?> €</p>
                        <p>Quantité: <?= htmlspecialchars($item['quantity']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Votre panier est vide.</p>
            <?php endif; ?>
        </div>
	</main>

    <footer>
        <p>&copy; 2024 FootFusion. Tous droits réservés.</p>
    </footer>
</body>
</html>