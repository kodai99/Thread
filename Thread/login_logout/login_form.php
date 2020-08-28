<?php
session_start();

// 既にログインしていたら、ログイン画面に遷移しない
if(!empty($_SESSION["login_user"])) {
  header("Location: ../home.php");
  exit();
}

// リロード後にエラーを非表示にする
$error = $_SESSION;
$_SESSION = [];
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン画面</title>
  <script src="https://kit.fontawesome.com/0e3314ce62.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/login_form.css">
</head>
<body>
  <header>
    <h2>
      <a href="login_form.php">AniGora</a>
    </h2>
  </header>
  <div id="login_form">
    <form action="login.php" method="POST">
      <h1>ログイン</h1>
      <div id="dbErr">
        <?php if(isset($error["error"])): ?>
          <p><?php echo $error["error"] ?></p>
        <?php endif; ?>
      </div>
      <div id="email_input">
        <label for="email"><i class="fas fa-envelope fa-sm"></i></label>
        <input type="email" name="email" id="email" placeholder="Email">
      </div>
      <div id="emailErr">
        <?php if(isset($error["email"])): ?>
          <p><?php echo $error["email"] ?></p>
        <?php endif; ?>
      </div>
      <div id="password_input">
        <label for="password"><i class="fas fa-lock"></i></label>
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
      <div id="passwordErr">
        <?php if(isset($error["password"])): ?>
          <p><?php echo $error["password"] ?></p>
        <?php endif; ?>
      </div>
      <a href="../signup/signup_form.php" id="signup">新規登録はこちら</a>
      <input type="submit" value="ログイン" id="login">
    </form>
  </div>
  <div class="figure"></div>
  <i class="fas fa-tv fa-10x tv"></i>
  <h2 class="icon_comment">Welcome!</h2>
  <script src="../js/login_form.js"></script>
</body>
</html>