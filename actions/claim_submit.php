<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../pages/claims.php');
$user = current_user();
$policyId = (int)($_POST['policy_id'] ?? $_POST['policyId'] ?? 0);
$type = trim((string)($_POST['claim_type'] ?? $_POST['type'] ?? ''));
$date = trim((string)($_POST['claim_date'] ?? $_POST['when'] ?? ''));
$desc = trim((string)($_POST['description'] ?? $_POST['desc'] ?? ''));
if ($type === '' || $date === '' || $desc === '') {
    flash_set('claim', 'Заполните тип, дату и описание.');
    redirect('../pages/claims.php');
}
$userId = $user['id'] ?? null;
if ($policyId) {
    $s = $pdo->prepare('SELECT user_id FROM policies WHERE id=? LIMIT 1');
    $s->execute([$policyId]);
    $p = $s->fetch();
    if ($p && !$userId) $userId = $p['user_id'];
}
$claimNumber = 'CLM-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
$stmt = $pdo->prepare('INSERT INTO claims (claim_number, policy_id, user_id, claim_type, claim_date, description, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
$stmt->execute([$claimNumber, $policyId ?: null, $userId, $type, $date, $desc, 'received']);
$claimId = (int)$pdo->lastInsertId();
create_response('claim', ['user_id'=>$userId, 'subject'=>'Страховой случай', 'message'=>$type . ': ' . $desc, 'policy_id'=>$policyId ?: null, 'claim_id'=>$claimId]);
flash_set('claim', 'Заявка отправлена. Мы рассмотрим обращение и обновим статус в личном кабинете.');
$back = (string)($_POST['back'] ?? '../pages/claims.php');
redirect($back);
