<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/vuPublique.css">
</head>
<body> 
    
    <main>
    <div class="titreCentral">
        <div class="contenuTC">
            <h1 class="title">"Croustillants à l'extérieur,<br> fondants au coeur"</h1>
            <h2 class="subtitle">Venez découvrir nos produits</h2>
        </div>
        <div class="scroll_detect"></div> <!-- va diminuer la taille de l'image avec le style et lanimation js -->
    </div>

    <div id="nos-cookies">
    <section class="cookies-container">
        <h2>Nos Cookies Artisanaux</h2>
        <p>Découvrez nos délicieux cookies faits maison, à déguster sans modération !</p>

        <div class="cookies-wrapper">
            <?php foreach ($produits as $produit): ?>
                <div class="cookie-card">
                    <img src=<?=$produit['image'] ?> class="cookie-img">
                    <h3><?= $produit['titre'] ?></h3>
                    <p><?= $produit['description'] ?></p>
                    <h4>Prix: <?= $produit['prix_public'] ?> €</h4>
                    <form method="post" action="index.php?action=addToCart">
                        <input type="hidden" name="product" value='<?= json_encode(value: $produit) ?>'>
                        <button type="submit">Ajouter au panier</button>
                </form>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        /* element du titre central que je veux animer */
    const titreCentral = document.querySelector('.titreCentral');

    window.addEventListener('scroll', function() {/* element du titre central que je veux animer */
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