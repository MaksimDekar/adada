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
    <title>Калькулятор — EU KASKO</title>

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
            <h1>Калькулятор КАСКО</h1>
            <p class="muted">
              Только европейские бренды и годы <strong>2016–2025</strong>.
              Валюта: ₽.
            </p>
          </div>

          <div class="grid2">
            <section class="card reveal">
              <h2 class="h3">Данные авто</h2>
              <form id="quoteForm" class="form" method="post" action="../actions/quote_submit.php" enctype="multipart/form-data" novalidate>
                <div class="field">
                  <label for="year">Год выпуска</label>
                  <select id="year" name="year" required></select>
                </div>

                <div class="field">
                  <label for="brand">Марка (EU)</label>
                  <select id="brand" name="brand" required></select>
                </div>

                <div class="field">
                  <label for="model">Модель</label>
                  <select id="model" name="model" required disabled></select>
                </div>

                <hr class="sep" />
                <h3 class="h4">Документы и данные для полиса</h3>

                <div class="field">
                  <label for="vin">VIN</label>
                  <input
                    id="vin"
                    name="vin"
                    type="text"
                    placeholder="17 символов"
                    maxlength="17"
                    autocomplete="off"
                    required
                  />
                  <small class="hint"
                    >Нужен для оформления. Можно ввести без пробелов.</small
                  >
                </div>

                <div class="field">
                  <label for="plate">Госномер</label>
                  <input
                    id="plate"
                    name="plate"
                    type="text"
                    placeholder="A123BC77"
                    maxlength="12"
                    autocomplete="off"
                  />
                </div>

                <div class="field">
                  <label for="docCar">Фото СТС/ПТС (необязательно)</label>
                  <input
                    id="docCar"
                    name="docCar"
                    type="file"
                    accept="image/*"
                  />
                  <small class="hint" id="docCarHint"></small>
                </div>

                <div class="field">
                  <label for="value">Оценочная стоимость авто (₽)</label>
                  <input
                    id="value"
                    name="value"
                    type="number"
                    inputmode="numeric"
                    min="200000"
                    max="20000000"
                    step="10000"
                    placeholder="например, 1900000"
                    required
                  />
                </div>

                <div class="field">
                  <label for="exp">Стаж водителя (лет)</label>
                  <input
                    id="exp"
                    name="exp"
                    type="range"
                    min="0"
                    max="30"
                    value="5"
                  />
                  <div class="range">
                    <span>0</span><strong id="expLabel">5</strong
                    ><span>30</span>
                  </div>
                </div>

                <div class="field">
                  <label for="driverName">ФИО водителя</label>
                  <input
                    id="driverName"
                    name="driverName"
                    type="text"
                    placeholder="Иванов Иван Иванович"
                    autocomplete="name"
                    required
                  />
                </div>

                <div class="field">
                  <label for="driverBirth">Дата рождения</label>
                  <input
                    id="driverBirth"
                    name="driverBirth"
                    type="date"
                    required
                  />
                </div>

                <div class="field">
                  <label for="driverLicense">Водительское удостоверение</label>
                  <input
                    id="driverLicense"
                    name="driverLicense"
                    type="text"
                    placeholder="Серия и номер"
                    autocomplete="off"
                    required
                  />
                </div>

                <div class="field">
                  <label for="docDriver">Фото ВУ (необязательно)</label>
                  <input
                    id="docDriver"
                    name="docDriver"
                    type="file"
                    accept="image/*"
                  />
                  <small class="hint" id="docDriverHint"></small>
                </div>

                <hr class="sep" />
                <h3 class="h4">Настройки</h3>

                <div class="field">
                  <label for="deductible">Франшиза</label>
                  <select id="deductible" name="deductible">
                    <option value="0">0 ₽ (без франшизы)</option>
                    <option value="15000" selected>15 000 ₽</option>
                    <option value="30000">30 000 ₽</option>
                    <option value="60000">60 000 ₽</option>
                  </select>
                </div>

                <div class="field">
                  <label class="check"
                    ><input type="checkbox" id="optTheft" name="opt_theft" value="1" /><span
                      >Угон / тотал</span
                    ></label
                  >
                  <label class="check"
                    ><input type="checkbox" id="optGlass" name="opt_glass" value="1" /><span
                      >Стёкла</span
                    ></label
                  >
                  <label class="check"
                    ><input type="checkbox" id="optRoad" name="opt_road" value="1" /><span
                      >Помощь на дороге 24/7</span
                    ></label
                  >
                </div>

                <div class="form__actions">
                  <button class="btn btn--primary" type="submit">
                    Посчитать
                  </button>
                </div>

                <div id="formMsg" class="msg" role="status" aria-live="polite"><?= flash_html('quote') ?></div>
              </form>
            </section>

            <aside class="card card--sticky reveal">
              <div class="card__head">
                <h2 class="h3">Результат</h2>
                <span class="pill" id="eligibility"><?= $quote ? 'Расчёт сохранён' : 'Проверка…' ?></span>
              </div>

              <div class="price">
                <div>
                  <div class="muted">Годовая цена</div>
                  <div class="price__big" id="priceYear"><?= $quote ? money($quote['price_year']) : '—' ?></div>
                </div>
                <div class="price__divider"></div>
                <div>
                  <div class="muted">В месяц</div>
                  <div class="price__mid" id="priceMonth"><?= $quote ? money($quote['price_month']) : '—' ?></div>
                </div>
              </div>

              <div class="breakdown" id="breakdown"><?= quote_summary_html($quote) ?></div>

              <div class="stack">
                <button
                  class="btn btn--ghost btn--block"
                  id="saveQuote"
                  type="button"
                  <?= $quote ? '' : 'disabled' ?>
                >
                  Сохранить расчёт
                </button>
                <button
                  class="btn btn--primary btn--block"
                  id="goCheckout"
                  type="button"
                  <?= $quote ? 'data-quote-id="'.(int)$quote['id'] . '"' : 'disabled' ?>
                >
                  Перейти к оплате
                </button>
                <a class="btn btn--ghost btn--block" href="plans.php"
                  >Выбрать план</a
                >
              </div>

              <small class="muted"
                >Расчёт предварительный. Итоговая стоимость зависит от условий,
                региона и истории страхования.</small
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
