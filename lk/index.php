<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = require_user_from_subdir();
?>
<?php
$lkPolicies = lk_policies($user);
$lkClaims = lk_claims($user);
$lkSum = array_sum(array_map(fn($p) => (float)$p['total_year'], $lkPolicies));
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Обзор — ЛК</title>

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
              <h1 class="u-mb6">Обзор</h1>
              <p class="muted u-m0">Сводка по вашим данным.</p>
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

          <div id="lkDashboard">
            <div class="grid3">
              <div class="card">
                <h2 class="h3">Полисы</h2>
                <div class="price__big" id="kpiPolicies"><?= count($lkPolicies) ?></div>
                <small class="muted">всего</small>
              </div>
              <div class="card">
                <h2 class="h3">Заявки</h2>
                <div class="price__big" id="kpiClaims"><?= count($lkClaims) ?></div>
                <small class="muted">всего</small>
              </div>
              <div class="card">
                <h2 class="h3">Сумма/год</h2>
                <div class="price__big" id="kpiSum"><?= money($lkSum) ?></div>
                <small class="muted">по полисам</small>
              </div>
            </div>
            <hr class="sep" />
            <h2 class="h3">Последние полисы</h2>
            <div id="lastPolicies" class="breakdown"><?= lk_last_policies_html($user) ?></div>
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
