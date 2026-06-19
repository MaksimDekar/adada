<?php
require_once __DIR__ . '/../includes/helpers.php';
if (empty($_SESSION['admin_logged'])) redirect('../admin/login.php');
if (!is_post()) redirect('../admin/index.php');
$entity = (string)($_POST['entity'] ?? '');
$id = (int)($_POST['id'] ?? 0);
try {
    $config = admin_entity_config($entity);
    if ($id > 0) {
        $table = $config['table'];
        $stmt = $pdo->prepare('DELETE FROM `'.$table.'` WHERE id = ?');
        $stmt->execute([$id]);
        flash_set('admin_msg', 'Запись удалена.');
    }
} catch (Throwable $e) {
    flash_set('admin_msg', 'Удалить не получилось: запись может быть связана с другими данными.');
}
redirect($_SERVER['HTTP_REFERER'] ?? '../admin/index.php');
