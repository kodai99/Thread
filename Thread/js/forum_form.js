const form = document.getElementById("Post");

// エラーメッセージ
const Err = document.getElementById("Err");

// フォーム送信イベント
form.addEventListener("submit", (e) => {
  // 入力値
  const content = document.getElementById("content").value;
  const img = document.getElementById("img").value;

  // エラーチェック
  let errCount = 0;
  let err;

  // バリデーションチェック
  if(!content) {
    err = "投稿内容がありません。";
    errCount++;
  }

  if(errCount > 0) {
    e.preventDefault();
    Err.textContent = err;
  }
});