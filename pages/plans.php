<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Планы — EU KASKO</title>

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
            <h1>Планы</h1>
            <p class="muted">
              Выберите базовый план — он влияет на цену и набор сервисов.
              Доп.опции (угон/стёкла/дорога) включаются в калькуляторе.
            </p>
          </div>

          <div class="grid3">
            <article class="card reveal">
              <h2 class="h3">Basic</h2>
              <p class="muted">Экономный вариант для аккуратной езды</p>
              <div class="row">
                <span class="muted">Коэффициент</span><b>×0.95</b>
              </div>
              <ul class="list">
                <li>Базовые риски (ДТП/повреждения)</li>
                <li>Минимум сервисов</li>
                <li>Подходит, если важна цена</li>
              </ul>
              <button class="btn btn--primary btn--block" data-plan="basic">
                Выбрать Basic
              </button>
            </article>

            <article class="card reveal">
              <h2 class="h3">Plus</h2>
              <p class="muted">Оптимальный баланс цены и удобства</p>
              <div class="row">
                <span class="muted">Коэффициент</span><b>×1.08</b>
              </div>
              <ul class="list">
                <li>Расширенные условия по ремонту</li>
                <li>Удобнее по сервису</li>
                <li>Чаще всего выбирают</li>
              </ul>
              <button class="btn btn--primary btn--block" data-plan="plus">
                Выбрать Plus
              </button>
            </article>

            <article class="card reveal">
              <h2 class="h3">Max</h2>
              <p class="muted">Максимум покрытия и сервисов</p>
              <div class="row">
                <span class="muted">Коэффициент</span><b>×1.18</b>
              </div>
              <ul class="list">
                <li>Максимальные лимиты и сервис</li>
                <li>Лучше для дорогих авто</li>
                <li>Рекомендуется при частых поездках</li>
              </ul>
              <button class="btn btn--primary btn--block" data-plan="max">
                Выбрать Max
              </button>
            </article>
          </div>

          <div class="grid2 u-mt18">
            <section class="card reveal">
              <h2 class="h3">Сравнение по смыслу</h2>
              <div class="breakdown">
                <div class="row">
                  <span class="muted">ДТП / повреждения</span><b>везде</b>
                </div>
                <div class="row">
                  <span class="muted">Сервис и сопровождение</span
                  ><b>Basic → Max</b>
                </div>
                <div class="row">
                  <span class="muted">Подходит для дорогих авто</span
                  ><b>Plus / Max</b>
                </div>
                <div class="row">
                  <span class="muted"
                    >Если хотите «максимально закрыть риски»</span
                  ><b>Max</b>
                </div>
              </div>
              <div class="note">
                Набор рисков и исключения зависят от условий. Подробности — на
                странице «Покрытие».
              </div>
              <a class="btn btn--ghost" href="about.php">Покрытие</a>
            </section>

            <section class="card reveal">
              <h2 class="h3">Доп.опции в калькуляторе</h2>
              <ul class="list">
                <li>
                  <b>Угон / тотал</b> — добавляет защиту от самых «дорогих»
                  событий
                </li>
                <li><b>Стёкла</b> — полезно для трассы и города</li>
                <li>
                  <b>Помощь на дороге 24/7</b> — если часто ездите/путешествуете
                </li>
                <li><b>Франшиза</b> — снижает цену полиса</li>
              </ul>
              <div class="card__foot">
                <a class="btn btn--primary btn--block" href="quote.php"
                  >Открыть калькулятор</a
                >
                <a
                  class="btn btn--ghost btn--block"
                  href="guides.php#deductible"
                  >Как выбрать франшизу</a
                >
              </div>
            </section>
          </div>

          <div class="banner reveal">
            <div>
              <h3 class="u-mb6">Дальше — расчёт</h3>
              <p class="muted u-m0">
                После выбора плана сделайте расчёт и при необходимости включите
                опции.
              </p>
            </div>
            <a class="btn btn--primary" href="quote.php">Рассчитать</a>
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
