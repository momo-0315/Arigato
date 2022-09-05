<?php
session_start();

$airbnb_id = $_GET['airbnb_id'];

require("../dbconnect.php");
// airbnbテーブルと接続
$sql = "SELECT * FROM airbnbs WHERE id =?";
$stmt = $db->prepare($sql);
$data[] = $airbnb_id;
$stmt->execute($data);
$airbnb = $stmt->fetch(PDO::FETCH_ASSOC);

// qualitiesテーブルと接続
$location_rate = $airbnb['location'];
$service_rate = $airbnb['service'];
$popularity_rate = $airbnb['popularity'];

$sql_qualities = "SELECT evaluation FROM qualities WHERE rate=?";
$stmt_qualities = $db->prepare($sql_qualities);
// location
$data_location[] = $location_rate;
$stmt_qualities->execute($data_location);
$location_quality = $stmt_qualities->fetch(PDO::FETCH_ASSOC);
// service
$data_service[] = $service_rate;
$stmt_qualities->execute($data_service);
$service_quality = $stmt_qualities->fetch(PDO::FETCH_ASSOC);

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

    <div class="list">
        <div class="list__item">
            <section class="detail__title">
                <span></span>
                <h1><?= $airbnb["name"] ?></h1>
                <a href="">レビュー数</a>
                <div>
                    <span>シェア</span>
                    <span>保存</span>
                </div>
            </section>
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
                        <i class="fas fa-heart"></i>
                    <?php } ?>
                </button>
            </form>
        </div>
        <section>
            <div>
                <span>立地：<?= $location_quality["evaluation"] ?></span>
                <span>サービス：<?= $service_quality["evaluation"] ?></span>
                <span>価格：<?= $airbnb["price"] ?>円</span>
                <span>収容人数：<?= $airbnb["capacity"] ?>人</span>
                <span>人気：<?= $location_quality["evaluation"] ?></span>
            </div>
        </section>
        <a class="favourites__link" href="/user/index.php">一覧に戻る</a>
    </div>
</body>

</html>