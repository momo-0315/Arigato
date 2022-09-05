<?php
session_start();

require("../dbconnect.php");

$stmt = $db->query('SELECT * FROM airbnbs WHERE hide = 0 AND deleted = 0');
$airbnbs = $stmt->fetchAll();

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

  $favourites = isset($_SESSION['favourites']) ? $_SESSION['favourites'] : [];
}

?>

<?php foreach ($airbnbs as $airbnb) : ?>
  <div class="list__item">
    <img class="list__item--img" src="../img/airbnbs/<?= $airbnb["img"] ?>" alt="airbnb">
    <h1 class="list__item--title"><?= $airbnb['name'] ?></h1>
    <p class="list__item--price">¥<?= $airbnb['price'] ?>/泊</p>
    <p class="list__item--capacity">収容：<?= $airbnb["capacity"] ?>人</p>
    <!-- カート追加用 -->
    <!-- <form action="" method="post"> -->
    <!-- <input type="hidden" id="airbnb<?= $airbnb['id'] ?>" name="id" value="<?= $airbnb['id'] ?>"> -->
    <?php if (empty($favourites[$airbnb['id']])) { ?>
      <button id="like_button<?= $airbnb['id'] ?>" name="like_id" value="<?= $airbnb['id'] ?>" class="list__item--favourite">
        <i class="far fa-heart"></i>
      </button>
    <?php } else { ?>
      <button id="unlike_button<?= $airbnb['id'] ?>" name="unlike_id" value="<?= $airbnb['id'] ?>" class="list__item--favourite">
        <i class="fas fa-heart heart_red"></i>
      </button>
    <?php } ?>
    <!-- </form> -->
  </div>
<?php endforeach; ?>