<?php
session_start();
require_once("dbconnect.php");
require_once("./functions/makeTable.php");
require_once("./functions/operateTable.php");
require_once("./functions/security.php");

// ログインしていなければ、ログイン画面に遷移させる
if(!$_SESSION["login_user"]) {
  $_SESSION["error"] = "ログインしてください。";
  header("Location: login_logout/login_form.php");
  exit();
}

// // スレッドデータ テーブル作成
makeThreadsTable();


if(!empty($_GET["search"])) {
  // 検索時
  $_SESSION["search"] = $_GET["search"];
  $searchWord = $_SESSION["search"];
  $searchedResults = displaySearchedThreads($searchWord);
} else{
  // それ以外
  $_SESSION["search"] = NULL;
  $results = displayThreads();
}

// リダイレクト処理
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  header('Location: home.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>スレッド一覧</title>
  <script src="https://kit.fontawesome.com/0e3314ce62.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
  <input id="menu" type="checkbox">
  <label for="menu" class="open"><i class="fas fa-grip-lines fa-lg"></i></label>
  <label for="menu" class="back"></label>
  <header>
    <h2>
      <a href="home.php">AniGora</a>
    </h2>
  </header>
  <div id="header_right">
    <form action="home.php" method="GET">
      <div>
        <label for="search"><i class="fas fa-search fa-sm"></i></label>
        <input type="text" name="search" id="search" placeholder="Search">
      </div>
    </form>
    <a href="./thread/makeThread_form.php" id="makeThread">スレッド作成</a>
    <form action="./login_logout/logout.php" method="POST">
      <input type="submit" name="logout" id="logout" value="ログアウト">
    </form>
  </div>
  <div id="main">
    <?php if(!empty($_GET["search"])): ?>
      <?php foreach($searchedResults as $searchedResult): ?>
        <div class="thread">
          <h2><a class="thread_title" href="./forum/forum.php?id=<?php echo $searchedResult['id'] ?>"><?php echo h($searchedResult["title"]) ?></a></h2>
          <p class="thread_content"><?php echo h($searchedResult["content"]) ?></p>
          <p class="thread_owner">スレッド作成者：<?php echo h($searchedResult["name"]) ?>さん</p>
          <p class="thread_created_at">作成日：<?php echo $searchedResult["created_at"] ?></p>
        </div>
        <div class="margin"></div>
      <?php endforeach; ?>
    <?php else: ?>
      <?php foreach($results as $result): ?>
        <div class="thread">
          <h2><a class="thread_title" href="./forum/forum.php?id=<?php echo $result['id'] ?>"><?php echo h($result["title"]) ?></a></h2>
          <p class="thread_content"><?php echo h($result["content"]) ?></p>
          <p class="thread_owner">スレッド作成者：<?php echo h($result["name"]) ?>さん</p>
          <p class="thread_created_at">作成日：<?php echo $result["created_at"] ?></p>
        </div>
        <div class="margin"></div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <aside>
    <i class="far fa-comment-dots fa-8x"></i>
    <h1>AniGoraへようこそ！</h1>
    <h4>アニメに関する話題で盛り上がれる掲示板です！</h4>
  </aside>
  <!-- トップに戻るボタン -->
  <a href="#" id="back_to_top"><i class="fas fa-angle-double-up fa-2x"></i></a>
</body>
</html>