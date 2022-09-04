<?php
session_start();
require('../dbconnect.php');

$err_msg = "";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = 'SELECT count(*) FROM admins WHERE email = ? AND password = ?';
  $stmt = $db->prepare($sql);
  $stmt->execute(array($email, $password));
  $result = $stmt->fetch();

  $sql_session = "SELECT * FROM admins WHERE email = ? AND password = ?";
  $stmt = $db->prepare($sql_session);
  $stmt->execute(array($email, $password));
  $login_info = $stmt->fetch();



	  // result に一つでも値が入っているなら、ログイン情報が存在するということ
    if ($result[0] != 0) {
      // 成功した場合管理画面に遷移
  
      $_SESSION['id'] = $login_info['id'];
      $_SESSION['email'] = $login_info['email'];
  
      header('Location: http://localhost/admin/index.php');
      exit;
    } else {
      $err_msg = "ユーザー名またはパスワードが間違っています";
    }
  }
?>


<?php
include('./common/admin_header.php'); 
?>

<section class="login__wrapper">

  <div class="login">

    <h1>管理者ログイン</h1>
    <form action="login.php" method="POST">
      <label>メールアドレス
        <input type="email" name="email" id="email" placeholder="Email Address" required>
      </label>
      <br>
      <label>パスワード
        <input type="password" name="password" id="password" placeholder="Password" required>
      </label>
      <br>
      <label>
        <input type="submit" name="login" value="ログイン">
      </label>
    </form>
  </div>
  <div>
  <?php if ($err_msg !== null && $err_msg !== '') {
    echo "<p>" . $err_msg .  "</p>";
} ?>
  </div>
</section>

</html>
