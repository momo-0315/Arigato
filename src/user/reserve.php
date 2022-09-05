<?php

session_start();

$id = $_GET['id'];

$favourites = isset($_SESSION['favourites']) ? $_SESSION['favourites'] : [];

?>

<?php include('./common/user_header.php'); ?>

<body>
  <div class="reserve">
    <h1 class="reserve__title">申し込み</h1>
    <table class="favourites__table">
      <tr>
        <th>エアビ名</th>
        <th>価格</th>
        <th>収容人数</th>
      </tr>
      <tr>
        <td><?= $favourites[$id]['name'] ?></td>
        <td>¥<?= $favourites[$id]['price'] ?>/泊</td>
        <td><?= $favourites[$id]['capacity'] ?>人</td>
      </tr>
    </table>
    <form action="" method="post">

    </form>
   

    <form action="" method="post" enctype="multipart/form-data">
      <p class="userform_heading">個人情報の入力</p>
      <span class="err-msg-name"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_name">氏名<span class="required">必須</span></label>
        <input class="userform_text--box" type="text" name="student_name" id="name" placeholder="例）山田太郎" />
      </div>
      <span class="err-msg-email"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_email">メールアドレス<span class="required">必須</span></label>
        <input class="userform_text--box" type="email" name="student_email" id="email" placeholder="例）taroyamada@gmail.com">
      </div>
      <span class="err-msg-phone"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_phone">電話番号<span class="required">必須</span></label>
        <input class="userform_text--box" type="tel" name="student_phone" id="phone" placeholder="例）09011110000">
      </div>
      <span class="err-msg-university"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_university">大学<span class="required">必須</span></label>
        <input class="userform_text--box" type="text" name="student_university" id="university" placeholder="例）〇〇大学">
      </div>
      <span class="err-msg-faculty"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_faculty">学部・学科<span class="required">必須</span></label>
        <input class="userform_text--box" type="text" name="student_faculty" id="faculty" placeholder="例）〇〇学部〇〇学科">
      </div>
      <span class="err-msg-address"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_address">住所<span class="required">必須</span></label>
        <input class="userform_text--box" type="text" name="student_address" id="address" placeholder="例）東京都〇〇区1-1-1">
      </div>
      <span class="err-msg-graduation"></span>
      <div class="userform_text">
        <label class="userform_text--label" for="student_graduation">卒業年<span class="required">必須</span></label>
        <select class="userform_text--select" name="student_graduation" id="graduation" value="<?= $_SESSION["student_graduation"] ?>" placeholder="選択してください">
          <option selected value="">選択してください</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
        </select>
      </div>
      <a class="favourites__link" href="/user/index.php">一覧に戻る</a>
      <input type="submit" name="confirm" value="確認画面へ" class="userform_button userform_button--right confirm">
    </form>
  </div>

</body>

</html>