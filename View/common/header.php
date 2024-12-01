<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M&A Cookies</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/vuPublique.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">

</head>

<body>
<header>
    <nav>
        <div class="nav-left">
            <a href="index.php" class="logo-link">
                <img src="assets/logo.png" alt="M&A Cookies" class="logo-img">
            </a>
        </div>

        <div class="menu">
            <a href="">Nos cookies</a>
            <a href="">Contact</a>

            
            <label for="search-toggle" class="search">
                <div class="search-icon">
                    <img src="assets/search.png" alt="search" style="width: 28px; height: 28px;">
                </div>
            </label>

            
            <input type="checkbox" id="search-toggle" class="search-toggle">

            
            <div class="search-field">
                <input type="text" placeholder="Rechercher..." id="search-input">
            </div>

            <a href="" class="cart-wrapper">
            <div class="cart-icon">
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="viewCart">
                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer; display: flex; position: relative;">
                        <img src="assets/cart.png" alt="cart" style="width: 28px; height: 28px; display: block;">
                        <div class="notification" style="position: absolute; top: -8px; right: -8px; background-color: white; color: #744a31; font-size: 12px; min-width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 500;">0</div>
                    </button>
                </form>
            </div>
        </a>
        </div>
    </nav>
</header>
