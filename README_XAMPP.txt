EU KASKO — версия для XAMPP / PHP / MySQL

1) Удалите старую папку проекта:
   C:\xampp\htdocs\diplom_xampp

2) Скопируйте папку diplom_xampp из этого архива в:
   C:\xampp\htdocs\

3) В XAMPP запустите Apache и MySQL.

4) Откройте сайт:
   http://localhost/diplom_xampp/

5) База данных eukasko создаётся автоматически.
   Если нужно вручную: импортируйте database.sql через phpMyAdmin.

6) Админка:
   http://localhost/diplom_xampp/admin/login.php
   Логин: admin
   Пароль: 123123

В этой версии исходная вёрстка и CSS сохранены. Удалено браузерное хранение данных.
Данные сохраняются в MySQL: users, quotes, policies, receipts, claims, responses.
В админке есть страницы: пользователи, полисы, случаи, отклики, чеки.
