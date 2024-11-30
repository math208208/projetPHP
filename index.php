<?php 

    require_once "C:\wamp64\www\PHP\View\common\header.php"; 
?>


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
            

            <div class="cookie-card">
                <img src="/PHP/assets/cookie1.png" alt="Cookie 1" class="cookie-img">
                <h3>Cookie Classique</h3>
                <p>Délicieux et fondant, avec des pépites de chocolat.</p>
                <br>
                <h4>4.20€</h4>
                <button class="button"> Ajouter au panier</button>
            </div>

            
            <div class="cookie-card">
                <img src="/PHP/assets/cookie2.png" alt="Cookie 2" class="cookie-img">
                <h3>Cookie Choco-Noisette</h3>
                <p>Chocolat et noisettes croquantes, un vrai régal.</p>
                <h4>4.50€</h4>
                <button class="button"> Ajouter au panier</button>
            </div>

            
            <div class="cookie-card">
                <img src="/PHP/assets/cookie3.png" alt="Cookie 3" class="cookie-img">
                <h3>Cookie Caramel</h3>
                <p>Un délicieux cookie au coeur caramel fondant !</p>
                <h4>4.80€</h4>
                <button class="button"> Ajouter au panier</button>
            </div>

            <div class="cookie-card">
                <img src="/PHP/assets/cookie3.png" alt="Cookie 3" class="cookie-img">
                <h3>A finir</h3>
                <p>BLABLABLABLABLA</p>
                <h4>4.80€</h4>
                <button class="button"> Ajouter au panier</button>
            </div>        
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

</body>
</html>