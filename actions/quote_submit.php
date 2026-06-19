<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../pages/quote.php');
$user = current_user();
$data = [
    'year'=>(int)($_POST['year'] ?? 0),
    'brand'=>trim((string)($_POST['brand'] ?? '')),
    'model'=>trim((string)($_POST['model'] ?? '')),
    'vin'=>strtoupper(trim((string)($_POST['vin'] ?? ''))),
    'plate'=>strtoupper(trim((string)($_POST['plate'] ?? ''))),
    'value'=>(float)($_POST['value'] ?? 0),
    'experience'=>(int)($_POST['exp'] ?? $_POST['experience'] ?? 0),
    'driver_name'=>trim((string)($_POST['driverName'] ?? '')),
    'driver_birth'=>trim((string)($_POST['driverBirth'] ?? '')),
    'driver_license'=>trim((string)($_POST['driverLicense'] ?? '')),
    'deductible'=>(int)($_POST['deductible'] ?? 15000),
    'opt_theft'=>!empty($_POST['opt_theft']) ? 1 : 0,
    'opt_glass'=>!empty($_POST['opt_glass']) ? 1 : 0,
    'opt_road'=>!empty($_POST['opt_road']) ? 1 : 0,
];
if ($data['year'] < 2016 || $data['year'] > 2025 || $data['brand']==='' || $data['model']==='' || $data['value'] < 200000 || $data['driver_name']==='' || $data['driver_birth']==='' || $data['driver_license']==='') {
    flash_set('quote', 'Проверьте обязательные поля калькулятора.');
    redirect('../pages/quote.php');
}
$calc = compute_quote($data);
$carDoc = save_upload('docCar', 'documents');
$driverDoc = save_upload('docDriver', 'documents');
$sessionKey = session_id();
$stmt = $pdo->prepare('INSERT INTO quotes (user_id, session_key, year, brand, model, vin, plate, car_value, experience, driver_name, driver_birth, driver_license, car_doc_path, driver_doc_path, deductible, opt_theft, opt_glass, opt_road, brand_class, price_year, price_month, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
$stmt->execute([$user['id'] ?? null, $sessionKey, $data['year'], $data['brand'], $data['model'], $data['vin'], $data['plate'], $data['value'], $data['experience'], $data['driver_name'], $data['driver_birth'], $data['driver_license'], $carDoc, $driverDoc, $data['deductible'], $data['opt_theft'], $data['opt_glass'], $data['opt_road'], $calc['brand_class'], $calc['price_year'], $calc['price_month']]);
$quoteId = (int)$pdo->lastInsertId();
$_SESSION['last_quote_id'] = $quoteId;
create_response('quote', ['user_id'=>$user['id'] ?? null, 'name'=>$data['driver_name'], 'subject'=>'Новый расчёт КАСКО', 'message'=>$data['brand'].' '.$data['model'].' '.$data['year'].', цена: '.money($calc['price_year']), 'quote_id'=>$quoteId]);
flash_set('quote', 'Расчёт сохранён. Теперь можно перейти к оплате.');
redirect('../pages/quote.php?quote_id=' . $quoteId);
