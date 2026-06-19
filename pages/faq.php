<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FAQ — EU KASKO</title>

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
            <h1>FAQ</h1>
            <p class="muted">Частые вопросы — коротко и по делу.</p>
          </div>

          <section class="card reveal">
            <div class="faq" id="faq">
              <button class="faq__q" aria-expanded="false">
                Какие авто подходят?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                В калькуляторе доступны европейские бренды и годы выпуска
                2016–2025. Это ограничение продукта.
              </div>

              <button class="faq__q" aria-expanded="false">
                Как считается цена?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Цена зависит от стоимости авто, стажа, выбранного плана и опций
                (угон/стёкла/дорога), а также франшизы. В калькуляторе показана
                разбивка.
              </div>

              <button class="faq__q" aria-expanded="false">
                Можно ли сохранить расчёт?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Да. После расчёта нажмите «Сохранить расчёт». Он будет доступен
                на главной и в процессе оформления.
              </div>

              <button class="faq__q" aria-expanded="false">
                Где хранятся данные?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Расчёты, полисы и заявки доступны в личном кабинете после входа.
              </div>

              <button class="faq__q" aria-expanded="false">
                Как получить полис?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Сделайте расчёт → перейдите к оплате → после оформления полис
                появится в личном кабинете в разделе «Полисы».
              </div>

              <button class="faq__q" aria-expanded="false">
                Что делать при страховом случае?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Зафиксируйте событие (фото/документы) и создайте заявку в ЛК:
                «Случаи» → создать. Подробный чек‑лист есть в разделе
                «Полезное».
              </div>

              <button class="faq__q" aria-expanded="false">
                Что такое франшиза?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Франшиза — сумма, которую вы оплачиваете при ремонте сами. Чем
                выше франшиза, тем обычно ниже цена полиса.
              </div>

              <button class="faq__q" aria-expanded="false">
                Как связаться с поддержкой?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                Нажмите кнопку «Поддержка» вверху сайта. Откроется форма — можно
                прикрепить скрин/фото.
              </div>

              <button class="faq__q" aria-expanded="false">
                Зачем нужен личный кабинет?<span class="faq__icon">+</span>
              </button>
              <div class="faq__a" hidden>
                В ЛК хранятся ваши полисы и обращения. Там же можно обновить
                профиль и изменить пароль.
              </div>
            </div>

            <hr class="sep" />
            <div class="inline">
              <a class="btn btn--ghost" href="guides.php">Полезное</a>
              <a class="btn btn--ghost" href="legal.php">Документы</a>
              <a class="btn btn--primary" href="quote.php">Рассчитать</a>
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
