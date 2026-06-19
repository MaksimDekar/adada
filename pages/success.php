<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Успех — EU KASKO</title>

    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
  <body>
    <a class="skip" href="#content">Перейти к содержимому</a>
    <header class="header">
      <div class="container header__inner">
        <a class="brand" href="../index.php">
          <span class="brand__logo">EU</span>
          <span class="brand__text"
            ><strong>EU KASKO</strong
            ><small>• EU авто 2016–2025</small></span
          >
        </a>

        <nav class="nav" aria-label="Основная навигация">
          <button
            class="nav__burger"
            type="button"
            aria-label="Открыть меню"
            aria-expanded="false"
          >
            <span></span><span></span><span></span>
          </button>
          <ul class="nav__list">
            <li><a class="nav__link" href="../index.php">Главная</a></li>
            <li><a class="nav__link" href="quote.php">Рассчитать</a></li>
            <li><a class="nav__link" href="plans.php">Планы</a></li>
            <li><a class="nav__link" href="about.php">Покрытие</a></li>
            <li><a class="nav__link" href="guides.php">Полезное</a></li>
            <li><a class="nav__link" href="faq.php">FAQ</a></li>
            <li><a class="nav__link" href="contact.php">Контакты</a></li>
            <li><a class="nav__link" href="legal.php">Документы</a></li>
          </ul>
        </nav>

        <div class="header__actions">
          <a
            class="btn btn--ghost"
            data-auth-link
            data-auth-login="../lk/login.php"
            data-auth-lk="../lk/index.php"
            href="../lk/login.php"
            >Войти</a
          >
          <button class="btn btn--ghost" data-theme-toggle type="button">
            <span class="icon">◐</span><span class="hide-sm">Тема</span>
          </button>
          <a class="btn btn--primary" href="../pages/quote.php">Рассчитать</a>
        </div>
      </div>
    </header>
    <main id="content">
      <section class="section">
        <div class="container">
          <section class="card reveal">
            <h1>Оплата успешна ✅</h1>
            <p class="muted">
              Создан полис. Он появится в ЛК (если email совпадает).
            </p>
            <div id="policyBox" class="summary"><?= policy_success_html(isset($_GET['policy_id']) ? (int)$_GET['policy_id'] : 0) ?></div>
            <div class="form__actions">
              <button class="btn btn--primary" id="download" type="button">
                Скачать подтверждение
              </button>
              <a class="btn btn--ghost" href="../lk/index.php"
                >В личный кабинет</a
              >
              <a class="btn btn--ghost" href="claims.php">Заявить случай</a>
            </div>
          </section>
        </div>
      </section>
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
          <a href="../pages/plans.php">Планы</a>
          <a href="../pages/about.php">Покрытие</a>
          <a href="../pages/guides.php">Полезное</a>
          <a href="../pages/contact.php">Контакты</a>
          <a href="../lk/index.php">Личный кабинет</a>
        </div>
        <div class="footer__meta">
          <span class="muted">© <span id="yearNow"></span> EU KASKO</span>
        </div>
      </div>
    </footer>

    <script src="../assets/js/app.js" defer></script>
  </body>
</html>
