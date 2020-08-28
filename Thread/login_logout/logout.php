<?php
session_start();

// セッションの有効期限をチェック
if(!$_SESSION["login_user"]) {
  exit("セッションの有効期限が切れました。再度ログインしてください。");
}

// ログアウト成功時
$_SESSION = [];
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログアウト</title>
  <style>
    body {
      background-color: black;
    }
  </style>
</head>
<body>
  <script>
    location.href = "./login_form.php";
  </script>
</body>
</html>