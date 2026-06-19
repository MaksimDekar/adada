<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Покрытие — EU KASKO</title>

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
            <h1>Покрытие</h1>
            <p class="muted">
              Понятное описание, что обычно входит в КАСКО, какие бывают опции и
              как проходит обращение.
            </p>
          </div>

          <div class="media-slot reveal" data-site-img="about">
            <div class="media-slot__ph">
              Защита автомобиля и спокойствие в дороге
            </div>
          </div>

          <div class="grid2 u-mt18">
            <section class="card reveal">
              <h2 class="h3">Что обычно покрывается</h2>
              <ul class="list">
                <li>
                  <b>ДТП</b> — столкновения, наезды, опрокидывания (по условиям
                  полиса).
                </li>
                <li>
                  <b>Повреждения</b> — на парковке, падение предметов, провалы
                  дорожного полотна (по условиям).
                </li>
                <li>
                  <b>Стихийные явления</b> — град, ветер, паводок и т.п. (при
                  наличии события и подтверждений).
                </li>
                <li>
                  <b>Противоправные действия</b> — вандализм/повреждение
                  третьими лицами (по условиям).
                </li>
              </ul>
              <div class="note">
                Важно: точный перечень рисков и исключений фиксируется в
                условиях и приложениях к полису.
              </div>
            </section>

            <section class="card reveal">
              <h2 class="h3">Опции (подключаются в калькуляторе)</h2>
              <ul class="list">
                <li>
                  <b>Угон / тотал</b> — защита при угоне или полной гибели авто.
                </li>
                <li>
                  <b>Стёкла</b> — ремонт/замена лобового, боковых стёкол и
                  оптики (по условиям).
                </li>
                <li>
                  <b>Помощь на дороге 24/7</b> — эвакуация, запуск АКБ, подвоз
                  топлива, замена колеса.
                </li>
                <li>
                  <b>Франшиза</b> — снижает стоимость полиса, но часть расходов
                  берёте на себя.
                </li>
              </ul>
              <div class="card__foot">
                <a class="btn btn--primary btn--block" href="quote.php"
                  >Рассчитать с опциями</a
                >
                <a
                  class="btn btn--ghost btn--block"
                  href="guides.php#deductible"
                  >Как выбрать франшизу</a
                >
              </div>
            </section>
          </div>

          <div class="grid2 u-mt18">
            <section class="card reveal">
              <h2 class="h3">Как проходит обращение</h2>
              <ol class="list">
                <li>
                  Фиксируете событие: фото, документы (при необходимости).
                </li>
                <li>Подаёте заявку в ЛК: «Случаи» → создать.</li>
                <li>
                  Получаете статус и инструкции: что и куда загрузить, куда
                  ехать на осмотр/ремонт.
                </li>
                <li>
                  Ремонт/выплата — по выбранному варианту и условиям договора.
                </li>
              </ol>
              <div class="mini">
                Быстро задать вопрос можно через «Поддержка» (кнопка сверху).
                Можно прикрепить скрин/фото.
              </div>
            </section>

            <section class="card reveal">
              <h2 class="h3">Что обычно не покрывается</h2>
              <ul class="list">
                <li>Естественный износ и расходники.</li>
                <li>
                  Повреждения при нарушении правил эксплуатации (по условиям).
                </li>
                <li>
                  События без подтверждений, если подтверждения требуются по
                  условиям.
                </li>
                <li>Умышленные действия страхователя.</li>
              </ul>
              <div class="note">
                Это общие примеры. Смотрите раздел «Документы» — там кратко
                описаны условия.
              </div>
              <a class="btn btn--ghost" href="legal.php">Открыть документы</a>
            </section>
          </div>

          <div class="banner reveal">
            <div>
              <h3 class="u-mb6">Хотите сравнить планы?</h3>
              <p class="muted u-m0">
                Планы отличаются коэффициентом цены и набором сервисов.
              </p>
            </div>
            <div class="inline">
              <a class="btn btn--ghost" href="plans.php">Планы</a>
              <a class="btn btn--primary" href="quote.php">Рассчитать</a>
            </div>
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
