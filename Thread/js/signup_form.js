const form = document.querySelector("form");

// エラーメッセージ
const nameErr = document.getElementById("nameErr");
const emailErr = document.getElementById("emailErr");
const passwordErr = document.getElementById("passwordErr");
const password_confErr = document.getElementById("password_confErr");

// バリデーション
const nameValidation = /^[a-zA-Z]{6,12}$/;
const emailValidation = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
const passwordValidation = /^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/;

// フォーム送信イベント
form.addEventListener("submit", (e) => {
  // 入力値
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const password_conf = document.getElementById("password_conf").value;

  // エラーチェック
  let errCount = 0;
  let errs = {
    name: "",
    email: "",
    password: "",
    password_conf: "",
  };

  // バリデーションチェック
  if(!nameValidation.test(name)) {
    errs.name = "＊ユーザー名を6~12文字で入力して下さい。";
    errCount++;
  }
  if(!emailValidation.test(email)) {
    errs.email = "＊メールアドレスを入力して下さい。";
    errCount++;
  }
  if(!passwordValidation.test(password)) {
    errs.password = "＊パスワードを英小大文字数字を含む8~100文字で入力して下さい。";
    errCount++;
  }
  if(password !== password_conf) {
    errs.password_conf = "＊パスワードと一致しません。";
    errCount++;
  }

  if(errCount > 0) {
    e.preventDefault();
    nameErr.textContent = errs.name;
    emailErr.textContent = errs.email;
    passwordErr.textContent = errs.password;
    password_confErr.textContent = errs.password_conf; 
  }
});