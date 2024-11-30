<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M&A Cookies</title>
    <link rel="stylesheet" href="/PHP/css/header.css">
    <link rel="icon" type="image/png" href="/PHP/assets/favicon.png">
    <link rel="stylesheet" href="/PHP/css/vuPublique.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">

</head>

<body>
<header>
    <nav>
        <div class="nav-left">
            <a href="index.php" class="logo-link">
                <img src="/PHP/assets/logo.png" alt="M&A Cookies" class="logo-img">
            </a>
        </div>

        <div class="menu">
            <a href="">Nos cookies</a>
            <a href="">Contact</a>

            
            <label for="search-toggle" class="search">
                <div class="search-icon">
                    <img src="/PHP/assets/search.png" alt="search" style="width: 28px; height: 28px;">
                </div>
            </label>

            
            <input type="checkbox" id="search-toggle" class="search-toggle">

            
            <div class="search-field">
                <input type="text" placeholder="Rechercher..." id="search-input">
            </div>

            <a href="" class="cart-wrapper">
                <div class="cart-icon">
                    <img src="/PHP/assets/cart.png" alt="cart" style="width: 28px; height: 28px;">
                    <div class="notification">0</div> <!-- pour l'instant 0 mais à voir comment faire pour incrémenter les numéros d'articles -->
                </div>
            </a>
        </div>
    </nav>
</header>
