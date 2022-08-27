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
</head>
<div style="display: flex; flex-wrap: wrap; justify-content: center">
    <?php foreach ($airbnbs as $airbnb) : ?>
        <div>
            <h1><?= $airbnb["name"] ?></h1>
            <img src="./img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb" style="width: 300px; height: 300px">
            <p>¥<?= $airbnb["price"] ?>/泊</p>
            <p>収容：<?= $airbnb["capacity"] ?>人</p>
        </div>
    <?php endforeach; ?>
</div>

<body>
</body>

</html>