<?php
require_once __DIR__ . '/../includes/helpers.php';
if (!is_post()) redirect('../pages/contact.php');
$user = current_user();
$name = trim((string)($_POST['name'] ?? ''));
$email = strtolower(trim((string)($_POST['email'] ?? '')));
$phone = trim((string)($_POST['phone'] ?? ''));
$msg = trim((string)($_POST['msg'] ?? $_POST['message'] ?? ''));
if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set('contact', 'Введите имя и корректный email.');
    redirect('../pages/contact.php');
}
create_response('contact', ['user_id'=>$user['id'] ?? null, 'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'subject'=>'Контактная форма', 'message'=>$msg]);
flash_set('contact', 'Сообщение отправлено. Мы свяжемся с вами в ближайшее время.');
redirect('../pages/contact.php');
