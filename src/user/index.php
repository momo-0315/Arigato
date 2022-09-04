<?php
session_start();

require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs WHERE hide = 0');
$airbnbs = $stmt->fetchAll();

// フィルター処理
if (isset($_POST['filter_service'])) {
    // サービスフィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE service = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_location'])) {
    // 立地フィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE location = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_fire'])) {
    // 人気フィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE popularity = 1 AND hide = 0');
    $airbnbs = $stmt->fetchAll();
}

//お気に入り登録
if (isset($_POST['id'])) {

    $id = $_POST['id'];

    // お気に入りに既に登録している場合は削除
    if (isset($_SESSION['favourites'][$id])) {
        unset($_SESSION['favourites'][$id]);
    // 既に登録していない場合は登録
    } else {
        $stmt = $db->prepare('SELECT * FROM airbnbs WHERE id = ?');
        $stmt->execute(array($id));
        $liked = $stmt->fetch();
    
        $liked_id = $liked['id'];
        $liked_name = $liked['name'];
        $liked_price = $liked['price'];
        $liked_capacity = $liked['capacity'];
    
        // 配列に入れるには、$liked_name,$liked_price,$liked_capacityの値が取得できていることが前提なのでif文で空のデータを排除する
        if ($liked_id != '' && $liked_name != '' && $liked_price != '' && $liked_capacity != '') {
            $_SESSION['favourites'][$id] = [
                'id' => $liked_id,
                'name' => $liked_name,
                'price' => $liked_price,
                'capacity' => $liked_capacity
            ];
        }
    }

    
}


$favourites = isset($_SESSION['favourites']) ? $_SESSION['favourites'] : [];



?>

<?php include('./common/user_header.php'); ?>

<body>
    <form action="" method="post">
        <div class="filter">
            <button class="filter__item" name="filter_service" id="service">
                <img class="filter__item--img" src="../img/filters/support.png"></i>
                <p class="filter__item--text">サービス</p>
            </button>
            <button class="filter__item" name="filter_location" id="location">
                <img class="filter__item--img" src="../img/filters/location.png"></i>
                <p class="filter__item--text">立地良き</p>
            </button>
            <button class="filter__item" name="filter_fire" id="popularity">
                <img class="filter__item--img" src="../img/filters/fire.png"></i>
                <p class="filter__item--text">人気</p>
            </button>
        </div>
    </form>

    <div class="list">
        <?php foreach ($airbnbs as $airbnb) : ?>
            <div class="list__item">
                <img class="list__item--img" src="../img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
                <h1 class="list__item--title"><?= $airbnb['name'] ?></h1>
                <p class="list__item--price">¥<?= $airbnb['price'] ?>/泊</p>
                <p class="list__item--capacity">収容：<?= $airbnb["capacity"] ?>人</p>
                <!-- カート追加用 -->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $airbnb['id'] ?>">
                    <!-- <a href="/user/fav.php?id=<?= $airbnb['id'] ?>" class="list__item--favourite">
                        <i class="far fa-heart"></i>
                    </a> -->
                    <button class="list__item--favourite">
                        <?php if (empty($favourites[$airbnb['id']])) { ?>
                            <i class="far fa-heart"></i>
                        <?php } else { ?>
                            <i class="fas fa-heart heart_red"></i>
                        <?php } ?>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>