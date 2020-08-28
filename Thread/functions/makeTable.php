<?php
// ユーザーデータ テーブル作成
function makeUsersTable() {
  $pdo = dbconnect();

  $sql = "CREATE TABLE IF NOT EXISTS users"
  ."("
  ."id INT AUTO_INCREMENT PRIMARY KEY,"
  ."name varchar(64),"
  ."email varchar(191),"
  ."password varchar(191)"
  .");";
  $stmt = $pdo->query($sql);
}

// スレッドデータ テーブル作成
function makeThreadsTable() {
  $pdo = dbconnect();

  $sql = "CREATE TABLE IF NOT EXISTS threads"
  ."("
  ."id INT AUTO_INCREMENT PRIMARY KEY,"
  ."name varchar(64),"
  ."title varchar(255),"
  ."content text,"
  ."created_at datetime"
  .");";
  $stmt = $pdo->query($sql);
}

// 投稿データ テーブル作成
function makeForumTable() {
  $pdo = dbconnect();

  $sql = "CREATE TABLE IF NOT EXISTS forums"
  ."("
  ."id INT AUTO_INCREMENT PRIMARY KEY,"
  ."thread_id INT,"
  ."name varchar(64),"
  ."content text,"
  ."created_at datetime,"
  ."img mediumblob,"
  ."users_id INT"
  .");";
  $stmt = $pdo->query($sql);
}
?>