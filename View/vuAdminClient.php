<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vuAdminClient.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    
</head>

<header>
    <style>
        .cart-container {
  background-color: #ffffff;
  border-radius: 25px;
  padding: 30px;
  margin-top: 30px;
}

h1 {
  text-align: center;
  color: #504031;
  font-family: "Montserrat", sans-serif;
  font-size: 32px;
  margin-top: 40px;
  margin-bottom: 15px;
}

h2 {
  text-align: center;
  color: #504031;
  font-family: "Montserrat", sans-serif;
  font-size: 24px;
  margin-bottom: 30px;
  margin-top: 25px;
}

form.search {
  display: flex;
  gap: 10px;
  align-items: center;
  max-width: 500px;
  padding: 30px;
  margin-left: 772px; 
  margin-right: 96px; 
}

form.search input {
  width: 300px;
  padding: 15px;
  margin-bottom: 0;
  border: 1px solid #ddd;
  border-radius: 15px;
}

.search-button {
  padding: 15px 25px;
  background-color: #b08968;
  color: white;
  border: none;
  border-radius: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  margin: 0;
}

.search-button:hover {
  background-color: #9c7a5a;
}

form {
  border-radius: 25px;
  padding: 30px;
  max-width: 500px;
  margin: 0 auto;
}

form input {
  width: 100%;
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 15px;
  font-size: 16px;
  color: #504031;
  box-sizing: border-box;
}

form .button {
  padding: 15px 3px;
  background-color: #b08968;
  color: white;
  border: none;
  border-radius: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 75%;
  font-family: "Montserrat", sans-serif;
  margin-left: 35px;
}

form .button:hover {
  background-color: #9c7a5a;
}

table {
  width: 85%;
  border-collapse: separate;
  border-spacing: 0;
  margin-top: 30px;
  background-color: #ffffff;
  border-radius: 25px;
  overflow: hidden;
  margin-left: 125px;
}

thead {
  background-color: #f8f4f0;
}

th,
td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  color: #504031;
}

th {
  font-weight: bold;
}

tr:last-child td {
  border-bottom: none;
}

tr:hover {
  background-color: #f1e6d9;
}

@media (max-width: 768px) {
  form,
  table {
    width: 95%;
    margin: 30px auto;
  }

  th,
  td {
    padding: 10px;
    font-size: 14px;
  }

  form .button {
    padding: 12px 15px;
  }
}
</style>
</header>
<body>
    <h1>Gestion des Clients</h1>

    <!-- Formulaire de recherche -->
    <form method="post" class="search" action="index.php?action=findClient">
        <input type="text" name="search" placeholder="Rechercher un client..." value="<?= htmlspecialchars($_POST['search'] ?? '') ?>" >
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
