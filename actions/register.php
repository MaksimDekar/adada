<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../lk/register.php');
$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = strtolower(trim((string)($_POST['email'] ?? '')));
$pass = (string)($_POST['password'] ?? '');
$pass2 = (string)($_POST['password2'] ?? '');
$back = (string)($_POST['back'] ?? '../lk/register.php');
if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6 || $pass !== $pass2 || empty($_POST['agree'])) {
    flash_set('register', 'Проверьте поля: имя, email, пароль от 6 символов, совпадение паролей и согласие.');
    redirect($back);
}
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
if ($stmt->fetch()) {
    flash_set('register', 'Этот email уже зарегистрирован. Выполните вход.');
    redirect($back);
}
$stmt = $pdo->prepare('INSERT INTO users (name, phone, email, password_hash, created_at) VALUES (?, ?, ?, ?, NOW())');
$stmt->execute([$name, $phone, $email, password_hash($pass, PASSWORD_DEFAULT)]);
$_SESSION['user_id'] = (int)$pdo->lastInsertId();
create_response('register', ['user_id'=>$_SESSION['user_id'], 'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'subject'=>'Регистрация пользователя', 'message'=>'Пользователь зарегистрировался на сайте.']);
redirect('../lk/index.php');
