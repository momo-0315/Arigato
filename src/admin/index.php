<?php
session_start();
require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs');
$airbnbs = $stmt->fetchAll();

?>

<?php include('./common/admin_header.php'); ?>

<body>
    <div class="list">
        <?php foreach ($airbnbs as $airbnb) : ?>
            <div class="list__item">
                <a class="list__item--link" href="./edit.php?id=<?= $airbnb["id"] ?>">
                    <img class="list__item--img" src="../img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
                    <h1 class="list__item--title"><?= $airbnb["name"] ?></h1>
                    <p class="list__item--price">¥<?= $airbnb["price"] ?>/泊</p>
                    <p class="list__item--capacity">収容：<?= $airbnb["capacity"] ?>人</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>