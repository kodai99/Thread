<?php
session_start();
require_once("../dbconnect.php");
require_once("../functions/operateTable.php");

// 変数
$email = $_POST["email"];
$password = $_POST["password"];

// メールアドレスからユーザーデータ取得
$user = getUserByEmail($email, $password);

// 該当するデータが無ければ、ログイン画面に戻す
if(!$user) {
  $_SESSION["email"] = "＊登録されていないメールアドレスです。";
  header("Location: login_form.php");
  exit();
}

// 該当するデータのパスワードと一致しなければ、ログイン画面に戻す
if(!password_verify($password, $user["password"])) {
  $_SESSION["password"] = "＊パスワードが一致しません。";
  header("Location: login_form.php");
  exit();
}

// ログイン成功時
session_regenerate_id(true);
$_SESSION["login_user"] = $user;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン完了</title>
  <style>
    body {
      background-color: black;
    }
  </style>
</head>
<body>
  <script>
    location.href = "../home.php";
  </script>
</body>
</html> 