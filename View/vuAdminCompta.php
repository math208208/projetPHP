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
    <h1>Comptabilité</h1>

    <div class="stats-container">
        <div class="stat-card">
            <p>Nombre de commandes cette année : <?=$nbCommande ?></p>
            <p>Plus grosse commande : <?=$plusGrosseCom ?> euros</p>
        </div>

        <div class="stat-card">
            <p>Commandes fournisseur : <?=$nbComFourni ?></p>
            <p>Dépenses totales : <?=$totalDepense ?> euros</p>
        </div>

        <div class="stat-card">
            <p>Cookies achetés : <?=$nbTotalCookieAchette ?></p>
            <p>Cookies vendus : <?=$nbCookieVendu ?></p>
    </div>

        <div class="stat-card">

            <p>Chiffre d'affaires HT : <?=$CAht ?> euros</p>
        </div>

        <div class="stat-card result-card">

                <p>Résultat annuel : <?=$result ?> euros</p>
        </div>
    </div>


</body>
</html>