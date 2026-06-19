<?php
require_once __DIR__ . '/config.php';

function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function redirect(string $url): void { header('Location: ' . $url); exit; }
function is_post(): bool { return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST'; }
function flash_set(string $key, string $message): void { $_SESSION['flash'][$key] = $message; }
function flash_get(string $key): string { $m = $_SESSION['flash'][$key] ?? ''; unset($_SESSION['flash'][$key]); return (string)$m; }
function money($v): string { return number_format((float)$v, 0, ',', ' ') . ' ₽'; }
function dt($v): string { return $v ? e(substr(str_replace('T',' ', (string)$v),0,19)) : '—'; }

function current_user(): ?array {
    global $pdo;
    if (empty($_SESSION['user_id'])) return null;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([(int)$_SESSION['user_id']]);
    $u = $stmt->fetch();
    return $u ?: null;
}
function require_user(): array {
    $u = current_user();
    if (!$u) redirect('login.php');
    return $u;
}
function require_user_from_subdir(): array {
    $u = current_user();
    if (!$u) redirect('../lk/login.php');
    return $u;
}
function require_admin(): void {
    if (empty($_SESSION['admin_logged'])) redirect('login.php');
}

function cars(): array {
    return [
        'Audi'=>['A3','A4','A6','Q3','Q5','Q7'],
        'BMW'=>['1 Series','3 Series','5 Series','X1','X3','X5'],
        'Mercedes-Benz'=>['A-Class','C-Class','E-Class','GLA','GLC','GLE'],
        'Volkswagen'=>['Golf','Passat','Tiguan','Touareg','Polo'],
        'Skoda'=>['Octavia','Superb','Karoq','Kodiaq','Fabia'],
        'SEAT'=>['Leon','Ibiza','Ateca','Arona','Tarraco'],
        'Porsche'=>['Macan','Cayenne','Panamera','911'],
        'Opel'=>['Astra','Insignia','Corsa','Grandland'],
        'Peugeot'=>['208','308','508','2008','3008'],
        'Citroen'=>['C3','C4','C5 Aircross','Berlingo'],
        'Renault'=>['Clio','Megane','Captur','Kadjar','Austral'],
        'Dacia'=>['Duster','Sandero','Logan'],
        'Fiat'=>['500','Tipo','Panda'],
        'Alfa Romeo'=>['Giulia','Stelvio','Tonale'],
        'Volvo'=>['S60','S90','XC40','XC60','XC90'],
        'Jaguar'=>['XE','XF','F-Pace','E-Pace'],
        'Land Rover'=>['Range Rover Evoque','Discovery Sport','Defender'],
        'MINI'=>['Hatch','Countryman','Clubman'],
        'Bentley'=>['Bentayga','Continental GT'],
        'Rolls-Royce'=>['Ghost','Cullinan'],
        'Aston Martin'=>['DB11','Vantage','DBX'],
    ];
}
function brand_class(string $brand): string {
    $premium = ['Porsche','Jaguar','Land Rover','Bentley','Rolls-Royce','Aston Martin','Mercedes-Benz','BMW','Audi'];
    if (in_array($brand, $premium, true)) return 'premium';
    if ($brand === 'Dacia') return 'budget';
    return 'standard';
}
function compute_quote(array $data): array {
    $cls = brand_class((string)($data['brand'] ?? ''));
    $rates = ['premium'=>0.065,'standard'=>0.055,'budget'=>0.048];
    $year = (int)($data['year'] ?? date('Y'));
    $value = max(0, (float)($data['value'] ?? $data['car_value'] ?? 0));
    $exp = max(0, (float)($data['experience'] ?? $data['exp'] ?? 0));
    $deductible = (int)($data['deductible'] ?? 15000);
    $age = max(0, min(12, (int)date('Y') - $year));
    $ageFactor = 1 + $age * 0.02;
    $expFactor = max(0.85, min(1.25, 1.25 - $exp * 0.03));
    $dedFactors = [0=>1.15,15000=>1.0,30000=>0.92,60000=>0.82];
    $dedFactor = $dedFactors[$deductible] ?? 1.0;
    $addons = (!empty($data['opt_theft']) ? 9000 : 0) + (!empty($data['opt_glass']) ? 5000 : 0) + (!empty($data['opt_road']) ? 4000 : 0);
    $priceYear = round($value * $rates[$cls] * $ageFactor * $expFactor * $dedFactor + $addons);
    return ['brand_class'=>$cls,'price_year'=>$priceYear,'price_month'=>round($priceYear/12),'addons'=>$addons,'age_factor'=>$ageFactor,'experience_factor'=>$expFactor,'deductible_factor'=>$dedFactor];
}
function plans(): array {
    return ['basic'=>['title'=>'Basic','factor'=>0.95], 'plus'=>['title'=>'Plus','factor'=>1.08], 'max'=>['title'=>'Max','factor'=>1.18]];
}
function save_upload(string $field, string $subdir): ?string {
    if (empty($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if (($_FILES[$field]['error'] ?? 0) !== UPLOAD_ERR_OK) return null;
    if ((int)($_FILES[$field]['size'] ?? 0) > 5 * 1024 * 1024) return null;
    $ext = strtolower(pathinfo((string)$_FILES[$field]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','webp','pdf'], true)) return null;
    $dir = dirname(__DIR__) . '/uploads/' . trim($subdir, '/');
    if (!is_dir($dir)) mkdir($dir, 0775, true);
    $file = date('Ymd_His') . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $dir . '/' . $file)) return null;
    return 'uploads/' . trim($subdir, '/') . '/' . $file;
}
function create_response(string $type, array $d): void {
    global $pdo;
    migrate_schema($pdo);

    $allowed = [
        'type' => $type,
        'user_id' => $d['user_id'] ?? null,
        'name' => $d['name'] ?? null,
        'email' => $d['email'] ?? null,
        'phone' => $d['phone'] ?? null,
        'subject' => $d['subject'] ?? null,
        'message' => $d['message'] ?? null,
        'quote_id' => $d['quote_id'] ?? null,
        'policy_id' => $d['policy_id'] ?? null,
        'claim_id' => $d['claim_id'] ?? null,
        'receipt_id' => $d['receipt_id'] ?? null,
        'attachment_path' => $d['attachment_path'] ?? null,
    ];
    $cols = [];
    $vals = [];
    foreach ($allowed as $col => $val) {
        if (column_exists($pdo, 'responses', $col)) {
            $cols[] = $col;
            $vals[] = $val;
        }
    }
    if (column_exists($pdo, 'responses', 'created_at')) {
        $cols[] = 'created_at';
        $placeholders = rtrim(str_repeat('?,', count($vals)), ',');
        $sql = 'INSERT INTO responses (`' . implode('`,`', $cols) . '`) VALUES (' . $placeholders . ', NOW())';
    } else {
        $placeholders = rtrim(str_repeat('?,', count($vals)), ',');
        $sql = 'INSERT INTO responses (`' . implode('`,`', $cols) . '`) VALUES (' . $placeholders . ')';
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($vals);
}
function badge(string $s): string { return '<span class="pill">' . e($s) . '</span>'; }
function current_url_file(): string { return basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''); }
function row_empty(string $text='Пока нет данных.'): string { return '<div class="muted">' . e($text) . '</div>'; }
function hidden_quote_id(): string { return isset($_GET['quote_id']) ? '<input type="hidden" name="quote_id" value="' . e((int)$_GET['quote_id']) . '">' : ''; }

function flash_html(string $key): string {
    $msg = flash_get($key);
    return $msg !== '' ? '<div class="msg is-ok" role="status" aria-live="polite">' . e($msg) . '</div>' : '';
}
function flash_bad_html(string $key): string {
    $msg = flash_get($key);
    return $msg !== '' ? '<div class="msg is-bad" role="status" aria-live="polite">' . e($msg) . '</div>' : '';
}
function find_quote(?int $id = null): ?array {
    global $pdo;
    $user = current_user();
    if ($id) {
        $stmt = $pdo->prepare('SELECT * FROM quotes WHERE id=? LIMIT 1');
        $stmt->execute([$id]);
        $q = $stmt->fetch();
        return $q ?: null;
    }
    if (!empty($_SESSION['last_quote_id'])) {
        $stmt = $pdo->prepare('SELECT * FROM quotes WHERE id=? LIMIT 1');
        $stmt->execute([(int)$_SESSION['last_quote_id']]);
        $q = $stmt->fetch();
        if ($q) return $q;
    }
    $stmt = $pdo->prepare('SELECT * FROM quotes WHERE (user_id <=> ? OR session_key = ?) ORDER BY id DESC LIMIT 1');
    $stmt->execute([$user['id'] ?? null, session_id()]);
    $q = $stmt->fetch();
    return $q ?: null;
}
function quote_summary_html(?array $q): string {
    if (!$q) return '<div class="muted">Заполните данные и нажмите «Посчитать».</div>';
    return '<div class="row"><span class="muted">Авто</span><b>'.e($q['brand'].' '.$q['model'].' '.$q['year']).'</b></div>'
        . '<div class="row"><span class="muted">Стоимость авто</span><b>'.money($q['car_value']).'</b></div>'
        . '<div class="row"><span class="muted">Франшиза</span><b>'.money($q['deductible']).'</b></div>'
        . '<div class="row"><span class="muted">Стаж</span><b>'.e($q['experience']).' лет</b></div>';
}
function selected_quote(): ?array { return find_quote(isset($_GET['quote_id']) ? (int)$_GET['quote_id'] : null); }
function plan_options_html(?string $selected = null): string {
    $selected = $selected ?: ($_GET['plan'] ?? 'plus');
    $html = '';
    foreach (plans() as $key=>$p) {
        $sel = $key === $selected ? ' selected' : '';
        $html .= '<option value="'.e($key).'"'.$sel.'>'.e($p['title']).'</option>';
    }
    return $html;
}
function policy_options_html(?int $selected = null): string {
    global $pdo;
    $user = current_user();
    if (!$user) return '<option value="">Войдите в ЛК</option>';
    $stmt = $pdo->prepare('SELECT id, policy_number FROM policies WHERE user_id=? OR holder_email=? ORDER BY id DESC');
    $stmt->execute([(int)$user['id'], $user['email']]);
    $rows = $stmt->fetchAll();
    if (!$rows) return '<option value="">Нет полисов</option>';
    $html = '';
    foreach ($rows as $r) {
        $sel = ((int)$r['id'] === (int)$selected) ? ' selected' : '';
        $html .= '<option value="'.(int)$r['id'].'"'.$sel.'>'.e($r['policy_number']).'</option>';
    }
    return $html;
}
function checkout_summary_html(?array $q): string {
    if (!$q) return '<div class="muted">Сначала сделайте расчёт.</div>';
    return '<div class="row"><span class="muted">Расчёт</span><b>#'.(int)$q['id'].'</b></div>'
        . '<div class="row"><span class="muted">Авто</span><b>'.e($q['brand'].' '.$q['model']).'</b></div>'
        . '<div class="row"><span class="muted">Год</span><b>'.e($q['year']).'</b></div>'
        . '<div class="row"><span class="muted">База/год</span><b data-base-price="'.e($q['price_year']).'">'.money($q['price_year']).'</b></div>';
}
function policy_success_html(?int $policyId): string {
    global $pdo;
    if (!$policyId) return '<div class="muted">Полис не найден.</div>';
    $stmt = $pdo->prepare('SELECT p.*, q.brand, q.model, q.year FROM policies p LEFT JOIN quotes q ON q.id=p.quote_id WHERE p.id=? LIMIT 1');
    $stmt->execute([$policyId]);
    $p = $stmt->fetch();
    if (!$p) return '<div class="muted">Полис не найден.</div>';
    return '<div class="row"><span class="muted">Полис</span><b>'.e($p['policy_number']).'</b></div>'
        . '<div class="row"><span class="muted">Авто</span><b>'.e(trim(($p['brand'] ?? '').' '.($p['model'] ?? '').' '.($p['year'] ?? ''))).'</b></div>'
        . '<div class="row"><span class="muted">План</span><b>'.e(strtoupper((string)$p['plan'])).'</b></div>'
        . '<div class="row"><span class="muted">Итого/год</span><b>'.money($p['total_year']).'</b></div>'
        . '<div class="row"><span class="muted">Статус</span><b>'.e($p['status']).'</b></div>';
}
function admin_count(string $table): int { global $pdo; return (int)$pdo->query('SELECT COUNT(*) FROM `'.$table.'`')->fetchColumn(); }
function admin_count_where(string $table, string $where, array $params = []): int {
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM `'.$table.'` WHERE '.$where);
    $stmt->execute($params);
    return (int)$stmt->fetchColumn();
}
function admin_nav_extra(): string {
    return '<a data-admin-link href="quotes.php">Расчёты <span class="badge">'.admin_count('quotes').'</span></a>'
        . '<a data-admin-link href="responses.php">Отклики <span class="badge">'.admin_count('responses').'</span></a>'
        . '<a data-admin-link href="receipts.php">Чеки <span class="badge">'.admin_count('receipts').'</span></a>';
}
function table_or_empty(array $rows, array $headers, callable $rowFn): string {
    if (!$rows) return '<div class="muted">Пока нет данных.</div>';
    $html = '<div class="table-wrap"><table class="table"><thead><tr>';
    foreach ($headers as $h) $html .= '<th>'.e($h).'</th>';
    $html .= '</tr></thead><tbody>';
    foreach ($rows as $r) $html .= $rowFn($r);
    return $html.'</tbody></table></div>';
}

function lk_policies(array $user): array {
    global $pdo;
    $stmt = $pdo->prepare('SELECT p.*, q.brand, q.model, q.year, q.car_value FROM policies p LEFT JOIN quotes q ON q.id=p.quote_id WHERE p.user_id=? OR p.holder_email=? ORDER BY p.id DESC');
    $stmt->execute([(int)$user['id'], $user['email']]);
    return $stmt->fetchAll();
}
function lk_claims(array $user): array {
    global $pdo;
    $stmt = $pdo->prepare('SELECT c.*, p.policy_number FROM claims c LEFT JOIN policies p ON p.id=c.policy_id WHERE c.user_id=? OR p.user_id=? OR p.holder_email=? ORDER BY c.id DESC');
    $stmt->execute([(int)$user['id'], (int)$user['id'], $user['email']]);
    return $stmt->fetchAll();
}
function lk_quotes(array $user): array {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM quotes WHERE user_id=? ORDER BY id DESC');
    $stmt->execute([(int)$user['id']]);
    return $stmt->fetchAll();
}
function lk_receipts(array $user): array {
    global $pdo;
    $stmt = $pdo->prepare('SELECT rc.*, p.policy_number FROM receipts rc LEFT JOIN policies p ON p.id=rc.policy_id WHERE rc.user_id=? OR p.user_id=? OR p.holder_email=? ORDER BY rc.id DESC');
    $stmt->execute([(int)$user['id'], (int)$user['id'], $user['email']]);
    return $stmt->fetchAll();
}
function lk_policies_table(array $user): string {
    $rows = lk_policies($user);
    return table_or_empty($rows, ['Полис','Авто','Цена','Статус'], function($p){
        return '<tr><td><b>'.e($p['policy_number']).'</b><br><small>'.dt($p['created_at']).'</small></td>'
            . '<td>'.e(trim(($p['brand'] ?? '').' '.($p['model'] ?? ''))).'<br><small>'.e($p['year'] ?? '').'</small></td>'
            . '<td><b>'.money($p['total_year']).'</b><br><small>'.money($p['total_month']).'/мес</small></td>'
            . '<td>'.badge(status_label('policies', $p['status'])).'<br><small>'.e(strtoupper((string)$p['plan'])).'</small></td></tr>';
    });
}
function lk_claims_table(array $user): string {
    $rows = lk_claims($user);
    return table_or_empty($rows, ['Заявка','Полис','Тип','Статус'], function($c){
        return '<tr><td><b>'.e($c['claim_number']).'</b><br><small>'.dt($c['created_at']).'</small></td>'
            . '<td>'.e($c['policy_number'] ?: '—').'</td>'
            . '<td>'.e($c['claim_type']).'<br><small>'.e($c['claim_date']).'</small></td>'
            . '<td>'.badge(status_label('claims', $c['status'])).'</td></tr>';
    });
}
function lk_last_policies_html(array $user): string {
    $rows = array_slice(lk_policies($user), 0, 5);
    if (!$rows) return '<div class="muted">Пока нет полисов. Можно оформить через оплату.</div>';
    $html = '';
    foreach ($rows as $p) {
        $html .= '<div class="row"><span class="muted">'.e($p['policy_number']).' • '.e(trim(($p['brand'] ?? '').' '.($p['model'] ?? ''))).'</span><b>'.money($p['total_year']).'</b></div>';
    }
    return $html;
}

function admin_statuses(string $entity): array {
    $common = ['new'=>'Новая','in_progress'=>'В обработке','approved'=>'Одобрено','rejected'=>'Отклонено'];
    switch ($entity) {
        case 'users': return ['active'=>'Активен','blocked'=>'Заблокирован'];
        case 'quotes': return $common + ['archived'=>'Архив'];
        case 'policies': return ['active'=>'Активен','in_progress'=>'В обработке','approved'=>'Одобрен','cancelled'=>'Отменён','expired'=>'Истёк'];
        case 'claims': return ['received'=>'Получена','in_progress'=>'В обработке','approved'=>'Одобрена','rejected'=>'Отклонена','paid'=>'Выплачена'];
        case 'receipts': return ['paid'=>'Оплачен','pending'=>'Ожидает','failed'=>'Ошибка','refunded'=>'Возврат'];
        case 'responses': return $common + ['closed'=>'Закрыта'];
        default: return $common;
    }
}
function status_label(string $entity, ?string $status): string {
    $status = (string)$status;
    $map = admin_statuses($entity);
    return $map[$status] ?? ($status ?: '—');
}
function status_options(string $entity, ?string $current = ''): string {
    $html = '';
    foreach (admin_statuses($entity) as $value => $label) {
        $sel = ((string)$current === (string)$value) ? ' selected' : '';
        $html .= '<option value="'.e($value).'"'.$sel.'>'.e($label).'</option>';
    }
    return $html;
}
function admin_filter_values(): array {
    return [
        'q' => trim((string)($_GET['q'] ?? '')),
        'status' => trim((string)($_GET['status'] ?? '')),
        'date_from' => trim((string)($_GET['date_from'] ?? '')),
        'date_to' => trim((string)($_GET['date_to'] ?? '')),
    ];
}
function admin_filter_form(string $title, string $entity, string $placeholder): string {
    $f = admin_filter_values();
    $base = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: 'index.php');
    $csv = 'export.php?type='.urlencode($entity)
        . '&q='.urlencode($f['q']) . '&status='.urlencode($f['status'])
        . '&date_from='.urlencode($f['date_from']) . '&date_to='.urlencode($f['date_to']);
    $statusHtml = '<option value="">Все статусы</option>';
    foreach (admin_statuses($entity) as $value=>$label) {
        $statusHtml .= '<option value="'.e($value).'"'.($f['status']===$value?' selected':'').'>'.e($label).'</option>';
    }
    return '<form class="toolbar" method="get" action="'.e($base).'">'
        . '<div class="toolbar__left"><h1 class="u-m0">'.e($title).'</h1><span class="badge">'.admin_count($entity).'</span></div>'
        . '<div class="toolbar__right inline">'
        . '<input class="input-sm" name="q" value="'.e($f['q']).'" placeholder="'.e($placeholder).'">'
        . '<select class="select-sm" name="status">'.$statusHtml.'</select>'
        . '<input class="input-sm" type="date" name="date_from" value="'.e($f['date_from']).'">'
        . '<input class="input-sm" type="date" name="date_to" value="'.e($f['date_to']).'">'
        . '<button class="btn btn--primary" type="submit">Найти</button>'
        . '<a class="btn btn--ghost" href="'.e($base).'">Сбросить</a>'
        . '<a class="btn btn--ghost" href="'.e($csv).'">CSV</a>'
        . '</div></form>';
}
function admin_build_where(string $entity, array $searchColumns, array &$params): string {
    $f = admin_filter_values();
    $where = [];
    if ($f['status'] !== '') { $where[] = 'main.status = ?'; $params[] = $f['status']; }
    if ($f['date_from'] !== '') { $where[] = 'DATE(main.created_at) >= ?'; $params[] = $f['date_from']; }
    if ($f['date_to'] !== '') { $where[] = 'DATE(main.created_at) <= ?'; $params[] = $f['date_to']; }
    if ($f['q'] !== '' && $searchColumns) {
        $parts = [];
        foreach ($searchColumns as $col) $parts[] = "$col LIKE ?";
        $where[] = '(' . implode(' OR ', $parts) . ')';
        foreach ($searchColumns as $_) $params[] = '%' . $f['q'] . '%';
    }
    return $where ? (' WHERE ' . implode(' AND ', $where)) : '';
}
function admin_status_form(string $entity, int $id, string $current, ?string $note = ''): string {
    return '<form class="status-form" method="post" action="../actions/admin_update.php">'
        . '<input type="hidden" name="entity" value="'.e($entity).'"><input type="hidden" name="id" value="'.$id.'">'
        . '<select class="select-sm" name="status">'.status_options($entity, $current).'</select>'
        . '<input class="input-sm note-sm" name="note" value="'.e((string)$note).'" placeholder="Комментарий">'
        . '<button class="btn btn--ghost btn-sm" type="submit">Сохранить</button>'
        . '</form>';
}
function admin_delete_form(string $entity, int $id): string {
    return '<form class="delete-form" method="post" action="../actions/admin_delete.php" onsubmit="return confirm(\'Удалить запись?\')">'
        . '<input type="hidden" name="entity" value="'.e($entity).'"><input type="hidden" name="id" value="'.$id.'">'
        . '<button class="btn btn--ghost btn-sm danger" type="submit">Удалить</button></form>';
}
function admin_actions(string $entity, array $row): string {
    return '<div class="admin-actions">'.admin_status_form($entity, (int)$row['id'], (string)($row['status'] ?? ''), $row['admin_note'] ?? '').admin_delete_form($entity, (int)$row['id']).'</div>';
}
function admin_layout_nav(): string {
    return '<a data-admin-link href="index.php">Панель</a>'
        . '<a data-admin-link href="users.php">Пользователи <span class="badge">'.admin_count('users').'</span></a>'
        . admin_nav_extra()
        . '<a data-admin-link href="policies.php">Полисы <span class="badge">'.admin_count('policies').'</span></a>'
        . '<a data-admin-link href="claims.php">Случаи <span class="badge">'.admin_count('claims').'</span></a>'
        . '<a data-admin-link href="settings.php">Настройки</a>';
}

function admin_users_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('users', ['main.name','main.email','main.phone','main.admin_note'], $params);
    $stmt = $pdo->prepare('SELECT main.* FROM users main'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['ID','Пользователь','Телефон','Статус / заметка','Дата','Действия'], function($u){
        return '<tr><td>#'.(int)$u['id'].'</td><td><b>'.e($u['name']).'</b><br><small>'.e($u['email']).'</small></td><td>'.e($u['phone'] ?: '—').'</td><td>'.badge(status_label('users',$u['status'])).'<br><small>'.e($u['admin_note'] ?: '—').'</small></td><td>'.dt($u['created_at']).'</td><td>'.admin_actions('users', $u).'</td></tr>';
    });
}
function admin_quotes_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('quotes', ['main.brand','main.model','main.vin','main.plate','main.driver_name','main.driver_license','u.email','u.phone'], $params);
    $stmt = $pdo->prepare('SELECT main.*, u.email AS user_email, u.phone AS user_phone FROM quotes main LEFT JOIN users u ON u.id=main.user_id'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['Расчёт','Пользователь','Авто','Документы','Сумма','Статус','Действия'], function($q){
        $docs = [];
        if (!empty($q['car_doc_path'])) $docs[] = '<a href="../'.e($q['car_doc_path']).'" target="_blank">Авто</a>';
        if (!empty($q['driver_doc_path'])) $docs[] = '<a href="../'.e($q['driver_doc_path']).'" target="_blank">Водитель</a>';
        return '<tr><td>#'.(int)$q['id'].'<br><small>'.dt($q['created_at']).'</small></td><td>'.e($q['driver_name'] ?: '—').'<br><small>'.e($q['user_email'] ?: $q['user_phone'] ?: '—').'</small></td><td><b>'.e($q['brand'].' '.$q['model'].' '.$q['year']).'</b><br><small>VIN: '.e($q['vin'] ?: '—').' • Гос: '.e($q['plate'] ?: '—').'</small></td><td>'.($docs ? implode('<br>', $docs) : '—').'</td><td><b>'.money($q['price_year']).'</b><br><small>'.money($q['price_month']).'/мес</small></td><td>'.badge(status_label('quotes',$q['status'])).'</td><td>'.admin_actions('quotes', $q).'</td></tr>';
    });
}
function admin_policies_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('policies', ['main.policy_number','main.holder_email','main.holder_phone','main.plan','q.brand','q.model','q.year'], $params);
    $stmt = $pdo->prepare('SELECT main.*, q.brand, q.model, q.year FROM policies main LEFT JOIN quotes q ON q.id=main.quote_id'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['Полис','Пользователь','Авто','Сумма','Статус','Действия'], function($p){
        return '<tr><td><b>'.e($p['policy_number']).'</b><br><small>'.dt($p['created_at']).'</small></td><td>'.e($p['holder_email']).'<br><small>'.e($p['holder_phone']).'</small></td><td>'.e(trim(($p['brand'] ?? '').' '.($p['model'] ?? '').' '.($p['year'] ?? ''))).'<br><small>'.e(strtoupper((string)$p['plan'])).'</small></td><td><b>'.money($p['total_year']).'</b><br><small>'.money($p['total_month']).'/мес</small></td><td>'.badge(status_label('policies',$p['status'])).'</td><td>'.admin_actions('policies', $p).'</td></tr>';
    });
}
function admin_claims_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('claims', ['main.claim_number','main.claim_type','main.description','main.admin_note','p.policy_number','u.email'], $params);
    $stmt = $pdo->prepare('SELECT main.*, p.policy_number, u.email FROM claims main LEFT JOIN policies p ON p.id=main.policy_id LEFT JOIN users u ON u.id=main.user_id'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['Заявка','Полис','Пользователь','Описание','Статус','Действия'], function($c){
        return '<tr><td><b>'.e($c['claim_number']).'</b><br><small>'.dt($c['created_at']).'</small></td><td>'.e($c['policy_number'] ?: '—').'</td><td>'.e($c['email'] ?: '—').'</td><td><b>'.e($c['claim_type']).'</b><br><small>'.e(mb_strimwidth((string)$c['description'],0,150,'…','UTF-8')).'</small></td><td>'.badge(status_label('claims',$c['status'])).'</td><td>'.admin_actions('claims', $c).'</td></tr>';
    });
}
function admin_responses_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('responses', ['main.type','main.name','main.email','main.phone','main.subject','main.message','main.admin_note','u.email'], $params);
    $stmt = $pdo->prepare('SELECT main.*, u.email AS user_email FROM responses main LEFT JOIN users u ON u.id=main.user_id'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['ID','Тип','Контакты','Сообщение','Связи','Статус','Действия'], function($r){
        $contacts = trim(($r['name'] ?: '').' '.($r['email'] ?: '').' '.($r['phone'] ?: '').' '.($r['user_email'] ?: ''));
        $links = [];
        foreach (['quote_id'=>'Расчёт','policy_id'=>'Полис','claim_id'=>'Случай','receipt_id'=>'Чек'] as $k=>$label) if (!empty($r[$k])) $links[] = $label.' #'.(int)$r[$k];
        $att = $r['attachment_path'] ? '<br><small><a href="../'.e($r['attachment_path']).'" target="_blank">Вложение</a></small>' : '';
        return '<tr><td>#'.(int)$r['id'].'<br><small>'.dt($r['created_at']).'</small></td><td>'.badge($r['type']).'</td><td>'.e($contacts ?: '—').'</td><td><b>'.e($r['subject'] ?: '—').'</b><br><small>'.e(mb_strimwidth((string)$r['message'],0,140,'…','UTF-8')).'</small>'.$att.'</td><td>'.e($links ? implode(', ', $links) : '—').'</td><td>'.badge(status_label('responses',$r['status'])).'</td><td>'.admin_actions('responses', $r).'</td></tr>';
    });
}
function admin_receipts_table(): string {
    global $pdo;
    $params = [];
    $where = admin_build_where('receipts', ['main.receipt_number','main.payment_method','main.payer_email','main.payer_phone','main.admin_note','p.policy_number'], $params);
    $stmt = $pdo->prepare('SELECT main.*, p.policy_number FROM receipts main LEFT JOIN policies p ON p.id=main.policy_id'.$where.' ORDER BY main.id DESC LIMIT 300');
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    return table_or_empty($rows, ['Чек','Полис','Плательщик','Метод','Сумма','Статус','Действия'], function($r){
        return '<tr><td><b>'.e($r['receipt_number']).'</b><br><small>'.dt($r['created_at']).'</small></td><td>'.e($r['policy_number'] ?: '—').'</td><td>'.e($r['payer_email'] ?: '—').'<br><small>'.e($r['payer_phone'] ?: '').'</small></td><td>'.e($r['payment_method']).($r['card_last4'] ? '<br><small>**** '.e($r['card_last4']).'</small>' : '').'</td><td><b>'.money($r['amount']).'</b><br><small>'.money($r['month_amount']).'/мес</small></td><td>'.badge(status_label('receipts',$r['status'])).'</td><td>'.admin_actions('receipts', $r).'</td></tr>';
    });
}
function admin_recent_responses(int $limit = 6): string {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM responses ORDER BY id DESC LIMIT ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if (!$rows) return '<div class="muted">Пока нет откликов.</div>';
    $html = '';
    foreach ($rows as $r) {
        $html .= '<div class="row"><span class="muted">#'.(int)$r['id'].' • '.e($r['type']).' • '.dt($r['created_at']).'</span><b>'.e(status_label('responses',$r['status'])).'</b></div>';
    }
    return $html;
}
function admin_entity_config(string $type): array {
    switch ($type) {
        case 'users': return ['table'=>'users','columns'=>['id','name','email','phone','status','admin_note','created_at','updated_at']];
        case 'quotes': return ['table'=>'quotes','columns'=>['id','user_id','year','brand','model','vin','plate','car_value','driver_name','driver_license','price_year','price_month','status','admin_note','created_at','updated_at']];
        case 'policies': return ['table'=>'policies','columns'=>['id','policy_number','quote_id','user_id','holder_email','holder_phone','plan','promo','admin_note','total_year','total_month','method','status','admin_note','start_date','created_at','updated_at']];
        case 'claims': return ['table'=>'claims','columns'=>['id','claim_number','policy_id','user_id','claim_type','claim_date','description','status','admin_note','created_at','updated_at']];
        case 'receipts': return ['table'=>'receipts','columns'=>['id','receipt_number','policy_id','user_id','payment_method','amount','month_amount','card_last4','payer_email','payer_phone','status','admin_note','created_at','updated_at']];
        case 'responses': return ['table'=>'responses','columns'=>['id','type','status','user_id','name','email','phone','subject','message','quote_id','policy_id','claim_id','receipt_id','attachment_path','admin_note','created_at','updated_at']];
        default: throw new InvalidArgumentException('Unknown export type');
    }
}
