<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/vuPublique.css">
    <title>Accueil - M&A Cookies</title>

    <style>
         * {
        background: none;
        color: inherit;
    }
    
    
    .cookie-card {
        transition: all 0.3s ease;
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

   

    </style>

</head>
<body> 

    <main>
        <div class="titreCentral">
            <div class="contenuTC">

                <h1 class="title">Nouveauté de la saison</h1>
                <h2 class="subtitle">Venez découvrir notre dernière création aux saveurs réconfortantes</h2>
            </div>

            <div class="scroll_detect"></div>
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

                                <button type="submit" id="boutonPanier" class="panier"style="border-radius: 18px; background-color: #b08968;
                                font-size: 15px; width: 100%; padding: 15px 30px; cursor: pointer; margin-left: 2px;border: none; color: #fff9ef;
                                font-weight: bold;">Ajouter au panier</button>

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
</body>
</html>
