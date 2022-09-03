<?php
session_start();

try {

  print_r($_POST["name"]);
  // // 例外が発生する可能性のあるコード
  // require("../dbconnect.php");
  // $stmt = $db->query('SELECT * FROM airbnbs WHERE name LIKE :word');
  // print_r($stmt);
} catch (PDOException $e) {
  // 例外発生時の処理
  $error = "接続エラー : {$e->getMessage()}";
}