<?php
require_once __DIR__ . '/../includes/helpers.php';
header('Content-Type: application/json; charset=utf-8');
$user = current_user();
echo json_encode(['logged'=> (bool)$user, 'email'=>$user['email'] ?? null], JSON_UNESCAPED_UNICODE);
