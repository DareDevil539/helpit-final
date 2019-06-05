<?php
$data = $_POST;
$errors = [];
if (isset($data["do_signup"])) {
  if (empty(trim($data["name"]))) {
    $errors[] = "Не введено ім'я";
  }
  if (empty(trim($data["username"]))) {
    $errors[] = "Не введено ім'я користувача";
  }
  if (empty(trim($data["email"]))) {
    $errors[] = "Не введено email";
  }
  if (empty(trim($data["password"]))) {
    $errors[] = "Не введено пароль";
  }
  if ($data["password_validate"] != $data["password"]) {
    $errors[] = "Паролі не співпадають";
  }
  if (R::count("user", "username = ?", [$data["username"]])) {
    $errors[] = "Користувач з таким іменем вже існує!";
  }
  if (R::count("user", "email = ?", [$data["email"]])) {
    $errors[] = "Користувач з даним email вже зареєстрований!";
  }

  if (empty($errors)) {
    $user = R::dispense("user");
    $user->name = $data["name"];
    $user->username = $data["username"];
    $user->email = $data["email"];
    $user->password = password_hash($data["password"], PASSWORD_DEFAULT);
    R::store($user);
    header("Location: /auth");
  }
}
?>

<div id="home">
  <?php
  if (isset($_SESSION["logged_user"])) :
    header("Location: /dashboard");
  else :?>
  <div class="parallax-window" data-parallax="scroll" data-image-src="resources/img/main.jpg"></div>
  <div class="container main_container">
    <div class="row">
      <div class="col m6 s12">
        <h1 class="center">Вітаємо в мережі HelpIT</h1>
        <p>Тут Ви можете знайти однодумців та вчителів, а також отримати хорошу пораду чи відповідь на питання,
          яке не дає Вам заснути</p>
        <p>То чому б не приєднатись до нашої дружньої сім'ї?</p>
      </div>
      <div class="col m6 s12">
        <div class="container center z-depth-3" id="reg_form">
          <h3>Реєстрація</h3>
          <small style="color: red;"><?php echo $errors[0]; ?></small>
          <form method="post" action="">
            <div class="input-field">
              <input id="first_name" name="name" type="text" value="<?php echo @$data["name"]; ?>" class="validate" required>
              <label class="active" for="first_name">Ім'я</label>
            </div>
            <div class="input-field">
              <input id="username" name="username" type="text" value="<?php echo @$data["username"]; ?>" class="validate" required>
              <label class="active" for="username">Ім'я користувача</label>
            </div>
            <div class="input-field">
              <input id="email" name="email" type="email" value="<?php echo @$data["email"]; ?>" class="validate" required>
              <label class="active" for="email">E-mail</label>
            </div>
            <div class="input-field">
              <input id="password" name="password" type="password" value="<?php echo @$data["password"]; ?>" class="validate" required>
              <label class="active" for="password">Пароль</label>
            </div>
            <div class="input-field">
              <input id="password_validate" name="password_validate" type="password" value="<?php echo @$data["password_validate"]; ?>" class="validate" required>
              <label class="active" for="password_validate">Повторіть пароль</label>
            </div>
            <div class="input-field">
              <button class="btn waves-effect" name="do_signup">Зареєструватись</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>