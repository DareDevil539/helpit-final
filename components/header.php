<nav>
  <div class="nav-wrapper">
    <a href="/" class="brand-logo"><img src="resources/img/logo.png" alt="logo" width="30" height="30"> HelpIT</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <?php if (!isset($_SESSION["logged_user"])) : ?>
      <li><a href="/auth">Вхід</a></li>
      <?php else : ?>
        <li>Привіт, <?php echo $_SESSION["logged_user"]["username"]; ?></li>
        <li><a href="/auth?logout=true">Вийти</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>