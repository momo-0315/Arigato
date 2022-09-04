<?php
session_start();

// 直接アクセスされたらリダイレクト
if (!isset($_POST['word'])) {
  header('Location:https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/');
  exit();
}

// $_POST['word']で入力値を取得 文字前後の空白除去&エスケープ処理
$word = trim(htmlspecialchars($_POST['word'], ENT_QUOTES));

// 文字列の中の「　」(全角空白)を「」(何もなし)に変換
$word = str_replace("　", "", $word);
// 対象文字列が何もなかったらキーワード指定なしとする
if ($word === "") {
  $word = "キーワード指定なし";
}

try {

  require("../dbconnect.php");

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

  $sql = "SELECT * FROM airbnbs WHERE name LIKE :word OR name LIKE :word2";
  // SQL文をセット
  $stmt = $db->prepare($sql);
  // bindValueでプレイスホルダーに値(ワイルドカードで挟む)を入れ込む
  $stmt->bindValue(':word', "%{$word}%", PDO::PARAM_STR);
  $stmt->bindValue(':word2', "%{$word}%", PDO::PARAM_STR);
  // 実行処理
  $stmt->execute();
  // 記事があるかないかの指標用
  $judge = false;

  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $judge = true;  // 記事がある時の
?>
    <?php include('./common/user_header.php'); ?>
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
      <a href="./detail.php?airbnb_id=<?php echo $result["id"] ?>" target=”_blank” rel="noopener noreferrer">
        <div class="list__item">
          <img class="list__item--img" src="../img/airbnbs/<?= $result["img"] ?>" alt="airbnb">
          <h1 class="list__item--title"><?= $result['name'] ?></h1>
          <p class="list__item--price">¥<?= $result['price'] ?>/泊</p>
          <p class="list__item--capacity">収容：<?= $result["capacity"] ?>人</p>
          <!-- カート追加用 -->
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <button class="list__item--favourite">
              <?php if (empty($favourites[$result['id']])) { ?>
                <i class="far fa-heart"></i>
              <?php } else { ?>
                <i class="fas fa-heart heart_red"></i>
              <?php } ?>
            </button>
          </form>
        </div>
      </a>
    </div>
  <?php
  }
  if ($judge === false) {  // 記事があったかないか
    include('./common/user_header.php');
    // ない場合はメッセージを格納する
  ?>
    <div class="header__margin">
      <h1>該当の宿泊施設がありませんでした</h1>
    </div>
<?php
  }
} catch (PDOException $e) {
  // 例外発生時の処理
  // 例外のメッセージを格納しておく
  $error = "接続エラー : {$e->getMessage()}";
} finally {
  // 例外の有無に関わらす実行されるコード 
  // データベース接続を終了するコードは例外の有無に関わらず実行する
  $dbh = NULL;
}
?>