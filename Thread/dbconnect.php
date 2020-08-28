<?php
function dbconnect() {
  $dsn = 'データベース名';
  $user = "ユーザー名";
  $password = "パスワード";
  try {
    $pdo = new PDO(
      $dsn,
      $user,
      $password,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ],
    );
    return $pdo;
  } catch(PDOException $e) {
    $error = $e->getMessage();
    echo "接続に失敗しました。<br>エラー内容：{$error}";
    exit();
  }
}
?>