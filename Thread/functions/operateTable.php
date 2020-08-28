<?php
// 新規ユーザー登録
function userRegistration($name, $email, $password) {
  $pdo = dbconnect();

  $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, $name, PDO::PARAM_STR);
  $stmt->bindValue(2, $email, PDO::PARAM_STR);
  $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $result = $stmt->execute();
  return $result;
}

// メールアドレスからユーザーデータ取得
function getUserByEmail($email, $password) {
  $pdo = dbconnect();

  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, $email, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch();
  return $user;
}

// 検索に一致するスレッド一覧をホームに表示
function displaySearchedThreads($searchWord) {
  $pdo = dbconnect();

  $sql = "SELECT * FROM threads WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, "%$searchWord%", PDO::PARAM_STR);
  $stmt->bindValue(2, "%$searchWord%", PDO::PARAM_STR);
  $stmt->execute();
  $searchedResults = $stmt->fetchAll();
  return $searchedResults;
}

// スレッド一覧をホームに表示
function displayThreads() {
  $pdo = dbconnect();

  $sql = "SELECT * FROM threads ORDER BY created_at DESC";
  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  return $results;
}

// スレッドデータ登録
function makeThread($loginUserName, $title, $content, $date) {
  $pdo = dbconnect();

  $sql = "INSERT INTO threads (name, title, content, created_at) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, $loginUserName, PDO::PARAM_STR);
  $stmt->bindValue(2, $title, PDO::PARAM_STR);
  $stmt->bindValue(3, $content, PDO::PARAM_STR);
  $stmt->bindValue(4, $date, PDO::PARAM_STR);
  $result = $stmt->execute();
  return $result;
}

// 掲示板に投稿
function postForum($threadId, $loginUserName, $content, $date, $imgData, $loginUserId) {
  $pdo = dbconnect();

  $sql = "INSERT INTO forums (thread_id, name, content, created_at, img, users_id) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, (int)$threadId, PDO::PARAM_INT);
  $stmt->bindValue(2, $loginUserName, PDO::PARAM_STR);
  $stmt->bindValue(3, $content, PDO::PARAM_STR);
  $stmt->bindValue(4, $date, PDO::PARAM_STR);
  $stmt->bindValue(5, $imgData, PDO::PARAM_LOB);
  $stmt->bindValue(6, (int)$loginUserId, PDO::PARAM_INT);
  $stmt->execute();
}

// 掲示板の投稿を削除
function deletePostedForum($postedForumUserId) {
  $pdo = dbconnect();

  $sql = "DELETE FROM forums WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, (int)$postedForumUserId, PDO::PARAM_INT);
  $stmt->execute();
}

// 選択したスレッド表示
function displaySelectedThread($threadId) {
  $pdo = dbconnect();

  $sql = "SELECT * FROM threads WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, (int)$threadId, PDO::PARAM_INT);
  $stmt->execute();
  $threadResult = $stmt->fetch();
  return $threadResult;
}

// スレッド内の投稿表示
function displayForums($threadId) {
  $pdo = dbconnect();

  $sql = "SELECT * FROM forums WHERE thread_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, (int)$threadId, PDO::PARAM_INT);
  $stmt->execute();
  $forumResults = $stmt->fetchAll();
  return $forumResults;
}
?>