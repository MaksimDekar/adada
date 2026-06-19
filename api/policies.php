<?php
require_once __DIR__ . '/../includes/helpers.php';
header('Content-Type: application/json; charset=utf-8');
$user = current_user();
if (!$user) { echo json_encode(['ok'=>false,'policies'=>[]], JSON_UNESCAPED_UNICODE); exit; }
$rows = lk_policies($user);
echo json_encode(['ok'=>true,'policies'=>$rows], JSON_UNESCAPED_UNICODE);
