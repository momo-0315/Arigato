<?php
session_start();
require(dirname(__FILE__) . "/dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs');
$airbnbs = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/normalize.css">
</head>
<div class="list">
    <?php foreach ($airbnbs as $airbnb) : ?>
        <div class="list__item">
            <img class="list__item--img" src="./img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
            <h1 class="list__item--title"><?= $airbnb["name"] ?></h1>
            <p class="list__item--price">¥<?= $airbnb["price"] ?>/泊</p>
            <p class="list__item--capacity">収容：<?= $airbnb["capacity"] ?>人</p>
        </div>
    <?php endforeach; ?>
</div>

<body>
</body>

</html>