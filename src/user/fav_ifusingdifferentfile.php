<?php
session_start();

require("../dbconnect.php");

$id = $_GET['id'];
$stmt = $db->query("SELECT * FROM airbnbs WHERE id = '$id'");
$airbnb = $stmt->fetch();

//お気に入り登録
$name = $airbnb['name'];
$price = $airbnb['price'];
$capacity = $airbnb['capacity'];

// $name = isset($_POST['name'])? htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8') : '';
// $capacity = isset($_POST['capacity'])? htmlspecialchars($_POST['capacity'], ENT_QUOTES, 'utf-8') : '';
// $price = isset($_POST['price'])? htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8') : '';

// 配列に入れるには、$name,$price,$capacityの値が取得できていることが前提なのでif文で空のデータを排除する
if ($name != '' && $price != '' && $capacity != '') {
    $_SESSION['favourites'][$id] = [
        'name' => $name,
        'price' => $price,
        'capacity' => $capacity
    ];
}

$favourites = isset($_SESSION['favourites']) ? $_SESSION['favourites'] : [];


// カート内容表示
if (isset($favourites)) {
  foreach ($favourites as $favourite) {
      echo $favourite['name'];
      echo $favourite['price'];
      echo $favourite['capacity'];
  }
}


// header('Location: index.php');



?>