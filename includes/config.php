<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'eukasko');
define('DB_USER', 'root');
define('DB_PASS', '');
define('ADMIN_LOGIN', 'admin');
define('ADMIN_PASSWORD', '123123');

function show_db_error(Throwable $e): void {
    http_response_code(500);
    echo '<!doctype html><html lang="ru"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Сервис временно недоступен</title>';
    echo '<style>body{margin:0;background:#070a12;color:#f5f7fb;font-family:Arial,sans-serif;display:grid;place-items:center;min-height:100vh;line-height:1.55}.box{max-width:620px;padding:34px;border:1px solid rgba(255,255,255,.14);border-radius:22px;background:rgba(255,255,255,.06)}a{color:#39c5ff}</style></head><body><div class="box">';
    echo '<h1>Сервис временно недоступен</h1>';
    echo '<p>Попробуйте обновить страницу через несколько минут. Если ошибка повторяется, обратитесь в поддержку.</p>';
    echo '<p><a href="/">Вернуться на главную</a></p>';
    echo '</div></body></html>';
    exit;
}

function install_tables(PDO $pdo): void {
    $sqlFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database.sql';
    if (!is_file($sqlFile)) throw new RuntimeException('Не найден database.sql');
    $sql = (string)file_get_contents($sqlFile);
    $sql = preg_replace('/^\s*CREATE\s+DATABASE\s+IF\s+NOT\s+EXISTS\s+`?eukasko`?.*?;\s*/mi', '', $sql) ?? $sql;
    $sql = preg_replace('/^\s*USE\s+`?eukasko`?\s*;\s*/mi', '', $sql) ?? $sql;
    foreach (array_filter(array_map('trim', explode(';', $sql))) as $statement) {
        if ($statement !== '') $pdo->exec($statement);
    }
}


function column_exists(PDO $pdo, string $table, string $column): bool {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?");
    $stmt->execute([$table, $column]);
    return (int)$stmt->fetchColumn() > 0;
}

function add_column_if_missing(PDO $pdo, string $table, string $column, string $definition): void {
    if (!column_exists($pdo, $table, $column)) {
        $pdo->exec("ALTER TABLE `$table` ADD COLUMN $definition");
    }
}

function migrate_schema(PDO $pdo): void {
    // Миграция нужна, если база была создана старой версией проекта.
    // Она безопасно добавляет недостающие поля без удаления существующих данных.
    add_column_if_missing($pdo, 'users', 'status', "status VARCHAR(30) NOT NULL DEFAULT 'active'");
    add_column_if_missing($pdo, 'users', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'users', 'updated_at', "updated_at DATETIME DEFAULT NULL");

    add_column_if_missing($pdo, 'quotes', 'session_key', "session_key VARCHAR(120) DEFAULT NULL AFTER user_id");
    add_column_if_missing($pdo, 'quotes', 'vin', "vin VARCHAR(40) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'plate', "plate VARCHAR(40) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'driver_name', "driver_name VARCHAR(190) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'driver_birth', "driver_birth DATE DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'driver_license', "driver_license VARCHAR(120) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'car_doc_path', "car_doc_path VARCHAR(255) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'driver_doc_path', "driver_doc_path VARCHAR(255) DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'status', "status VARCHAR(30) NOT NULL DEFAULT 'new'");
    add_column_if_missing($pdo, 'quotes', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'quotes', 'updated_at', "updated_at DATETIME DEFAULT NULL");

    add_column_if_missing($pdo, 'policies', 'promo', "promo VARCHAR(50) DEFAULT NULL");
    add_column_if_missing($pdo, 'policies', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'policies', 'updated_at', "updated_at DATETIME DEFAULT NULL");

    add_column_if_missing($pdo, 'receipts', 'card_last4', "card_last4 VARCHAR(4) DEFAULT NULL");
    add_column_if_missing($pdo, 'receipts', 'card_exp', "card_exp VARCHAR(10) DEFAULT NULL");
    add_column_if_missing($pdo, 'receipts', 'payer_email', "payer_email VARCHAR(190) DEFAULT NULL");
    add_column_if_missing($pdo, 'receipts', 'payer_phone', "payer_phone VARCHAR(60) DEFAULT NULL");
    add_column_if_missing($pdo, 'receipts', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'receipts', 'updated_at', "updated_at DATETIME DEFAULT NULL");

    add_column_if_missing($pdo, 'claims', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'claims', 'updated_at', "updated_at DATETIME DEFAULT NULL");

    add_column_if_missing($pdo, 'responses', 'status', "status VARCHAR(30) NOT NULL DEFAULT 'new' AFTER type");
    add_column_if_missing($pdo, 'responses', 'user_id', "user_id INT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'name', "name VARCHAR(160) DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'email', "email VARCHAR(190) DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'phone', "phone VARCHAR(60) DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'subject', "subject VARCHAR(255) DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'message', "message TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'quote_id', "quote_id INT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'policy_id', "policy_id INT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'claim_id', "claim_id INT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'receipt_id', "receipt_id INT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'attachment_path', "attachment_path VARCHAR(255) DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'admin_note', "admin_note TEXT DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'updated_at', "updated_at DATETIME DEFAULT NULL");
    add_column_if_missing($pdo, 'responses', 'created_at', "created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
}

try {
    $serverPdo = new PDO('mysql:host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    $serverPdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    install_tables($pdo);
    migrate_schema($pdo);
} catch (Throwable $e) {
    show_db_error($e);
}
