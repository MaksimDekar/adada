<?php
require_once __DIR__ . '/../includes/helpers.php';
if (empty($_SESSION['admin_logged'])) redirect('../admin/login.php');
$id = (int)($_POST['id'] ?? 0);
$status = (string)($_POST['status'] ?? 'active');
$note = trim((string)($_POST['note'] ?? ''));
if ($id) {
    $stmt = $pdo->prepare('UPDATE users SET status=?, admin_note=?, updated_at=NOW() WHERE id=?');
    $stmt->execute([$status, $note, $id]);
    flash_set('admin_users', 'Пользователь обновлён.');
}
redirect('../admin/users.php');
