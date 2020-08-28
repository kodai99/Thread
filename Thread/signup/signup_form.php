<?php
session_start();

// 既にログインしていたら、新規登録画面に遷移しない
if(!empty($_SESSION["login_user"])) {
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
  <title>新規登録</title>
  <script src="https://kit.fontawesome.com/0e3314ce62.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/signup_form.css">
</head>
<body>
  <header>
    <h2>
      <a href="signup_form.php">AniGora</a>
    </h2>
  </header>
  <div id="signup_form">
    <form action="register.php" method="POST">
      <h1>新規登録</h1>
      <div id="name_input">
        <label for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="name" id="name" placeholder="Name">
      </div>
      <div id="nameErr"></div>
      <div id="email_input">
        <label for="email"><i class="fas fa-envelope fa-sm"></i></label>
        <input type="email" name="email" id="email" placeholder="Email">
      </div>
      <div id="emailErr"></div>
      <div id="password_input">
        <label for="password"><i class="fas fa-lock"></i></label>
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
      <div id="passwordErr"></div>
      <div id="password_conf_input">
        <label for="password_conf"><i class="fas fa-lock"></i></label>
        <input type="password" name="password_conf" id="password_conf" placeholder="Confirm">
      </div>
      <div id="password_confErr"></div>
      <a href="../login_logout/login_form.php" id="login">ログインはこちら</a>
      <input type="submit" value="新規登録" id="signup">
    </form>
  </div>
  <div class="figure"></div>
  <i class="fas fa-tv fa-10x tv"></i>
  <h2 class="icon_comment">Welcome!</h2>
  <script src="../js/signup_form.js"></script>
</body>
</html>