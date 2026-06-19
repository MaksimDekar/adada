<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Полезное — EU KASKO</title>

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
          <a class="btn btn--primary" href="quote.php">Рассчитать</a>
        </div>
      </div>
    </header>

    <main id="content">
      <section class="section">
        <div class="container">
          <div class="page-head reveal">
            <h1>Полезные материалы</h1>
            <p class="muted">
              Короткие понятные подсказки: как выбрать условия и что делать при
              страховом случае.
            </p>
          </div>

          <div class="grid2">
            <aside class="card card--sticky reveal">
              <h2 class="h3">Навигация</h2>
              <div class="stack">
                <a class="btn btn--ghost btn--block" href="#deductible"
                  >Франшиза</a
                >
                <a class="btn btn--ghost btn--block" href="#price">Цена</a>
                <a class="btn btn--ghost btn--block" href="#accident">ДТП</a>
                <a class="btn btn--ghost btn--block" href="#claim">Заявка</a>
              </div>
              <div class="note">
                Если не хочется разбираться — откройте «Поддержка» вверху и
                задайте вопрос.
              </div>
            </aside>

            <div class="stack">
              <article class="card reveal" id="deductible">
                <h2 class="h3">Как выбрать франшизу</h2>
                <p class="muted">
                  Франшиза — это часть расходов при ремонте, которую вы
                  оплачиваете сами. Взамен страховая снижает стоимость полиса.
                </p>
                <ul class="list">
                  <li>
                    <b>Низкая франшиза</b> (0–15 тыс.) — комфортно, но цена
                    полиса выше.
                  </li>
                  <li><b>Средняя</b> (30 тыс.) — часто оптимальный баланс.</li>
                  <li>
                    <b>Высокая</b> (60 тыс.) — выгодно, если ездите аккуратно и
                    готовы покрыть мелкие повреждения.
                  </li>
                </ul>
                <div class="note">
                  Совет: если сомневаетесь — начните с 15–30 тыс. и посмотрите
                  разницу в калькуляторе.
                </div>
                <a class="link" href="quote.php">Проверить в калькуляторе →</a>
              </article>

              <article class="card reveal" id="price">
                <h2 class="h3">Что влияет на цену</h2>
                <p class="muted">
                  Цена — это комбинация базовой ставки и коэффициентов. В
                  калькуляторе вы видите разбивку.
                </p>
                <ul class="list">
                  <li>
                    <b>Стоимость авто</b> — главный фактор: чем дороже, тем выше
                    риск расходов.
                  </li>
                  <li><b>Стаж</b> — меньше стаж → выше коэффициент риска.</li>
                  <li><b>Опции</b> — угон/тотал, стёкла, помощь на дороге.</li>
                  <li><b>План</b> — умножает базовую цену (Basic/Plus/Max).</li>
                  <li>
                    <b>Франшиза</b> — снижает цену, но увеличивает вашу долю при
                    событии.
                  </li>
                </ul>
                <div class="mini">
                  Чтобы быстро подобрать вариант: включайте/выключайте опции и
                  смотрите итог и «в месяц».
                </div>
              </article>

              <article class="card reveal" id="accident">
                <h2 class="h3">Что делать при ДТП</h2>
                <ol class="list">
                  <li>
                    Остановитесь, включите аварийку, поставьте знак, убедитесь в
                    безопасности людей.
                  </li>
                  <li>
                    Сфотографируйте место, повреждения, номера, разметку, знаки,
                    общий план.
                  </li>
                  <li>
                    Оформите документы (европротокол/ГИБДД — по ситуации).
                  </li>
                  <li>
                    Сохраните контакты участников и свидетелей (если есть).
                  </li>
                  <li>
                    Подайте обращение через личный кабинет: «Случаи» → создать
                    заявку.
                  </li>
                </ol>
                <div class="note">
                  Важно: не начинайте ремонт до фиксации и регистрации
                  обращения.
                </div>
              </article>

              <article class="card reveal" id="claim">
                <h2 class="h3">Как подать заявку</h2>
                <p class="muted">
                  В личном кабинете можно создать обращение и следить за
                  статусом.
                </p>
                <ol class="list">
                  <li>Зайдите в ЛК → «Случаи».</li>
                  <li>Выберите полис, тип события, дату, добавьте описание.</li>
                  <li>
                    Если нужно — приложите фото через «Поддержка» (кнопка
                    сверху).
                  </li>
                </ol>
                <div class="card__foot">
                  <a class="btn btn--primary btn--block" href="../lk/index.php"
                    >Открыть личный кабинет</a
                  >
                  <a class="btn btn--ghost btn--block" href="faq.php"
                    >Посмотреть FAQ</a
                  >
                </div>
              </article>
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
            Оформление и поддержка онлайн. Документы и статусы — в личном
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
