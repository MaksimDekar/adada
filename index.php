<?php
require_once __DIR__ . '/includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EU KASKO — КАСКО для европейских авто (RU)</title>

    <link rel="stylesheet" href="assets/css/styles.css" />
</head>
  <body>
    <a class="skip" href="#content">Перейти к содержимому</a>
    <header class="header">
      <div class="container header__inner">
        <a class="brand" href="index.php">
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
            <li><a class="nav__link" href="index.php">Главная</a></li>
            <li><a class="nav__link" href="pages/quote.php">Рассчитать</a></li>
            <li><a class="nav__link" href="pages/plans.php">Планы</a></li>
            <li><a class="nav__link" href="pages/about.php">Покрытие</a></li>
            <li><a class="nav__link" href="pages/guides.php">Полезное</a></li>
            <li><a class="nav__link" href="pages/faq.php">FAQ</a></li>
            <li><a class="nav__link" href="pages/contact.php">Контакты</a></li>
            <li><a class="nav__link" href="pages/legal.php">Документы</a></li>
          </ul>
        </nav>

        <div class="header__actions">
          <a
            class="btn btn--ghost"
            data-auth-link
            data-auth-login="lk/login.php"
            data-auth-lk="lk/index.php"
            href="lk/login.php"
            >Войти</a
          >
          <button class="btn btn--ghost" data-theme-toggle type="button">
            <span class="icon">◐</span><span class="hide-sm">Тема</span>
          </button>
          <a class="btn btn--primary" href="pages/quote.php">Рассчитать</a>
        </div>
      </div>
    </header>
    <main id="content">
      <section class="hero">
        <div class="container hero__grid">
          <div class="hero__content reveal">
            <div class="chip">Европейские авто • 2016–2025 • ₽</div>
            <h1>Онлайн‑КАСКО для европейских авто</h1>
            <p class="lead">
              Рассчитайте стоимость, выберите план, оплатите — и полис появится
              в личном кабинете. Без лишних экранов: всё по шагам.
            </p>

            <ul class="list u-m14-0-0">
              <li>
                <b>Планы:</b> Basic / Plus / Max — отличаются набором рисков и
                сервисом.
              </li>
              <li>
                <b>Опции:</b> угон/тотал, стёкла, помощь на дороге, франшиза.
              </li>
              <li>
                <b>Документы:</b> условия и памятки — в разделе «Документы» и в
                ЛК.
              </li>
            </ul>

            <div class="hero__cta">
              <a class="btn btn--primary" href="pages/quote.php">Рассчитать</a>
              <a class="btn btn--ghost" href="pages/plans.php">Планы</a>
              <a class="btn btn--ghost" href="pages/about.php">Покрытие</a>
            </div>

            <div class="hero__note">
              <span class="dot"></span
              ><span
                >Поддержка через кнопку «Поддержка» вверху • Можно прикрепить
                скрин</span
              >
            </div>
          </div>

          <div class="hero__card reveal">
            <div class="stack">
              <div class="card card--glass">
                <div class="card__head">
                  <h3>Последний расчёт</h3>
                  <a class="link" href="pages/quote.php">Открыть</a>
                </div>
                <div id="lastQuote" class="last-quote">
                  <div class="skeleton"></div>
                  <div class="skeleton"></div>
                  <div class="skeleton"></div>
                </div>
                <div class="card__foot">
                  <a
                    class="btn btn--primary btn--block"
                    href="pages/checkout.php"
                    >К оплате</a
                  >
                  <a class="btn btn--ghost btn--block" href="lk/index.php"
                    >Личный кабинет</a
                  >
                  <small class="muted"
                    >Полис появится в ЛК после оформления.</small
                  >
                </div>
                <div class="media-slot" data-site-img="hero">
                  <div class="media-slot__ph">
                    Быстрое оформление полиса онлайн
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="hero__bg" aria-hidden="true"></div>
      </section>

      <section class="section">
        <div class="container">
          <div class="section__head reveal">
            <h2>Как это работает</h2>
            <p class="muted">
              Нормальный понятный процесс: план → расчёт → оплата → документы.
            </p>
          </div>

          <div class="grid3">
            <article class="card reveal">
              <h3 class="h3">1) Выберите план</h3>
              <p class="muted">
                Basic — экономно, Plus — баланс, Max — максимум покрытия и
                сервисов.
              </p>
              <a class="link" href="pages/plans.php">Сравнить планы →</a>
            </article>
            <article class="card reveal">
              <h3 class="h3">2) Рассчитайте</h3>
              <p class="muted">
                Введите год/марку/модель, стоимость, стаж и опции. Сразу видно
                разбивку цены.
              </p>
              <a class="link" href="pages/quote.php">Открыть калькулятор →</a>
            </article>
            <article class="card reveal">
              <h3 class="h3">3) Оформите</h3>
              <p class="muted">
                Оплата картой/СБП/по счёту. После оформления данные появятся в
                личном кабинете.
              </p>
              <a class="link" href="pages/checkout.php">Перейти к оплате →</a>
            </article>
          </div>

          <div class="banner reveal">
            <div>
              <h3 class="u-mb6">Нужна помощь?</h3>
              <p class="muted u-m0">
                Нажмите «Поддержка» вверху — откроется форма, можно прикрепить
                картинку.
              </p>
            </div>
            <div class="inline">
              <button class="btn btn--ghost" type="button" data-support-open>
                Поддержка
              </button>
              <a class="btn btn--primary" href="pages/quote.php"
                >Сделать расчёт</a
              >
            </div>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="section__head reveal">
            <h2>Покрытие и опции</h2>
            <p class="muted">
              Коротко — что обычно входит в КАСКО и какие доп.опции можно
              включить.
            </p>
          </div>

          <div class="grid2">
            <section class="card reveal">
              <h3 class="h3">Типовые риски</h3>
              <ul class="list">
                <li>ДТП (по вашей вине и по вине третьих лиц)</li>
                <li>Повреждения на парковке, падение предметов</li>
                <li>Стихийные явления (град/ветер/паводок — по условиям)</li>
                <li>
                  Противоправные действия третьих лиц (вандализм — по условиям)
                </li>
              </ul>
              <div class="note">
                Полный список рисков и исключений — на странице «Покрытие» и в
                «Документах».
              </div>
              <a class="btn btn--ghost" href="pages/about.php"
                >Открыть страницу покрытия</a
              >
            </section>

            <section class="card reveal">
              <h3 class="h3">Опции</h3>
              <ul class="list">
                <li>
                  <b>Угон/тотал</b> — защита при угоне или полной гибели авто
                </li>
                <li><b>Стёкла</b> — ремонт/замена стекла и оптики</li>
                <li>
                  <b>Помощь на дороге 24/7</b> — эвакуация, запуск АКБ, подвоз
                  топлива
                </li>
                <li>
                  <b>Франшиза</b> — снижает цену, часть расходов берёте на себя
                </li>
              </ul>
              <div class="card__foot">
                <a class="btn btn--primary btn--block" href="pages/plans.php"
                  >Сравнить планы</a
                >
                <a class="btn btn--ghost btn--block" href="pages/guides.php"
                  >Полезные материалы</a
                >
              </div>
            </section>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="section__head reveal">
            <h2>Полезное</h2>
            <p class="muted">
              Небольшие заметки, чтобы быстро разобраться в условиях и не
              потеряться при страховом случае.
            </p>
          </div>

          <div class="grid3">
            <article class="card reveal">
              <h3 class="h3">Как выбрать франшизу</h3>
              <p class="muted">
                Когда выгодно брать франшизу и какую сумму выбрать, чтобы не
                переплатить.
              </p>
              <a class="link" href="pages/guides.php#deductible">Читать →</a>
            </article>
            <article class="card reveal">
              <h3 class="h3">Что делать при ДТП</h3>
              <p class="muted">
                Порядок действий: безопасность, фиксация, документы, обращение в
                страховую.
              </p>
              <a class="link" href="pages/guides.php#accident">Читать →</a>
            </article>
            <article class="card reveal">
              <h3 class="h3">Что влияет на цену</h3>
              <p class="muted">
                Год, стоимость авто, стаж, опции, франшиза — и как это
                отражается в расчёте.
              </p>
              <a class="link" href="pages/guides.php#price">Читать →</a>
            </article>
          </div>

          <div class="banner reveal">
            <div>
              <h3 class="u-mb6">Ещё вопросы?</h3>
              <p class="muted u-m0">
                Мы собрали расширенный FAQ и краткие документы.
              </p>
            </div>
            <div class="inline">
              <a class="btn btn--ghost" href="pages/faq.php">Открыть FAQ</a>
              <a class="btn btn--ghost" href="pages/legal.php">Документы</a>
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
          <a href="pages/quote.php">Калькулятор</a>
          <a href="pages/plans.php">Планы</a>
          <a href="pages/about.php">Покрытие</a>
          <a href="pages/guides.php">Полезное</a>
          <a href="pages/contact.php">Контакты</a>
          <a href="lk/index.php">Личный кабинет</a>
        </div>
        <div class="footer__meta">
          <span class="muted">© <span id="yearNow"></span> EU KASKO</span>
        </div>
      </div>
    </footer>

    <script src="assets/js/app.js" defer></script>
  </body>
</html>
