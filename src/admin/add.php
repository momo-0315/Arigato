<?php

require('../dbconnect.php');

if (isset($_POST['submit'])) {
  // 画像以外の追加
  $airbnb_name = $_POST['name'];
  $airbnb_location = $_POST['location'];
  $airbnb_service = $_POST['service'];
  $airbnb_price = $_POST['price'];
  $airbnb_capacity = $_POST['capacity'];
  $airbnb_popularity = $_POST['popularity'];

  //画像追加
  $target_dir = "../img/airbnbs/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // SQL更新
    $sql = 'INSERT INTO airbnbs(name, img, location, service, price, capacity, popularity) 
          VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $db->prepare($sql);
    $stmt->execute(array($airbnb_name, $_FILES['image']['name'], $airbnb_location, $airbnb_service, $airbnb_price, $airbnb_capacity, $airbnb_popularity));
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }

  header('Location: index.php');

}

?>

<?php include('./common/admin_header.php'); ?>


<body>
  <div class="util__container">
    <div class="change">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="change__item">
          <label class="change__item--label" for="name">名前</label>
          <input class="change__item--input" name="name" type="text">
        </div>
        <div class="change__item">
          <label class="change__item--label">写真</label>
          <input class="change__item--file" name="image" type="file">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="location">立地</label>
          <select class="change__item--select" name="location">
            <option value="1">◯</option>
            <option value="0">✖︎</option>
          </select>
        </div>
        <div class="change__item">
          <label class="change__item--label" for="service">サービス</label>
          <select class="change__item--select" name="service">
            <option value="1">◯</option>
            <option value="0">✖︎</option>
          </select>
        </div>
        <div class="change__item">
          <label class="change__item--label" for="price">値段</label>
          <input class="change__item--input" name="price" type="text">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="capacity">収容人数</label>
          <input class="change__item--input" name="capacity" type="text">
        </div>
        <div class="change__item">
          <label class="change__item--label" for="popularity">サービス</label>
          <select class="change__item--select" name="popularity">
            <option value="1">◯</option>
            <option value="0">✖︎</option>
          </select>
        </div>
        <input class="change__button" type="submit" name="submit" value="追加">
      </form>
    </div>

  </div>

</body>

</html>