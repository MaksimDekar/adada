<?php
require_once __DIR__ . '/../includes/helpers.php';
require_admin();
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Расчёты — EU KASKO</title>
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
          <div class="note u-mt12">Статусы, поиск, фильтры и выгрузка доступны прямо из панели.</div>
        </aside>
        <section class="card reveal">
          <?= flash_html('admin_msg') ?>
          <?= admin_filter_form('Расчёты', 'quotes', 'Марка, модель, VIN, водитель, email...') ?>
          
          <div id="box"><?= admin_quotes_table() ?></div>
        </section>
      </div>
    </main>
    <footer class="footer"><div class="container footer__grid"><div class="footer__meta"><span class="muted">© <span id="yearNow"></span> EU KASKO</span></div><div class="footer__links"><a href="index.php">Панель</a></div></div></footer>
    <script src="../assets/js/app.js" defer></script>
  </body>
</html>
