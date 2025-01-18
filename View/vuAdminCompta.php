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

    <div class="date-selection">

    <form method="post" action="index.php?action=adminCompta" class="date-form">

        <div class="date-inputs">
            <div class="date-group">

                <label for="date_debut">Du :</label>
                <input type="date" id="date_debut" name="date_debut" required 
                    value="<?= isset($_POST['date_debut']) ? $_POST['date_debut'] : date('Y-01-01') ?>">

            </div>
            
            <div class="date-group">

                <label for="date_fin">Au :</label>
                <input type="date" id="date_fin" name="date_fin" required 
                
                    value="<?= isset($_POST['date_fin']) ? $_POST['date_fin'] : date('Y-m-d') ?>">
            </div>
        </div>
        <button type="submit" class="filter-btn">Filtrer</button>
    </form>
</div>

    <div class="stats-container">
        <div class="stat-card">
            <p>Nombre de commandes cette année : <?=$nbCommande ?></p>
            <p>Commande la plus conséquente : <?=$plusGrosseCom ?> euros</p>
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