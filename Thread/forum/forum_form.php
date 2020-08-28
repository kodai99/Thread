<?php
session_start();

// ログインしていなければ、ログイン画面に遷移させる
if(!$_SESSION["login_user"]) {
  $_SESSION["error"] = "ログインしてください。";
  header("Location: ../login_logout/login_form.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>投稿</title>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/forum_form.css">
</head>
<body>
  <header>
    <h2>
      <a href="../home.php">AniGora</a>
    </h2>
    <div id="header_right">
      <form action="../login_logout/logout.php" method="POST">
        <input type="submit" name="logout" id="logout" value="ログアウト">
      </form>
  </div>
  </header>
  <form action="forum.php" method="POST" enctype="multipart/form-data" id="Post">
    <h1>投稿する</h1>
    <div id="Err"></div>
    <div id="content_input">
      <label for="content">内容</label>
      <textarea name="content" id="content" placeholder="Content"></textarea>
    </div>
    <div id="file_input">
      <label for="file">画像</label>
      <input type="file" name="img" id="img">
    </div>
    <input type="submit" value="スレッド作成" id="submit_post">
  </form>
  <script src="../js/forum_form.js"></script>
</body>
</html>