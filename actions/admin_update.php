<?php
require_once __DIR__ . '/../includes/helpers.php';
if (empty($_SESSION['admin_logged'])) redirect('../admin/login.php');
if (!is_post()) redirect('../admin/index.php');
$entity = (string)($_POST['entity'] ?? '');
$id = (int)($_POST['id'] ?? 0);
$status = trim((string)($_POST['status'] ?? ''));
$note = trim((string)($_POST['note'] ?? ''));
try {
    $config = admin_entity_config($entity);
    $allowed = admin_statuses($entity);
    if ($id <= 0 || !isset($allowed[$status])) {
        flash_set('admin_msg', 'Проверьте статус и номер записи.');
        redirect($_SERVER['HTTP_REFERER'] ?? '../admin/index.php');
    }
    $table = $config['table'];
    $cols = [];
    $values = [];
    if (column_exists($pdo, $table, 'status')) { $cols[] = 'status = ?'; $values[] = $status; }
    if (column_exists($pdo, $table, 'admin_note')) { $cols[] = 'admin_note = ?'; $values[] = $note; }
    if (column_exists($pdo, $table, 'updated_at')) { $cols[] = 'updated_at = NOW()'; }
    if ($cols) {
        $values[] = $id;
        $stmt = $pdo->prepare('UPDATE `'.$table.'` SET '.implode(', ', $cols).' WHERE id = ?');
        $stmt->execute($values);
        flash_set('admin_msg', 'Запись обновлена.');
    }
} catch (Throwable $e) {
    flash_set('admin_msg', 'Не удалось обновить запись.');
}
redirect($_SERVER['HTTP_REFERER'] ?? '../admin/index.php');
