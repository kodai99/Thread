<?php
session_start();
require_once("../dbconnect.php");
require_once("../functions/makeTable.php");
require_once("../functions/operateTable.php");
require_once("../functions/security.php");

// ログインしていなければ、ログイン画面に遷移させる
if(!$_SESSION["login_user"]) {
  $_SESSION["error"] = "ログインしてください。";
  header("Location: ../login_logout/login_form.php");
  exit();
}

// 投稿データ テーブル作成
makeForumTable();

// 選択されたスレッドのID保持
if($_GET) {
  $_SESSION["thread_id"] = $_GET["id"];
}

// 変数
$threadId = $_SESSION["thread_id"];
$loginUserId = $_SESSION["login_user"]["id"];
$loginUserName = $_SESSION["login_user"]["name"];
$date = new DateTime();
$date = $date->format("Y/m/d H:i:s");
$imgData = null;
$err;

if(!empty($_POST["forum_id"]) && !empty($_POST["user_id"])) {
  // ログインしているユーザーの投稿かどうかを判別
  if((int)$_POST["user_id"] === $loginUserId) {
    $postedForumUserId = $_POST["forum_id"];
    deletePostedForum($postedForumUserId);
  }
} else {
  if(!empty($_POST)) {
    $content = $_POST["content"];
    if(!empty($_FILES["img"]["tmp_name"])) {
      $imgData = file_get_contents($_FILES["img"]["tmp_name"]);
    }
    // 投稿内容がある時
    if($content !== "") {
      postForum($threadId, $loginUserName, $content, $date, $imgData, $loginUserId);
    }
  }
}
  
// 選択したスレッド表示
$threadResult = displaySelectedThread($threadId);

// 選択したスレッド内の投稿表示
$forumResults = displayForums($threadId);

// リダイレクト処理
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  header('Location: forum.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>スレッド内容</title>
  <script src="https://kit.fontawesome.com/0e3314ce62.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
  <link rel="stylesheet" href="../styles/forum.css">
</head>
<body>
  <input id="menu" type="checkbox">
  <label for="menu" class="open"><i class="fas fa-grip-lines fa-lg"></i></label>
  <label for="menu" class="back"></label>
  <header>
    <h2>
      <a href="../home.php">AniGora</a>
    </h2>
  </header>
  <div id="header_right">
    <a href="../home.php" id="return_thread">スレッド一覧へ</a>
    <a href="forum_form.php" id="post_forum">投稿する</a>
    <form action="../login_logout/logout.php" method="POST">
      <input type="submit" name="logout" id="logout" value="ログアウト">
    </form>
  </div>
  <div id="main">
    <!-- スレッドを表示する -->
    <div id="thread_owner_post">
      <h3>スレ主：<?php echo h($threadResult["name"]) ?>さん</h3>
      <h2><?php echo h($threadResult["content"]) ?></h2>
    </div>
    <div id="thread_margin"></div>
    <!-- スレッド内の投稿を表示する -->
    <?php foreach($forumResults as $forumResult): ?>
      <div class="forum">
        <p class="forum_name"><?php echo h($forumResult["name"]) ?>さん</p>
        <p class="forum_content"><?php echo h($forumResult["content"]) ?></p>
        <?php if($forumResult["img"]): ?>
          <?php echo '<img class="forum_img" src="data:image/jpeg;base64,'.base64_encode( $forumResult['img'] ).'"/>'; ?>
        <?php endif; ?>
        <p class="forum_created_at"><?php echo $forumResult["created_at"] ?></p>
        <!-- 自分の投稿のみ削除ボタンを表示する -->
        <?php if($forumResult["users_id"] === $loginUserId): ?>
          <form action="forum.php" method="POST" class="delete">
            <input type="hidden" name="forum_id" value="<?php echo $forumResult["id"] ?>">
            <input type="hidden" name="user_id" value="<?php echo $forumResult["users_id"] ?>">
            <input type="submit" value="投稿を削除する" class="delete_button">
          </form>
        <?php endif; ?>
      </div>
      <div class="margin"></div>
    <?php endforeach; ?>
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