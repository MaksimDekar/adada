<?php
require_once __DIR__ . '/../includes/helpers.php';
if (is_post()) {
    $login = trim((string)($_POST['user'] ?? $_POST['login'] ?? $_POST['username'] ?? ''));
    $pass = trim((string)($_POST['pass'] ?? $_POST['password'] ?? ''));
    if ($login === ADMIN_LOGIN && $pass === ADMIN_PASSWORD) {
        $_SESSION['admin_logged'] = true;
        redirect('index.php');
    }
    flash_set('admin_login', 'Неверный логин или пароль. Проверьте раскладку и введите admin / 123123.');
}
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Admin Login — EU KASKO</title>

    <link rel="stylesheet" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
</head>
  <body>
    <a class="skip" href="#content">Перейти к содержимому</a>

    <header class="header">
      <div class="container header__inner">
        <a class="brand" href="../index.php">
          <span class="brand__logo">EU</span>
          <span class="brand__text"
            ><strong>EU KASKO</strong><small>Админка</small></span
          >
        </a>
        <div class="header__actions">
          <button class="btn btn--ghost" data-theme-toggle type="button">
            <span class="icon">◐</span><span class="hide-sm">Тема</span>
          </button>
          <a class="btn btn--ghost" href="../index.php">На сайт</a>
        </div>
      </div>
    </header>

    <main id="content" class="section">
      <div class="container">
        <section class="card reveal u-mx-auto-560">
          <h1 class="u-mb6-only">Вход администратора</h1>
          <p class="muted">
            Введите данные администратора для доступа к панели управления.
          </p>

          <form id="loginForm" class="form" method="post" action="login.php" novalidate>
            <div class="field">
              <label for="user">Логин</label
              ><input
                id="user"
                autocomplete="username"
                placeholder="admin"
                required
              name="user">
            </div>
            <div class="field">
              <label for="pass">Пароль</label
              ><input
                id="pass"
                type="password"
                autocomplete="current-password"
                placeholder="123123"
                required
              name="pass">
            </div>

            <div class="form__actions">
              <button class="btn btn--primary" type="submit">Войти</button>
              <a class="btn btn--ghost" href="../index.php">На сайт</a>
            </div>

            <div id="loginMsg" class="msg" role="status" aria-live="polite"><?= flash_html('admin_login') ?></div>
          </form>
        </section>
      </div>
    </main>

    <footer class="footer">
      <div class="container footer__grid">
        <div class="footer__meta">
          <span class="muted">© <span id="yearNow"></span> EU KASKO</span>
        </div>
        <div class="footer__links"><a href="../index.php">Главная</a></div>
      </div>
    </footer>

    <script src="../assets/js/app.js" defer></script>
  </body>
</html>
