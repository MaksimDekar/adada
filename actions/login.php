<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../lk/login.php');
$email = strtolower(trim((string)($_POST['email'] ?? $_POST['login'] ?? $_POST['user'] ?? '')));
$pass = trim((string)($_POST['password'] ?? $_POST['pass'] ?? ''));
$back = (string)($_POST['back'] ?? '../lk/login.php');
$next = (string)($_POST['next'] ?? '../lk/index.php');

if ($email === ADMIN_LOGIN && $pass === ADMIN_PASSWORD) {
    $_SESSION['admin_logged'] = true;
    redirect('../admin/index.php');
}
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();
if (!$user || !password_verify($pass, (string)$user['password_hash'])) {
    flash_set('login', 'Неверный email или пароль.');
    redirect($back);
}
if (($user['status'] ?? '') === 'blocked') {
    flash_set('login', 'Аккаунт заблокирован.');
    redirect($back);
}
$_SESSION['user_id'] = (int)$user['id'];
redirect($next ?: '../lk/index.php');
