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
// popularity
$data_popularity[] = $popularity_rate;
$stmt_qualities->execute($data_popularity);
$popularity_quality = $stmt_qualities->fetch(PDO::FETCH_ASSOC);

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

    <div class="detail">
        <h1><?= $airbnb["name"] ?></h1>
        <div>
            <a href="">レビュー数</a>
            <span>シェア</span>
            <span>保存</span>
        </div>
        <div class="detail__container">
            <img class="detail__container--img" src="../img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
            <!-- お気に入り追加用 -->
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $airbnb['id'] ?>">
                <button class="list__item--favourite">
                    <?php if (empty($favourites[$airbnb['id']])) { ?>
                        <i class="far fa-heart"></i>
                    <?php } else { ?>
                        <i class="fas fa-heart"></i>
                    <?php } ?>
                </button>
            </form>
            <table class="detail__container--info">
                <tr>
                    <th>立地</th>
                    <td><?= $location_quality["evaluation"] ?></td>
                </tr>
                <tr>
                    <th>サービス</th>
                    <td><?= $service_quality["evaluation"] ?></td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td><?= $airbnb["price"] ?></td>
                </tr>
                <tr>
                    <th>収容人数</th>
                    <td><?= $airbnb["capacity"] ?></td>
                </tr>
                <tr>
                    <th>人気</th>
                    <td><?= $popularity_quality["evaluation"] ?></td>
                </tr>
            </table>
        </div>
        <div class="detail__link">
            <a href="/user/index.php">一覧に戻る</a>
        </div>

    </div>
</body>

</html>