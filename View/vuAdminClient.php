<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vuAdminClient.css">
    <link rel="stylesheet" href="css/menuAdmin.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">

</head>

<header>

    <?php require_once 'View/common/menuAdmin.php' ; ?>

</header>

<body>

    <?php $hasCriticalStock = false; ?>
    <?php foreach ($stocks as $stock): ?>
    <?php if ($stock['quantité'] < $stock['seuil_critique']): ?>
    <?php $hasCriticalStock = true; ?>
    <?php endif; ?>
    <?php endforeach; ?>

    <div class="adminmessage <?= $hasCriticalStock ? '' : 'hidden' ?>">
        <button>X</button>
        <h3>Alerte !</h3>
        <p>Des cookie sont en dessous du seuil critique :</p>
        <?php foreach ($stocks as $stock): ?>
        <?php if ($stock['quantité'] < $stock['seuil_critique']): ?>
        <?php foreach ($produits as $produit): ?>
        <?php if ($produit['id'] === $stock['produit_id']): ?>
        <div class="prodRupture">
            <img src="<?= $produit['icone'] ?>" class="imgRupt" alt="cookie-img">
            <p><?= $produit['reference'] ?></p>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php endforeach; ?>
        <form method="post" class="search" action="index.php?action=adminFournisseur">
            <button type="submit">Fournisseur</button>
        </form>
    </div>


    <h1>Gestion des Clients</h1>

    <!-- Formulaire de recherche -->
    <form method="post" class="search" action="index.php?action=findClient">
        <input type="text" name="search" placeholder="Rechercher un client..."
            value="<?= htmlspecialchars($_POST['search'] ?? '') ?>">
        <button class="search-button" type="submit">Rechercher</button>
    </form>

    <!-- Table des clients -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= $client['id'] ?></td>
                <td><?= htmlspecialchars($client['nom']) ?></td>
                <td><?= htmlspecialchars($client['prenom']) ?></td>
                <td><?= htmlspecialchars($client['email']) ?></td>
                <td>
                    <form method="post" action="index.php?action=deleteClient" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $client['id'] ?>">
                        <input type="hidden" name="action" value="deleteClient">
                        <button class="button" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif;?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout -->
    <h2>Ajouter un client</h2>
    <form method="post" action="index.php?action=addClient">
        <input type="text" name="nom" placeholder="nom" required>
        <input type="text" name="prenom" placeholder="prenom" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="hidden" name="action" value="add">
        <button class="button" type="submit">Ajouter</button>
    </form>


</body>

</html>