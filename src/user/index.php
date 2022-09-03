<?php
session_start();
require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs WHERE hide = 0');
$airbnbs = $stmt->fetchAll();

// フィルター処理
if (isset($_POST['filter_service'])) {
    
    // フィルター更新
    $stmt = $db->query('SELECT * FROM airbnbs WHERE service = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();

} elseif (isset($_POST['filter_location'])) {

    // フィルター更新
    $stmt = $db->query('SELECT * FROM airbnbs WHERE location = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_fire'])) {

    // フィルター更新
    $stmt = $db->query('SELECT * FROM airbnbs WHERE popularity = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();
}

?>

<?php include('./common/user_header.php'); ?>

<body>
    <form action="" method="post">
        <div class="filter">
            <button class="filter__item" name="filter_service">
                <img class="filter__item--img" src="../img/filters/support.png"></i>
                <p class="filter__item--text">サービス</p>
            </button>
            <button class="filter__item" name="filter_location">
                <img class="filter__item--img" src="../img/filters/location.png"></i>
                <p class="filter__item--text">立地良き</p>
            </button>
            <button class="filter__item" name="filter_fire">
                <img class="filter__item--img" src="../img/filters/fire.png"></i>
                <p class="filter__item--text">人気</p>
            </button>
        </div>
    </form>
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