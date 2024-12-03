<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    
</head>

<body>
    <h1>Gestion des Clients</h1>

    <!-- Formulaire de recherche -->
    <form method="post" action="index.php?action=findClient">
        <input type="text" name="search" placeholder="Rechercher un client..." value="<?= htmlspecialchars($_POST['search'] ?? '') ?>" >
        <button type="submit">Rechercher</button>
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
                            <button type="submit">Supprimer</button>
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
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
