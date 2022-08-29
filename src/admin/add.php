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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add</title>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="add">
      <div class="add__item">
        <label for="name">名前</label>
        <input name="name" type="text">
      </div>
      <div class="add__item">
        <label for="image">写真</label>
        <input name="image" type="file">
      </div>
      <div class="add__item">
        <label for="location">立地</label>
        <select name="location">
          <option value="1">◯</option>
          <option value="0">✖︎</option>
        </select>
      </div>
      <div class="add__item">
        <label for="service">サービス</label>
        <select name="service">
          <option value="1">◯</option>
          <option value="0">✖︎</option>
        </select>
      </div>
      <div class="add__item">
        <label for="price">値段</label>
        <input name="price" type="text">
      </div>
      <div class="add__item">
        <label for="capacity">収容人数</label>
        <input name="capacity" type="text">
      </div>
      <div class="add__item">
        <label for="popularity">サービス</label>
        <select name="popularity">
          <option value="1">◯</option>
          <option value="0">✖︎</option>
        </select>
      </div>
      <input type="submit" name="submit" value="追加">
    </div>
  </form>

</body>

</html>