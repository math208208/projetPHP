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
    <h1>Gestion des produits</h1>

    <!-- Formulaire de recherche -->
    <form method="post" action="index.php?action=findProduit">
        <input type="text" name="search" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($_POST['search'] ?? '') ?>" >
        <button type="submit">Rechercher</button>
    </form>

    <!-- Table des clients -->
    <table border="1">
        <thead>
            <tr>
                <th>Reference</th>
                <th>ID</th>
                <th>Description</th>
                <th>Prix public</th>
                <th>Prix achat</th>
                <th>Image</th>
                <th>Icone</th>
                <th>Titre</th>
                <th>Descriptif</th>
                <th>Seuil critique</th>
                <th>Quantité en stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
        <?php if (!empty($produits)): ?>
            <?php foreach ($produits as $key=>$produit): ?>
                <tr>
                    <td><?= $produit['reference'] ?></td>
                    <td><?= $produit['id'] ?></td>
                    <td><?= htmlspecialchars($produit['description']) ?></td>
                    <td><?= htmlspecialchars($produit['prix_public']) ?></td>
                    <td><?= htmlspecialchars($produit['prix_achat']) ?></td>
                    <td><?= htmlspecialchars($produit['image'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['icone'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre']) ?></td>
                    <td><?= htmlspecialchars(string: $produit['descriptif']) ?></td>
                    <td> 
                    <?php
                        $seuilCritique = 'Aucune donnée'; 
                        foreach ($stock as $stockItem) {
                            if ($stockItem['produit_id'] == $produit['id']) {  
                                $seuilCritique = $stockItem['seuil_critique'];
                                break;  
                            }
                        }
                        echo htmlspecialchars($seuilCritique);
                        ?>
                    <td> 
                    <?php
                        $quantite = 'Aucune donnée'; 
                        foreach ($stock as $stockItem) {
                            if ($stockItem['produit_id'] == $produit['id']) {  
                                $quantite = $stockItem['quantité'];
                                break;  
                            }
                        }
                        echo htmlspecialchars($quantite);
                    ?>

                    <td>
                        <form method="post" action="index.php?action=deleteProduit" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                            <input type="hidden" name="action" value="deleteProduit">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout -->
    <h2>Ajouter un produit</h2>
    <form method="post" action="index.php?action=addProduit">
        <input type="text" name="reference" placeholder="reference" required>
        <input type="text" name="description" placeholder="description" required>
        <input type="number" step="0.01" name="prix_public" placeholder="prix_public" required>
        <input type="number" step="0.01" name="prix_achat" placeholder="prix_achat" required>
        <input type="text" name="image" placeholder="image" >
        <input type="text" name="icone" placeholder="icone" >
        <input type="text" name="titre" placeholder="titre" required>
        <input type="text" name="descriptif" placeholder="descriptif" required>
        <input type="number" name="seuil" placeholder="seuil critique" required>
        <input type="number" name="quantité" placeholder="quantité" required>

        <input type="hidden" name="action" value="add">
        <button type="submit">Ajouter</button>
    </form>


</body>
</html>
