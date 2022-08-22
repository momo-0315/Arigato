<?php
$dsn = 'mysql:host=db;dbname=Airbnb;charset=utf8';
$user = 'momo';
$password = 'password';
try {
    $dbh = new PDO($dsn, $user, $password);
    echo "おめでとうううう接続成功だよ(`·⊝·´)" . PHP_EOL;
} catch (PDOException $e) {
    echo "(´･ω･`)人(`･ω･´)ﾄﾞﾝﾏｲ!!: " . $e->getMessage() . "\n";
    exit();
}
$members = $dbh->prepare('SELECT * FROM members WHERE id = 1');
$members->execute();
$members_info = $members->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h1>
    aaa
    <?php $members_info?>さん
</h1>
</body>

</html>