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

            <label for="adresse">Prenom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Confirmer la commande</button>
        </form>
    </main>

</body>
</html>
