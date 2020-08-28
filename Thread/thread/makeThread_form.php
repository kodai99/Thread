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
  <title>スレッド作成</title>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/makeThread_form.css">
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
  <form action="makeThread.php" method="POST" id="makeThread">
    <h1>スレッド作成</h1>
    <div id="title_input">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" placeholder="Title">
    </div>
    <div id="titleErr"></div>
    <div id="content_input">
      <label for="content">内容</label>
      <textarea name="content" id="content" placeholder="Content"></textarea>
    </div>
    <div id="contentErr"></div>
    <input type="submit" value="スレッド作成" id="submit_thread">
  </form>
  <script src="../js/makeThread_form.js"></script>
</body>
</html>