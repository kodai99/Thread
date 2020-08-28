<?php
session_start();
require_once("../dbconnect.php");
require_once("../functions/operateTable.php");

// ログインしていなければ、ログイン画面に遷移させる
if(!$_SESSION["login_user"]) {
  $_SESSION["error"] = "ログインしてください。";
  header("Location: ../login_logout/login_form.php");
  exit();
}

// 変数
$loginUserName = $_SESSION["login_user"]["name"];
$title = $_POST["title"];
$content = $_POST["content"];
$date = new DateTime();
$date = $date->format("Y/m/d H:i:s");
$error = NULL;

// スレッドデータ登録
$result = makeThread($loginUserName, $title, $content, $date);

if(!$result) {
  $error = "スレッドの作成に失敗しました。";
} else{
  header("Location: ../home.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>スレッド</title>
</head>
<body>
  <?php if(!$error): ?>
    <h2><?php echo $error ?></h2>
  <?php endif; ?>
</body>
</html>