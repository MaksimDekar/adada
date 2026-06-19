<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = require_user_from_subdir();
$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
if ($name === '') {
    flash_set('profile', 'Введите имя.');
    redirect('../lk/profile.php');
}
$stmt = $pdo->prepare('UPDATE users SET name = ?, phone = ?, updated_at = NOW() WHERE id = ?');
$stmt->execute([$name, $phone, (int)$user['id']]);
flash_set('profile', 'Профиль сохранён.');
redirect('../lk/profile.php');
