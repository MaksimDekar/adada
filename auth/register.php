<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Регистрация — ЛК</title>

    <link rel="stylesheet" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="../assets/css/account.css" />

    <meta http-equiv="refresh" content="0; url=../lk/register.php" />
</head>
  <body>
    <script>
      // Canonical page moved to /lk/register.php
      try {
        location.replace("../lk/register.php" + (location.search || ""));
      } catch (e) {}
    </script>
    <a class="skip" href="#content">Перейти к содержимому</a>
    <header class="header">
      <div class="container header__inner">
        <a class="brand" href="../index.php">
          <span class="brand__logo">EU</span>
          <span class="brand__text"
            ><strong>EU KASKO</strong><small>Личный кабинет</small></span
          >
        </a>
        <div class="header__actions">
          <a class="btn btn--ghost" href="../pages/quote.php">Калькулятор</a>
          <a class="btn btn--ghost" href="../pages/checkout.php">Оплата</a>
          <a class="btn btn--primary" href="../lk/index.php">ЛК</a>
        </div>
      </div>
    </header>
    <main id="content" class="section">
      <div class="container">
        <section class="card reveal auth-wrap">
          <h1>Регистрация</h1>
          <p class="muted">
            Создайте аккаунт, чтобы видеть свои полисы и заявки.
          </p>

          <form id="registerForm" class="form" method="post" action="../actions/register.php" novalidate>
            <input type="hidden" name="back" value="../auth/register.php" />
            <div class="field">
              <label for="name">Имя</label
              ><input id="name" required placeholder="Иван" name="name">
            </div>
            <div class="field">
              <label for="phone">Телефон</label
              ><input id="phone" placeholder="+7..." name="phone">
            </div>
            <div class="field">
              <label for="email">Email</label
              ><input
                id="email"
                type="email"
                required
                placeholder="you@mail.ru"
              name="email">
            </div>

            <div class="grid2 tight">
              <div class="field">
                <label for="password">Пароль</label
                ><input
                  id="password"
                  type="password"
                  required
                  placeholder="мин. 6 символов"
                name="password">
              </div>
              <div class="field">
                <label for="password2">Повтор</label
                ><input
                  id="password2"
                  type="password"
                  required
                  placeholder="ещё раз"
                name="password2">
              </div>
            </div>

            <label class="check"
              ><input type="checkbox" id="agree" name="agree" value="1" /><span
                >Согласен(на) с условиями</span
              ></label
            >

            <div class="form__actions">
              <button class="btn btn--primary" type="submit">Создать</button>
              <a class="btn btn--ghost" href="login.php">Уже есть аккаунт</a>
            </div>

            <div id="registerMsg" class="msg" role="status" aria-live="polite"><?= flash_html('register') ?></div>
          </form>
        </section>
      </div>
    </main>
    <footer class="footer">
      <div class="container footer__grid">
        <div>
          <div class="brand brand--footer">
            <span class="brand__logo">EU</span>
            <span class="brand__text"
              ><strong>EU KASKO</strong
              ><small>Страховка для европейских авто (2016–2025)</small></span
            >
          </div>
          <p class="muted">
            Оформление и поддержка онлайн. Все документы доступны в личном
            кабинете.
          </p>
        </div>
        <div class="footer__links">
          <a href="../pages/quote.php">Калькулятор</a>
          <a href="../pages/checkout.php">Оплата</a>
          <a href="../lk/index.php">Личный кабинет</a>
        </div>
        <div class="footer__meta">
          <span class="muted">© <span id="yearNow"></span> EU KASKO</span>
        </div>
      </div>
    </footer>

    <script src="../assets/js/app.js" defer></script>
    <script src="../assets/js/account.js" defer></script>
  </body>
</html>
