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
    <h1>Comptabilité</h1>

    <p>Vous avez eu <?=$nbCommande ?> commandes cette année</p>
    <p>Votre plus grosse commande vous a rapporté <?=$plusGrosseCom ?> euros</p>
    <p>Vous avez passé <?=$nbComFourni ?> commandes auprés de votre fournisseur</p>
    <p>Vous avez acheté <?=$nbTotalCookieAchette ?> cookies et en avez vendu <?=$nbCookieVendu ?></p>
    <p>Vous avez dépensé <?=$totalDepense ?> euros</p>
    <p>Votre chiffre d'affaire est de <?=$CAht ?> euros</p>
    <p>En conclusion cette année vous etes a <?=$result ?> euros</p>








</body>

</html>