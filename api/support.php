<?php
require_once __DIR__ . '/../includes/helpers.php';
header('Content-Type: application/json; charset=utf-8');
$user = current_user();
$name = trim((string)($_POST['name'] ?? $_POST['sName'] ?? ''));
$contact = trim((string)($_POST['contact'] ?? $_POST['sContact'] ?? ''));
$message = trim((string)($_POST['message'] ?? $_POST['sMsg'] ?? ''));
$attachment = save_upload('file', 'support');
if ($message === '') {
    http_response_code(422);
    echo json_encode(['ok'=>false,'message'=>'Введите сообщение.'], JSON_UNESCAPED_UNICODE);
    exit;
}
$email = filter_var($contact, FILTER_VALIDATE_EMAIL) ? strtolower($contact) : null;
$phone = $email ? null : $contact;
create_response('support', ['user_id'=>$user['id'] ?? null, 'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'subject'=>'Поддержка', 'message'=>$message, 'attachment_path'=>$attachment]);
echo json_encode(['ok'=>true,'message'=>'Сообщение отправлено.'], JSON_UNESCAPED_UNICODE);
