<?php
session_start();
require_once("../dbconnect.php");
require_once("../functions/makeTable.php");
require_once("../functions/operateTable.php");

// ユーザーデータ テーブル作成
makeUsersTable();

// 変数
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_conf = $_POST["password_conf"];
$error = NULL;

// 新規ユーザー登録
$result = userRegistration($name, $email, $password);

// 登録失敗時
if(!$result) {
  $error = "＊ユーザー登録に失敗しました。再度登録して下さい。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ユーザー登録完了</title>
  <script src="https://kit.fontawesome.com/0e3314ce62.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link rel="stylesheet" href="../styles/register.css">
</head>
<body>
  <header>
    <h2>
      <a href="login_form.php">AniGora</a>
    </h2>
  </header>
  <div id="result">
    <?php if($error): ?>
      <p id="msg"><?php echo $error ?></p>
      <a href="signup_form.php" id="toPage">
        <i class="fas fa-arrow-right"></i>新規登録ページへ
      </a>
    <?php else: ?>
      <p id="msg">ユーザー登録が完了しました！ログインして下さい。</p>
      <a href="../login_logout/login_form.php" id="toPage">
        <i class="fas fa-arrow-right"></i>ログインページへ
      </a>
    <?php endif; ?>
  </div>
</body>
</html>