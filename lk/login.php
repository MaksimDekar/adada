<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Вход — Личный кабинет</title>

    <link rel="stylesheet" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="../assets/css/account.css" />
</head>
  <body>
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
          <button class="btn btn--ghost" data-theme-toggle type="button">
            <span class="icon">◐</span><span class="hide-sm">Тема</span>
          </button>
          <a class="btn btn--primary" href="index.php">ЛК</a>
        </div>
      </div>
    </header>

    <main id="content" class="section">
      <div class="container">
        <section class="card reveal auth-wrap">
          <h1>Вход в личный кабинет</h1>
          <p class="muted">Войдите, чтобы видеть полисы, оплаты и заявки.</p>

          <form id="loginForm" class="form" method="post" action="../actions/login.php" novalidate>
            <input type="hidden" name="back" value="../lk/login.php" />
            <input type="hidden" name="next" value="../lk/index.php" />
            <div class="field">
              <label for="email">Email</label>
              <input
                id="email"
                type="email"
                placeholder="you@mail.ru"
                required
              name="email">
            </div>
            <div class="field">
              <label for="password">Пароль</label>
              <input
                id="password"
                type="password"
                placeholder="минимум 6 символов"
                required
              name="password">
            </div>

            <div class="form__actions">
              <button class="btn btn--primary" type="submit">Войти</button>
              <a class="btn btn--ghost" href="register.php">Регистрация</a>
            </div>
            <div id="loginMsg" class="msg" role="status" aria-live="polite"><?= flash_html('login') ?></div>
          </form>

          <div class="note u-mt14">
            Если что-то не получается — нажмите «Поддержка» вверху, можно
            прикрепить скрин.
          </div>
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
          <a href="index.php">Личный кабинет</a>
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
