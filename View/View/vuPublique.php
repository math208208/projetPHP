<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/vuPublique.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Accueil - M&A Cookies</title>

    
<style>
    * {
  background: none;
  color: inherit;
}


.cookie-card {
  transition: all 0.3s ease;
  border-radius: 23px;
  padding: 22px;
  margin-bottom: 30px;
  margin-left: 35px
}


.cookie-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(176, 137, 104, 0.2);
  border-color: #b08968;


}

.cookie-card img {
  transition: transform 0.3s ease;

}

.cookie-card:hover img {
      transform: scale(1.05);
}

.cookie-card:hover h4 {
  color: #b08968;
  }

.cookie-card button {
 transition: background-color 0.3s ease;
}

.cookie-card button:hover {
 background-color: #8c5832;
}
.title{
text-align: left;

}

.subtitle{
text-align:left;
}

#nos-cookies {
  padding-top: 80px;
  padding-bottom: 60px;
}

.cookies-container {
  text-align: center;
  padding: 0 20px;

}

/**********/

.banNew {
    position: relative;
    width: 90%;
    height: 500px;
    margin: 50px auto;
    background-color: #504031;
    border-radius: 30px;
}

.contenuNew{
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: space-between; /* permet un ecart egal sur la longueur pour tous les éléments*/
    align-items: center;
    height: 100%;
    padding: 0 80px;
}

.banText {
    color: #fff9ef;
}

.banImg img {
    max-width: 400px;
    border-radius: 20px;
    transition: transform 0.5s ease;
}

.banImg img:hover{
    transform: translateY(-10px); /* effet de montant descendant quand on survole*/
}

/*bulle "à venir" en haut de la box */
.showNew {
    display: inline-block;
    background-color: #b08968;
    padding: 10px 25px;
    border-radius: 25px;
    font-weight: bold;
    margin-bottom: 30px;
    font-size: 17px;
}

.banText h1{
    font-family: "Berkshire Swash", cursive;
    font-size: 41px;
    margin-bottom: 30px;
}

.banText p{
    font-size: 24px;
    margin-bottom: 40px;
}

.contenuNew p{
    font-size:18px;
    font-weight:bold;
}

</style>
</head>

<body> 

    <main>
    <div class="banNew">
    <div class="contenuNew">

            <div class="banText">

                <span class="showNew">À venir - Nouvelle Recette</span>

                <h1>Cookie à la cannelle</h1>

                <p>Une création exclusive : un cookie au cœur cannelle fait maison. <br>Une texture parfaite entre croustillant et moelleux.</p><br>

                <form method="post" action="index.php?action=addToCart">

                    <input type="hidden" name="product" value='<?= json_encode($nouveaute) ?>'>
                    <p>À découvrir prochainement ...</p>
                </form>
            </div>


            <div class="banImg">
                <img src="<?= $nouveaute['image'] ?>" alt="Cookie cannelle">
            </div>
            
        </div>
    </div>


        <div id="nos-cookies">

            <section class="cookies-container">
                <h2>Nos Cookies Artisanaux</h2>
                <p>Découvrez nos délicieux cookies faits maison, à déguster sans modération !</p>
                

                <div class="cookies-wrapper">
                    <?php foreach ($produits as $produit): ?>

                        
                        <div class="cookie-card">
                            <img src="<?= $produit['image'] ?>" class="cookie-img" alt="cookie-img">
                            <h3><?= $produit['titre'] ?></h3>


                            <p><?= $produit['descriptif'] ?></p>
                            <h4>Prix: <?= $produit['prix_public'] ?> €</h4>

                            
                            <form method="post" action="index.php?action=addToCart">

                                <input type="hidden" name="product" value='<?= json_encode($produit) ?>'>
                                <?php
                                $quantite = null; 
                                foreach ($stock as $stockItem) {
                                    if ($stockItem['produit_id'] == $produit['id']) {  
                                        $quantite = $stockItem['quantité']; 
                                        break;  
                                    }
                                }
                                
                                if ($quantite === 0 || $quantite === null) {
                                    echo "<button id='boutonPanier' class='panier' style='border-radius: 18px; background-color: #606060;
                                    font-size: 15px; width: 100%; padding: 15px 30px; cursor: not-allowed; margin-left: 2px;border: none; color: #fff9ef;
                                    font-weight: bold;' disabled>Produit indisponible</button>";
                                } else {
                                    echo "<button type='submit' id='boutonPanier' class='panier' style='border-radius: 18px; background-color: #b08968;
                                    font-size: 15px; width: 100%; padding: 15px 30px; cursor: pointer; margin-left: 2px;border: none; color: #fff9ef;
                                    font-weight: bold;'>Ajouter au panier</button>";
                                }
                                ?>
                                
                            </form>
                            </div>
                        <?php endforeach; ?>
                    </div>


            </section>
        </div>

        <script>

            document.addEventListener('DOMContentLoaded', function () {


                const titreCentral = document.querySelector('.titreCentral');

                window.addEventListener('scroll', function() {

                    const scrollY = window.scrollY;
                    titreCentral.style.backgroundSize = `${100 + scrollY / 20}%`;
                    titreCentral.style.backgroundPosition = `center ${scrollY * 0.2}px`;
                    const opacity = Math.max(1 - scrollY / (window.innerHeight * 0.8), 0);
                    titreCentral.style.opacity = opacity;

                    
                });
            });
        </script>
    </main>

    <?php require_once 'View/common/footer.php' ; ?>

</body>
</html>
