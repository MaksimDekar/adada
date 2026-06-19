<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../pages/checkout.php');
$user = current_user();
$quoteId = (int)($_POST['quote_id'] ?? 0);
$email = strtolower(trim((string)($_POST['buyerEmail'] ?? '')));
$phone = trim((string)($_POST['buyerPhone'] ?? ''));
$plan = (string)($_POST['plan'] ?? 'plus');
$method = (string)($_POST['method'] ?? 'card');
$promo = trim((string)($_POST['promo'] ?? ''));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $phone === '' || empty($_POST['agree'])) {
    flash_set('checkout', 'Проверьте email, телефон и согласие с условиями.');
    redirect('../pages/checkout.php' . ($quoteId ? '?quote_id='.$quoteId : ''));
}
if (!$quoteId && !empty($_SESSION['last_quote_id'])) {
    $quoteId = (int)$_SESSION['last_quote_id'];
}
if ($quoteId) {
    $stmt = $pdo->prepare('SELECT * FROM quotes WHERE id = ? LIMIT 1');
    $stmt->execute([$quoteId]);
    $quote = $stmt->fetch();
} else {
    $stmt = $pdo->prepare('SELECT * FROM quotes WHERE (user_id <=> ? OR session_key = ?) ORDER BY id DESC LIMIT 1');
    $stmt->execute([$user['id'] ?? null, session_id()]);
    $quote = $stmt->fetch();
    if ($quote) $quoteId = (int)$quote['id'];
}
if (!$quote) {
    flash_set('checkout', 'Сначала сделайте расчёт в калькуляторе.');
    redirect('../pages/checkout.php');
}
$plans = plans();
if (!isset($plans[$plan])) $plan = 'plus';
$totalYear = round((float)$quote['price_year'] * (float)$plans[$plan]['factor']);
if (strtoupper($promo) === 'EU2026') $totalYear = round($totalYear * 0.95);
$totalMonth = round($totalYear / 12);
$userId = $user['id'] ?? null;
if (!$userId) {
    $s = $pdo->prepare('SELECT id FROM users WHERE email=? LIMIT 1');
    $s->execute([$email]);
    $found = $s->fetch();
    if ($found) $userId = (int)$found['id'];
}
$policyNumber = 'EUK-' . date('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
$stmt = $pdo->prepare('INSERT INTO policies (policy_number, quote_id, user_id, holder_email, holder_phone, plan, promo, total_year, total_month, method, status, start_date, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), NOW())');
$stmt->execute([$policyNumber, $quoteId, $userId, $email, $phone, $plan, $promo, $totalYear, $totalMonth, $method, 'active']);
$policyId = (int)$pdo->lastInsertId();
$card = preg_replace('/\D+/', '', (string)($_POST['cardNumber'] ?? ''));
$receiptNumber = 'CHK-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
$stmt = $pdo->prepare('INSERT INTO receipts (receipt_number, policy_id, user_id, payment_method, amount, month_amount, card_last4, card_exp, payer_email, payer_phone, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
$stmt->execute([$receiptNumber, $policyId, $userId, $method, $totalYear, $totalMonth, $card ? substr($card, -4) : null, trim((string)($_POST['cardExp'] ?? '')), $email, $phone, 'paid']);
$receiptId = (int)$pdo->lastInsertId();
create_response('checkout', ['user_id'=>$userId, 'email'=>$email, 'phone'=>$phone, 'subject'=>'Оплата и оформление полиса', 'message'=>'Создан полис '.$policyNumber.' и чек '.$receiptNumber, 'quote_id'=>$quoteId, 'policy_id'=>$policyId, 'receipt_id'=>$receiptId]);
redirect('../pages/success.php?policy_id=' . $policyId);
