<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
   
    <main>
    <h2>Confirmer votre commande</h2>
        <form action="index.php?action=finaliserCommande" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Confirmer la commande</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FootFusion. Tous droits réservés.</p>
    </footer>
</body>
</html>
