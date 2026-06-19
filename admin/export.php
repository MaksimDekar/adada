<?php
require_once __DIR__ . '/../includes/helpers.php';
require_admin();
$type = (string)($_GET['type'] ?? 'responses');
try {
    $config = admin_entity_config($type);
} catch (Throwable $e) {
    http_response_code(404);
    exit('Unknown export type');
}
$table = $config['table'];
$columns = $config['columns'];
$params = [];
$where = [];
$status = trim((string)($_GET['status'] ?? ''));
$q = trim((string)($_GET['q'] ?? ''));
$dateFrom = trim((string)($_GET['date_from'] ?? ''));
$dateTo = trim((string)($_GET['date_to'] ?? ''));
if ($status !== '' && column_exists($pdo, $table, 'status')) { $where[] = 'status = ?'; $params[] = $status; }
if ($dateFrom !== '' && column_exists($pdo, $table, 'created_at')) { $where[] = 'DATE(created_at) >= ?'; $params[] = $dateFrom; }
if ($dateTo !== '' && column_exists($pdo, $table, 'created_at')) { $where[] = 'DATE(created_at) <= ?'; $params[] = $dateTo; }
if ($q !== '') {
    $parts = [];
    foreach ($columns as $col) { $parts[] = 'CAST(`'.$col.'` AS CHAR) LIKE ?'; $params[] = '%'.$q.'%'; }
    $where[] = '(' . implode(' OR ', $parts) . ')';
}
$sql = 'SELECT `'.implode('`,`', $columns).'` FROM `'.$table.'`' . ($where ? ' WHERE '.implode(' AND ', $where) : '') . ' ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$filename = 'eukasko_' . $type . '_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$filename.'"');
echo "\xEF\xBB\xBF";
$out = fopen('php://output', 'w');
fputcsv($out, $columns, ';');
foreach ($rows as $row) {
    $line = [];
    foreach ($columns as $col) $line[] = $row[$col] ?? '';
    fputcsv($out, $line, ';');
}
fclose($out);
exit;
