<?php
require_once __DIR__ . '/../includes/helpers.php';
header('Content-Type: application/json; charset=utf-8');
$q = find_quote(isset($_GET['quote_id']) ? (int)$_GET['quote_id'] : null);
if (!$q) { echo json_encode(['ok'=>false], JSON_UNESCAPED_UNICODE); exit; }
echo json_encode(['ok'=>true,'quote'=>[
    'id'=>(int)$q['id'], 'year'=>(int)$q['year'], 'brand'=>$q['brand'], 'model'=>$q['model'],
    'car_value'=>(float)$q['car_value'], 'experience'=>(int)$q['experience'], 'deductible'=>(int)$q['deductible'],
    'price_year'=>(float)$q['price_year'], 'price_month'=>(float)$q['price_month']
]], JSON_UNESCAPED_UNICODE);
