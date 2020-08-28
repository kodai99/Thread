const form = document.getElementById("makeThread");

// エラーメッセージ
const titleErr = document.getElementById("titleErr");
const contentErr = document.getElementById("contentErr");

// フォーム送信イベント
form.addEventListener("submit", (e) => {
  // 入力値
  const title = document.getElementById("title").value;
  const content = document.getElementById("content").value;

  // エラーチェック
  let errCount = 0;
  let errs = {
    title: "",
    content: ""
  };

  // バリデーションチェック
  if(!title) {
    errs.title = "＊スレッドタイトルを入力して下さい。";
    errCount++;
  }
  if(!content) {
    errs.content = "＊スレッド内容を入力して下さい。";
    errCount++;
  }


  if(errCount > 0) {
    e.preventDefault();
    titleErr.textContent = errs.title;
    contentErr.textContent = errs.content;
  }
});