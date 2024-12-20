<?php require_once "View/common/header.php" ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Confirmer commande</title>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/vuPublique.css" />

    <link rel="stylesheet" href="css/confirmerPanier.css" />
</head>

<body>
    <main>
        <h2>
            Entrer vos information pour voir vos commande ou pour pouvoir commander
        </h2>
        <form action="index.php?action=clientConnect" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required />

            <label for="adresse">Prenom :</label>
            <input type="text" id="prenom" name="prenom" required />

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required />

            <label for="tel">Telephone :</label>
            <input type="tel" id="tel" name="tel" required />

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required />

            <button class="submit" type="submit">Me connecter</button>
        </form>
    </main>
</body>

</html>