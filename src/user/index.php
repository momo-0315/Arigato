<?php
session_start();
require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs');
$airbnbs = $stmt->fetchAll();

?>

<?php include('./common/user_header.php'); ?>

<body>
    <div class="filter">
        <div class="filter__item">
            <img class="filter__item--img" src="../img/filters/support.png"></i>
            <p class="filter__item--text">サービス</p>
        </div>
        <div class="filter__item">
            <img class="filter__item--img" src="../img/filters/location.png"></i>
            <p class="filter__item--text">立地良き</p>
        </div>
        <div class="filter__item">
            <img class="filter__item--img" src="../img/filters/fire.png"></i>
            <p class="filter__item--text">人気</p>
        </div>
    </div>
    <div class="list">
        <?php foreach ($airbnbs as $airbnb) : ?>
            <div class="list__item">
                <img class="list__item--img" src="../img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
                <h1 class="list__item--title"><?= $airbnb["name"] ?></h1>
                <p class="list__item--price">¥<?= $airbnb["price"] ?>/泊</p>
                <p class="list__item--capacity">収容：<?= $airbnb["capacity"] ?>人</p>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>