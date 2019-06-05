<?php
if ($_GET["logout"] === "true") {
  unset($_SESSION["logged_user"]);
  header("Location: /");
}
if (isset($_SESSION["logged_user"])) {
  header("Location: /");
}
$data = $_POST;
$errors = [];
if (isset($data["do_login"])) {
if (empty(trim($data["username"]))) {
  $errors[] = "Не введено ім'я користувача";
}
if (empty(trim($data["password"]))) {
  $errors[] = "Не введено пароль";
}

if (empty($errors)) {
  $user = R::findOne("user", "username = ?", [$data["username"]]);
  if ($user) {
    if (password_verify($data["password"], $user->password)) {
      $_SESSION["logged_user"] = $user;
      header("Location: /");
    } else {
      $errors[] = "Невірно введено пароль!";
    }
  } else {
    $errors[] = "Користувач з таким іменем не знайдений!";
  }
}
}
?>

<div id="auth" class="container center">
  <h3>Вхід</h3>
  <small style="color: red;"><?php echo $errors[0]; ?></small>
  <form method="post" action="auth">
    <div class="input-field">
      <input id="username" name="username" type="text" value="<?php echo @$data["username"]; ?>" class="validate" required>
      <label class="active" for="username">Ім'я користувача</label>
    </div>
    <div class="input-field">
      <input id="password" name="password" type="password" value="<?php echo @$data["password"]; ?>" class="validate" required>
      <label class="active" for="password">Пароль</label>
    </div>
    <div class="input-field">
      <button class="btn waves-effect" name="do_login">Увійти</button>
    </div>
  </form>
</div>