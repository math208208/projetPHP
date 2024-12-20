<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Panier - M&A Cookies</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/footer.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">

</head>

<body>
    <main>
        <h1>Vos commandes :</h1>


        <div class="commande">
            <?php if (!empty($commandes)): ?>


            <?php foreach ($commandes as $commande): ?>


            <div class="element">
                <p>Date :
                    <?php echo $commande['date_creation'];?>
                </p>



                <p>Quantité total de produit:
                    <?php 
                    $produits = json_decode($commande['produits'], true); 

                    if (is_array($produits)) {
                        $sommeQuantites = 0;
                        foreach ($produits as $produit) {
                            if (isset($produit['quantity'])) {
                                $sommeQuantites += $produit['quantity']; 
                            }
                        }
                        echo "$sommeQuantites";
                    } else {
                        echo "ERREUR";
                    }
                    ?>
                </p>

                <p>Total HT :
                    <?php echo $commande['total_ht'];?>
                </p>

                <p>Total payé TTC:
                    <?php echo $commande['total_ttc'];?>
                </p>







            </div>

            <?php endforeach; ?>


            <?php else: ?>

            <p class="empty-commande">Vous n'avez fait aucune commande.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy <?= date('Y') ?> M&A Cookies. Tous droits réservés.</p>
        <h4>M&A Cookies</h4>
        <a href="index.php?action=adminClient" class="admin">
            <img src="assets/lock.png" alt="Administration"></a>
    </footer>

</body>

</html>