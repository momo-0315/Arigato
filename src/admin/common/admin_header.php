<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600&display=swap" rel="stylesheet">
</head>
<header class="header">
    <div class="header__logo">
        <img class="header__logo--icon" src="../../img/logos/airbnb (1).png" alt="">
        <span class="header__logo--text">posse airbnb</span>
    </div>

    <!--  サイト内検索 -->
    <div class="header__search">
        <form method="post" action="searchbox.php">
            <input class="header__search--input" type="text" name="word" value="" placeholder="word..." required>
            <input class="header__search--button" type="submit" name="submit" value="検索" id="search">
            <label for="search"><i class="fas fa-search"></i> </label>
        </form>
    </div>

    <div class="header__account">
        <img class="header__account--globe" src="../../img/logos/globe.png" alt="">
        <div class="header__account--wrapper"></div>
    </div>
</header>