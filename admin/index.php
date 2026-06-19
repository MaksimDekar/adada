<?php
require_once __DIR__ . '/../includes/helpers.php';
require_admin();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Панель управления — EU KASKO</title>
    <link rel="stylesheet" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
  </head>
  <body>
    <a class="skip" href="#content">Перейти к содержимому</a>
    <header class="header">
      <div class="container header__inner">
        <a class="brand" href="index.php"><span class="brand__logo">EU</span><span class="brand__text"><strong>EU KASKO</strong><small>Панель управления</small></span></a>
        <div class="header__actions">
          <button class="btn btn--ghost" data-theme-toggle type="button"><span class="icon">◐</span><span class="hide-sm">Тема</span></button>
          <a class="btn btn--ghost" href="logout.php">Выйти</a>
          <a class="btn btn--primary" href="../index.php">На сайт</a>
        </div>
      </div>
    </header>
    <main id="content" class="section">
      <div class="container admin">
        <aside class="admin__side reveal">
          <div class="admin__title">Навигация</div>
          <nav class="admin__nav"><?= admin_layout_nav() ?></nav>
          <div class="note u-mt12">Обрабатывайте заявки, меняйте статусы и выгружайте таблицы в CSV.</div>
        </aside>
        <section class="card reveal">
          <?= flash_html('admin_msg') ?>
          <h1 class="u-mb8">Панель управления</h1>
          <p class="muted">Сводка по пользователям, расчётам, откликам, оплатам и страховым случаям.</p>
          <div class="grid3 u-mt12">
            <div class="card"><h2 class="h3">Пользователи</h2><div class="price__big"><?= admin_count('users') ?></div><small class="muted">зарегистрировано</small></div>
            <div class="card"><h2 class="h3">Новые отклики</h2><div class="price__big"><?= admin_count_where('responses', "status='new'") ?></div><small class="muted">требуют просмотра</small></div>
            <div class="card"><h2 class="h3">Расчёты</h2><div class="price__big"><?= admin_count('quotes') ?></div><small class="muted">в базе</small></div>
            <div class="card"><h2 class="h3">Полисы</h2><div class="price__big"><?= admin_count('policies') ?></div><small class="muted">оформлено</small></div>
            <div class="card"><h2 class="h3">Чеки</h2><div class="price__big"><?= admin_count('receipts') ?></div><small class="muted">оплат</small></div>
            <div class="card"><h2 class="h3">Случаи</h2><div class="price__big"><?= admin_count('claims') ?></div><small class="muted">заявок</small></div>
          </div>
          <div class="banner u-mt14">
            <div><h3>Быстрые действия</h3><p class="muted">Перейти к обработке обращений, оплат или полисов.</p></div>
            <div class="inline"><a class="btn btn--primary" href="responses.php">Отклики</a><a class="btn btn--ghost" href="receipts.php">Чеки</a><a class="btn btn--ghost" href="claims.php">Случаи</a><a class="btn btn--ghost" href="quotes.php">Расчёты</a></div>
          </div>
          <hr class="sep" />
          <div class="grid2">
            <div class="card"><h3 class="h4">Последние отклики</h3><div class="breakdown"><?= admin_recent_responses() ?></div></div>
            <div class="card"><h3 class="h4">Последние чеки</h3><div class="breakdown"><?= admin_receipts_table() ?></div></div>
          </div>
        </section>
      </div>
    </main>
    <footer class="footer"><div class="container footer__grid"><div class="footer__meta"><span class="muted">© <span id="yearNow"></span> EU KASKO</span></div><div class="footer__links"><a href="settings.php">Настройки</a></div></div></footer>
    <script src="../assets/js/app.js" defer></script>
  </body>
</html>
