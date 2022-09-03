<?php

session_start();

$favourites = isset($_SESSION['favourites']) ? $_SESSION['favourites'] : [];

// お気に入りから削除
if (isset($_POST['delete'])) {
  $delete_id = $_POST['delete_id'];

  // 削除
  if ($delete_id != '') {
    unset($_SESSION['favourites'][$delete_id]);
  }

  header('Location: fav.php');
}

?>

<?php include('./common/user_header.php'); ?>

<body>
  <div class="favourites">
    <h1 class="favourites__title">お気に入り一覧</h1>
    <table class="favourites__table">
      <form action="" method="post">
        <thead>
          <tr>
            <th>エアビ名</th>
            <th>価格</th>
            <th>収容人数</th>
            <th>操作</th>
          </tr>
        </thead>
        <?php foreach ($favourites as $favourite) : ?>
          <tbody>
            <tr>
              <td><?= $favourite['name'] ?></td>
              <td>¥<?= $favourite['price'] ?>/泊</td>
              <td><?= $favourite['capacity'] ?>人</td>
              <td>
                <input type="hidden" name="delete_id" value="<?= $favourite['id'] ?>">
                <button class="delete_button" name="delete">削除</button>
              </td>
            </tr>
          </tbody>
        <?php endforeach; ?>
      </form>
    </table>
    <a class="favourites__link" href="/user/index.php">一覧に戻る</a>
  </div>

</body>

</html>