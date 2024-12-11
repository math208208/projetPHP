<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menuAdmin.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    
</head>
<header>

    <?php require_once 'View/common/menuAdmin.php' ; ?>

</header>
<body>
    <h1>Gestion des fournisseurs</h1>

    <!-- Formulaire de recherche -->
    <form method="post" action="index.php?action=findFournisseur">
        <input type="text" name="search" placeholder="Rechercher un fournisseur..." value="<?= htmlspecialchars($_POST['search'] ?? '') ?>" >
        <button type="submit">Rechercher</button>
    </form>

    <!-- Table des clients -->
    <table border="1">
        <thead>
                <th>ID</th>
                <th>Nom du fournisseur</th>
                <th>Id du cookie</th>
                <th>Quantité</th>
                <th>Date de la commande</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($fournisseurs)): ?>
            <?php foreach ($fournisseurs as $fournisseur): ?>
                <tr>
                    <td><?= $fournisseur['id'] ?></td>
                    <td><?= htmlspecialchars($fournisseur['nom']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['id_cookie']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['quantité']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['date_commande']) ?></td>

                    <td>
                        <form method="post" action="index.php?action=deleteFournisseur" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $fournisseur['id'] ?>">
                            <input type="hidden" name="action" value="deleteFournisseur">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout -->
    <h2>Ajouter un fournisseur</h2>
    <form method="post" action="index.php?action=addFournisseur">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="id_cookie" placeholder="id cookie" required>
        <input type="number" name="quantité" placeholder="Quantité" required min="1" required>
        
        <input type="hidden" name="action" value="add">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
