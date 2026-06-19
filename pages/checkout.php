<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = current_user();
$quote = selected_quote();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Оплата — EU KASKO</title>

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
            <h1>Оплата</h1>
            <p class="muted">
              Оплата онлайн. После оплаты полис появится в личном кабинете.
              Валюта: ₽.
            </p>
          </div>

          <div class="grid2">
            <section class="card reveal">
              <h2 class="h3">Покупатель</h2>

              <form id="checkoutForm" class="form" method="post" action="../actions/checkout_submit.php" novalidate>
                <?= hidden_quote_id() ?>
                <div class="field">
                  <label for="buyerEmail">Email</label>
                  <input
                    id="buyerEmail"
                    name="buyerEmail"
                    type="email"
                    placeholder="you@mail.ru"
                    required
                  />
                </div>

                <div class="field">
                  <label for="buyerPhone">Телефон</label>
                  <input
                    id="buyerPhone"
                    name="buyerPhone"
                    type="tel"
                    placeholder="+7..."
                    required
                  />
                </div>

                <hr class="sep" />
                <h3 class="h4">План и скидка</h3>

                <div class="field">
                  <label for="plan">План</label>
                  <select id="plan" name="plan"><?= plan_options_html() ?></select>
                </div>

                <div class="field">
                  <label for="promo">Промокод</label>
                  <input
                    id="promo"
                    name="promo"
                    type="text"
                    placeholder="EU2026"
                  />
                  <small class="hint"
                    >Промокод может быть отключён или заменён.</small
                  >
                </div>

                <hr class="sep" />
                <h3 class="h4">Способ оплаты</h3>

                <div class="field">
                  <label for="method">Метод</label>
                  <select id="method" name="method">
                    <option value="card" selected>
                      Карта (МИР/Visa/Mastercard)
                    </option>
                    <option value="sbp">СБП</option>
                    <option value="invoice">Счёт</option>
                  </select>
                </div>

                <div id="payCard" class="stack">
                  <div class="field">
                    <label for="cardNumber">Номер карты</label>
                    <input
                      id="cardNumber"
                      name="cardNumber"
                      inputmode="numeric"
                      placeholder="2200 0000 0000 0000"
                    />
                  </div>
                  <div class="grid2 tight">
                    <div class="field">
                      <label for="cardExp">Срок</label
                      ><input id="cardExp" placeholder="MM/YY" name="cardExp">
                    </div>
                    <div class="field">
                      <label for="cardCvc">CVC</label
                      ><input
                        id="cardCvc"
                        name="cardCvc"
                        inputmode="numeric"
                        placeholder="123"
                      />
                    </div>
                  </div>
                </div>

                <div id="paySbp" class="stack" hidden>
                  <div class="note">
                    СБП: подтверждение в банке по номеру телефона.
                  </div>
                  <input
                    id="sbpInfo"
                    placeholder="Подтверждение в банке"
                    disabled
                  />
                </div>

                <div id="payInvoice" class="stack" hidden>
                  <div class="note">
                    Счёт: после подтверждения оплаты полис активируется.
                  </div>
                </div>

                <label class="check">
                  <input type="checkbox" id="agree" required name="agree" value="1" />
                  <span>Согласен(на) с условиями</span>
                </label>

                <div class="form__actions">
                  <button class="btn btn--primary" type="submit">
                    Оплатить
                  </button>
                  <a class="btn btn--ghost" href="legal.php">Документы</a>
                </div>

                <div id="checkoutMsg" class="msg" role="status" aria-live="polite"><?= flash_html('checkout') ?></div>
              </form>
            </section>

            <aside class="card card--sticky reveal">
              <div class="card__head">
                <h2 class="h3">Сводка</h2>
                <a class="link" href="quote.php">Изменить</a>
              </div>

              <div id="orderSummary" class="summary"><?= checkout_summary_html($quote) ?></div>

              <div class="price">
                <div>
                  <div class="muted">Итого/год</div>
                  <div class="price__big" id="totalYear"><?= $quote ? money(round($quote['price_year'] * plans()['plus']['factor'])) : '—' ?></div>
                </div>
                <div class="price__divider"></div>
                <div>
                  <div class="muted">В месяц</div>
                  <div class="price__mid" id="totalMonth"><?= $quote ? money(round(($quote['price_year'] * plans()['plus']['factor'])/12)) : '—' ?></div>
                </div>
              </div>
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
