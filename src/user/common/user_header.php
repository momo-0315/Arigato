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
    <form class="header__search" action="../../user/search_box.php" method="POST">
        <input class="header__search--input" placeholder="サイト内検索はこちら" type="text" name=“word”>
        <input class="header__search--mark_wrapper" type="submit" name="submit" value="" id="search">
        
    </form>
    <div>
</header>