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

    
    <div class="content">
        <section class="section">
            <h2>Nos Cookies Artisanaux</h2>
            <p>Découvrez nos délicieux cookies faits maison, à déguster sans modération !</p>
        </section>
    </div>



<script>
document.addEventListener('DOMContentLoaded', function () {


    /* element du titre central que je veux animer */
    const titreCentral = document.querySelector('.titreCentral');

    window.addEventListener('scroll',function() { /* ecouteur qui detecte le scroll*/

        const scrollY = window.scrollY;

        

        titreCentral.style.backgroundSize = `${100 + scrollY / 10}%`;
        titreCentral.style.backgroundPosition = `center ${scrollY * 0.3}px`;

        
        titreCentral.style.transform= `scale(${Math.max(1 - scrollY/ 1000, 0.5)})`;
    });
});


</script>

</body>