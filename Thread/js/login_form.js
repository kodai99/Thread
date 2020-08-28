const form = document.querySelector("form");

// エラーメッセージ
const emailErr = document.getElementById("emailErr");
const passwordErr = document.getElementById("passwordErr");

// フォーム送信イベント
form.addEventListener("submit", (e) => {
  // 入力値
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // エラーチェック
  let errCount = 0;
  let errs = {
    email: "",
    password: "",
  };

  // バリデーションチェック
  if(!email) {
    errs.email = "＊メールアドレスを入力してください。";
    errCount++;
  }
  if(!password) {
    errs.password = "＊パスワードを入力してください。";
    errCount++;
  }

  if(errCount > 0) {
    e.preventDefault();
    emailErr.textContent = errs.email;
    passwordErr.textContent = errs.password;
  }
});