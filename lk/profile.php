<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = require_user_from_subdir();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Профиль — ЛК</title>

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
          <a class="btn btn--primary" href="../lk/index.php">ЛК</a>
        </div>
      </div>
    </header>
    <main id="content" class="section">
      <div class="container lk-shell">
        <aside class="lk-side reveal">
          <div class="muted u-m4-0-10">Навигация</div>
          <nav class="lk-nav">
            <a data-lk-link href="index.php"
              >Обзор <span class="badge">LK</span></a
            >
            <a data-lk-link href="policies.php"
              >Полисы <span class="badge">₽</span></a
            >
            <a data-lk-link href="claims.php"
              >Случаи <span class="badge">🧾</span></a
            >
            <a data-lk-link href="profile.php"
              >Профиль <span class="badge">@</span></a
            >
            <a data-lk-link href="settings.php"
              >Настройки <span class="badge">⚙</span></a
            >
          </nav>
          <div class="note u-mt12">
            Вы вошли как: <b id="lkUserBadge"><?= e($user['email']) ?></b>
          </div>
          <div id="lkAuthQuick"></div>
          <a class="btn btn--ghost btn--block" id="lkLogout" href="../actions/logout.php">Выйти</a>
          <div class="mini-help">Данные доступны в личном кабинете.</div>
        </aside>

        <section class="card reveal">
          <div class="lk-topline">
            <div>
              <h1 class="u-mb6">Профиль</h1>
              <p class="muted u-m0">
                Редактирование данных аккаунта.
              </p>
            </div>
            <div class="inline">
              <a class="btn btn--ghost" href="../pages/quote.php"
                >Новый расчёт</a
              >
              <a class="btn btn--primary" href="../pages/checkout.php"
                >Оформить полис</a
              >
            </div>
          </div>

          <div id="lkProfile">
            <form id="profileForm" class="form" method="post" action="../actions/profile_update.php" novalidate>
              <div class="field">
                <label for="emailRO">Email</label
                ><input id="emailRO" disabled name="emailRO" value="<?= e($user['email']) ?>" />
              </div>
              <div class="field">
                <label for="name">Имя</label><input id="name" required name="name" value="<?= e($user['name']) ?>" />
              </div>
              <div class="field">
                <label for="phone">Телефон</label
                ><input id="phone" placeholder="+7..." name="phone" value="<?= e($user['phone']) ?>" />
              </div>
              <div class="form__actions">
                <button class="btn btn--primary" type="submit">
                  Сохранить
                </button>
              </div>
              <div id="profileMsg" class="msg" role="status" aria-live="polite"><?= flash_html('profile') ?></div>
            </form>
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
