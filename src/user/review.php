<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板サンプル</title>
<h1>掲示板サンプル</h1>
<section>
    <h2>投稿完了</h2>
    <button onclick="location.href='index.php'">戻る</button>
</section>
 
<!-- 追記ここから -->
<?php
$id = null;
$name = $_POST["name"];
$contents = $_POST["contents"];
date_default_timezone_set('Asia/Tokyo');
$created_at = date("Y-m-d H:i:s");

require("../dbconnect.php");

$regist = $db->prepare("INSERT INTO reviews(id, name, contents, created_at) VALUES (:id,:name,:contents,:created_at)");
$regist->bindParam(":id", $id);
$regist->bindParam(":name", $name);
$regist->bindParam(":contents", $contents);
$regist->bindParam(":created_at", $created_at);
$regist->execute();
//ここで「登録失敗」だった場合、SQL文に誤りがあります。
if ($regist) {
    echo "登録成功";
} else {
    echo "登録失敗";
}
?>