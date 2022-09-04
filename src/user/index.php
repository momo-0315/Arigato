<?php
session_start();

require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs WHERE hide = 0 AND deleted = 0');
$airbnbs = $stmt->fetchAll();

// フィルター処理
if (isset($_POST['filter_all'])) {
    // 全て
    $stmt = $db->query('SELECT * FROM airbnbs WHERE hide = 0  AND deleted = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_service'])) {
    // サービスフィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE service = 1 AND hide = 0  AND deleted = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_location'])) {
    // 立地フィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE location = 1 AND hide = 0  AND deleted = 0');
    $airbnbs = $stmt->fetchAll();
} elseif (isset($_POST['filter_fire'])) {
    // 人気フィルター
    $stmt = $db->query('SELECT * FROM airbnbs WHERE popularity = 1 AND hide = 0  AND deleted = 0');
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
            <button class="filter__item" name="filter_all" id="all">
                <img class="filter__item--img" src="../img/filters/grid.png"></i>
                <?php if (isset($_POST['filter_all'])) { ?>
                    <p class="filter__item--text text_underline">全て</p>
                <?php } elseif (isset($_POST['filter_service']) || isset($_POST['filter_service']) || isset($_POST['filter_location']) || isset($_POST['filter_popularity'])) { ?>
                    <p class="filter__item--text">全て</p>
                <?php } else { ?>
                    <p class="filter__item--text text_underline">全て</p>
                <?php } ?>

            </button>
            <button class="filter__item" name="filter_service" id="service">
                <img class="filter__item--img" src="../img/filters/support.png"></i>
                <?php if (isset($_POST['filter_service'])) { ?>
                    <p class="filter__item--text text_underline">サービス</p>
                <?php } else { ?>
                    <p class="filter__item--text">サービス</p>
                <?php } ?>
            </button>
            <button class="filter__item" name="filter_location" id="location">
                <img class="filter__item--img" src="../img/filters/location.png"></i>
                <?php if (isset($_POST['filter_location'])) { ?>
                    <p class="filter__item--text text_underline">立地良き</p>
                <?php } else { ?>
                    <p class="filter__item--text">立地良き</p>
                <?php } ?>
            </button>
            <button class="filter__item" name="filter_fire" id="popularity">
                <img class="filter__item--img" src="../img/filters/fire.png"></i>
                <?php if (isset($_POST['filter_fire'])) { ?>
                    <p class="filter__item--text text_underline">人気</p>
                <?php } else { ?>
                    <p class="filter__item--text">人気</p>
                <?php } ?>
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


    <script>
        // リロードの際スクロール位置を保存（お気に入り登録の際必要。ajaxわからないから今はこれで実装中）
        var positionY; /* スクロール位置のY座標 */
        var STORAGE_KEY = "scrollY"; /* ローカルストレージキー */
        // checkOffset関数: 現在のスクロール量をチェックしてストレージに保存 //
        function checkOffset() {
            positionY = window.pageYOffset;
            localStorage.setItem(STORAGE_KEY, positionY);
        }
        // 起動時の処理（ローカルストレージをチェックして前回のスクロール位置に戻す） //
        window.addEventListener("load", function() {
            // ストレージチェック
            positionY = localStorage.getItem(STORAGE_KEY);
            // 前回の保存データがあればスクロールする
            if (positionY !== null) {
                scrollTo(0, positionY);
            }
            // スクロール時のイベント設定
            window.addEventListener("scroll", checkOffset, false);
        });
    </script>
</body>

</html>