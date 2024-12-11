<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vuAdmin.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">

</head>
<body>
    <nav class="admin-nav">
        <ul>
            <li><a href="index.php?action=viewAdminClient" class="<?= $currentPage === 'client' ? 'active' : '' ?>">Clients</a></li>
            <li><a href="index.php?action=viewAdminCommande" class="<?= $currentPage === 'commande' ? 'active' : '' ?>">Commandes</a></li>
            <li><a href="index.php?action=viewAdminFournisseur" class="<?= $currentPage === 'fournisseur' ? 'active' : '' ?>">Fournisseurs</a></li>
            <li><a href="index.php?action=viewAdminproduit" class="<?= $currentPage === 'produit' ? 'active' : '' ?>">Produits</a></li>
        </ul>
    </nav>
    
    <main>
        <?php include_once $content; ?>
    </main>
</body>
</html>