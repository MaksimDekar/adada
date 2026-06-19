<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Контакты — EU KASKO</title>

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
          <div class="page-head reveal">
            <h1>Контакты</h1>
            <p class="muted">
              Можно написать через форму, или открыть «Поддержка» (кнопка
              сверху) и прикрепить скрин/фото.
            </p>
          </div>

          <div class="grid2">
            <section class="card reveal">
              <h2 class="h3">Написать нам</h2>
              <form id="contactForm" class="form" method="post" action="../actions/contact_submit.php" novalidate>
                <div class="field">
                  <label for="name">Имя</label
                  ><input id="name" name="name" required />
                </div>
                <div class="field">
                  <label for="email">Email</label
                  ><input id="email" name="email" type="email" required />
                </div>
                <div class="field">
                  <label for="phone">Телефон</label
                  ><input
                    id="phone"
                    name="phone"
                    type="tel"
                    placeholder="+7..."
                  />
                </div>
                <div class="field">
                  <label for="msg">Сообщение</label
                  ><textarea
                    id="msg"
                    name="msg"
                    rows="5"
                    placeholder="Опишите вопрос или ситуацию"
                  ></textarea>
                </div>
                <div class="form__actions">
                  <button class="btn btn--primary" type="submit">
                    Отправить
                  </button>
                  <a class="btn btn--ghost" href="../lk/index.php"
                    >Личный кабинет</a
                  >
                </div>
                <div id="contactMsg" class="msg" role="status" aria-live="polite"><?= flash_html('contact') ?></div>
              </form>
              <div class="mini">
                Для обращений со скриншотами удобнее «Поддержка» — там есть
                прикрепление картинки.
              </div>
            </section>

            <aside class="card card--sticky reveal">
              <h2 class="h3">Каналы связи</h2>
              <div class="breakdown">
                <div class="row">
                  <span class="muted">Email</span><b>support@eukasko.ru</b>
                </div>
                <div class="row">
                  <span class="muted">Телефон</span><b>8 (800) 000‑00‑00</b>
                </div>
                <div class="row">
                  <span class="muted">Мессенджеры</span
                  ><b>MAX / ВКонтакте</b>
                </div>
                <div class="row">
                  <span class="muted">Время</span><b>ежедневно 09:00–21:00</b>
                </div>
              </div>

              <div class="stack u-mt12">
                <a class="btn btn--primary btn--block" href="quote.php"
                  >Калькулятор</a
                >
                <a class="btn btn--ghost btn--block" href="guides.php"
                  >Полезное</a
                >
                <a class="btn btn--ghost btn--block" href="faq.php">FAQ</a>
              </div>

              <small class="muted"
                >Если вопрос срочный — откройте «Поддержка» и опишите проблему,
                мы подскажем шаги.</small
              >
            </aside>
          </div>
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
