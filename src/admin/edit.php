<?php

require('../dbconnect.php');

if (isset($_GET['id'])) {

  // URLからIDを取得
  $id = $_GET['id'];

  // 既存データの表示
  $stmt = $db->query("SELECT * FROM airbnbs WHERE id = '$id'");
  $airbnb = $stmt->fetch();

  // 更新処理
  if (isset($_POST['update'])) {
    // 画像以外の追加
    $airbnb_name = $_POST['name'];
    $airbnb_location = $_POST['location'];
    $airbnb_service = $_POST['service'];
    $airbnb_price = $_POST['price'];
    $airbnb_capacity = $_POST['capacity'];
    $airbnb_popularity = $_POST['popularity'];

    // 画像以外の更新
    $sql = 'UPDATE airbnbs
          SET name = ?, location = ?, service = ?, price = ?, capacity = ?, popularity = ?
          WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute(array($airbnb_name, $airbnb_location, $airbnb_service, $airbnb_price, $airbnb_capacity, $airbnb_popularity, $id));

    //画像追加
    $target_dir = "../img/airbnbs/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      // 画像の更新
      $sql = "UPDATE airbnbs SET img = '" . $_FILES['image']['name'] . "' WHERE id = '$id'";
      $stmt = $db->query($sql);
    } else {
      // echo "Sorry, there was an error uploading your file.";
    }

    header('Location: index.php');
  }

  // 削除処理
  if (isset($_POST['delete'])) {
    
    $stmt = $db->prepare("UPDATE airbnbs SET deleted = 1 WHERE id = '$id'");
    $stmt->execute();

    header('Location: index.php');
  }
}

?>

<?php include('./common/admin_header.php'); ?>


<body>
  <div class="util__container">
    <div class="change">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="change__item">
          <label class="change__item--label" for="name">名前</label>
          <input class="change__item--input" name="name" type="text" value="<?= $airbnb['name'] ?>">
        </div>
        <div class="change__item">
          <label class="change__item--label">写真</label>
          <input class="change__item--file" name="image" type="file">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="location">立地</label>
          <select class="change__item--select" name="location">
            <option value="1" <?= $airbnb['location'] === 1 ? 'selected' : ''; ?>>◯</option>
            <option value="0" <?= $airbnb['location'] === 0 ? 'selected' : ''; ?>>✖︎</option>
          </select>
        </div>
        <div class="change__item">
          <label class="change__item--label" for="service">サービス</label>
          <select class="change__item--select" name="service">
            <option value="1" <?= $airbnb['service'] === 1 ? 'selected' : ''; ?>>◯</option>
            <option value="0" <?= $airbnb['service'] === 0 ? 'selected' : ''; ?>>✖︎</option>
          </select>
        </div>
        <div class="change__item">
          <label class="change__item--label" for="price">値段</label>
          <input class="change__item--input" name="price" type="text" value="<?= $airbnb['price'] ?>">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="capacity">収容人数</label>
          <input class="change__item--input" name="capacity" type="text" value="<?= $airbnb['capacity'] ?>">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="popularity">サービス</label>
          <select class="change__item--select" name="popularity">
            <option value="1" <?= $airbnb['popularity'] === 1 ? 'selected' : ''; ?>>◯</option>
            <option value="0" <?= $airbnb['popularity'] === 0 ? 'selected' : ''; ?>>✖︎</option>
          </select>
        </div>
        <input class="delete__button" type="submit" name="delete" value="削除">
        <input class="edit__button" type="submit" name="update" value="更新">
      </form>
    </div>

  </div>

</body>

</html>