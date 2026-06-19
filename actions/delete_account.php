<?php
require_once __DIR__ . '/../includes/helpers.php';
$user = require_user_from_subdir();
$stmt = $pdo->prepare("UPDATE users SET status='blocked', updated_at=NOW() WHERE id=?");
$stmt->execute([(int)$user['id']]);
unset($_SESSION['user_id']);
redirect('../index.php');
