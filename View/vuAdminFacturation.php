<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menuAdmin.css">
    <link rel="stylesheet" href="css/vuAdmin.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">

</head>
<header>

    <?php require_once 'View/common/menuAdmin.php' ; ?>

</header>

<body>
    <h1>Gestion des commandes</h1>

    <!-- Formulaire de recherche -->
    <form method="post" action="index.php?action=findCommande">
        <input type="text" name="search" placeholder="Rechercher une commande..."
            value="<?= htmlspecialchars($_POST['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Table des clients -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de la commande</th>
                <th>ID Client</th>
                <th>Total HT</th>
                <th>Total TTC</th>
                <th>Produits commandés</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($facturations)): ?>
            <?php foreach ($facturations as $facturation): ?>
            <tr>
                <td><?= $facturation['id'] ?></td>
                <td><?= htmlspecialchars($facturation['date_creation']) ?></td>
                <td><?= htmlspecialchars($facturation['client_id']) ?></td>
                <td><?= htmlspecialchars($facturation['total_ht']) ?></td>
                <td><?= htmlspecialchars($facturation['total_ttc']) ?></td>
                <td><?= htmlspecialchars($facturation['produits']) ?></td>

                <td>
                    <form method="post" action="index.php?action=deleteCommande" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $facturation['id'] ?>">
                        <input type="hidden" name="action" value="deleteCommande">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif;?>
        </tbody>
    </table>


</body>

</html>