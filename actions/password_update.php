<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = require_user_from_subdir();
$old = (string)($_POST['oldPass'] ?? '');
$new = (string)($_POST['newPass'] ?? '');
$new2 = (string)($_POST['newPass2'] ?? '');
if (!password_verify($old, (string)$user['password_hash']) || strlen($new) < 6 || $new !== $new2) {
    flash_set('pass', 'Проверьте старый пароль и новый пароль от 6 символов.');
    redirect('../lk/settings.php');
}
$stmt = $pdo->prepare('UPDATE users SET password_hash = ?, updated_at = NOW() WHERE id = ?');
$stmt->execute([password_hash($new, PASSWORD_DEFAULT), (int)$user['id']]);
flash_set('pass', 'Пароль изменён.');
redirect('../lk/settings.php');
