
<?php require_once "View/common/header.php" ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Confirmer commande</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/vuPublique.css">

    <link rel="stylesheet" href="css/confirmerPanier.css">


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

            <button class="submit" type="submit">Confirmer la commande</button>
        </form>
    </main>

</body>
</html>
