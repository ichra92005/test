<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

define('DB_PENDING', __DIR__ . '/../database/users/pending_logins.json');

function load_db($path) {
    if (!file_exists($path)) return [];
    $data = json_decode(file_get_contents($path), true);
    return $data ?: [];
}
function save_db($path, $data) {
    file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
function ok($data)  { echo json_encode(['ok'=>true,  'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function err($msg, $code=400) { http_response_code($code); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

function gen_token() {
    return bin2hex(random_bytes(16));
}

function clean_expired(&$requests) {
    $now = time();
    $requests = array_values(array_filter($requests, function($r) use ($now) {
        return strtotime($r['expires_at']) > $now;
    }));
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? ($_POST['action'] ?? '');

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
    $action = $body['action'] ?? $action;
}

/* ─────────────────────────────────
   POST action=create
   الطفل يُنشئ طلب دخول معلّق
───────────────────────────────── */
if ($action === 'create' && $method === 'POST') {
    $child_id    = $body['child_id']    ?? '';
    $parent_id   = $body['parent_id']   ?? '';
    $child_fname = $body['child_fname'] ?? '';
    $child_lname = $body['child_lname'] ?? '';
    $child_age   = $body['child_age']   ?? '';
    $username    = $body['username']    ?? '';

    if (!$child_id || !$parent_id) err('بيانات ناقصة');

    $db = load_db(DB_PENDING);
    $requests = $db['requests'] ?? [];
    clean_expired($requests);

    foreach ($requests as $r) {
        if ($r['child_id'] === $child_id && $r['status'] === 'pending') {
            ok(['token' => $r['token'], 'existing' => true]);
        }
    }

    $token = gen_token();
    $requests[] = [
        'token'       => $token,
        'child_id'    => $child_id,
        'parent_id'   => $parent_id,
        'child_fname' => $child_fname,
        'child_lname' => $child_lname,
        'child_age'   => $child_age,
        'username'    => $username,
        'status'      => 'pending',
        'created_at'  => date('Y-m-d H:i:s'),
        'expires_at'  => date('Y-m-d H:i:s', time() + 300),
    ];

    save_db(DB_PENDING, ['requests' => $requests]);
    ok(['token' => $token]);
}

/* ─────────────────────────────────
   GET action=list&parent_id=xxx
   ولي الأمر يجلب طلبات أطفاله
───────────────────────────────── */
if ($action === 'list' && $method === 'GET') {
    $parent_id = $_GET['parent_id'] ?? '';
    if (!$parent_id) err('parent_id مطلوب');

    $db = load_db(DB_PENDING);
    $requests = $db['requests'] ?? [];
    clean_expired($requests);
    save_db(DB_PENDING, ['requests' => $requests]);

    $pending = array_values(array_filter($requests, function($r) use ($parent_id) {
        return $r['parent_id'] === $parent_id && $r['status'] === 'pending';
    }));

    ok(['requests' => $pending, 'count' => count($pending)]);
}

/* ─────────────────────────────────
   POST action=decide
   ولي الأمر يقبل أو يرفض الطلب
───────────────────────────────── */
if ($action === 'decide' && $method === 'POST') {
    $token     = $body['token']     ?? '';
    $decision  = $body['decision']  ?? '';
    $parent_id = $body['parent_id'] ?? '';

    if (!$token || !in_array($decision, ['approved','rejected'])) err('بيانات ناقصة');

    $db = load_db(DB_PENDING);
    $requests = $db['requests'] ?? [];
    clean_expired($requests);

    $found = false;
    foreach ($requests as &$r) {
        if ($r['token'] === $token && (!$parent_id || $r['parent_id'] === $parent_id)) {
            $r['status']     = $decision;
            $r['decided_at'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    unset($r);

    if (!$found) err('الطلب غير موجود أو منتهي الصلاحية');

    save_db(DB_PENDING, ['requests' => $requests]);
    ok(['decision' => $decision]);
}

/* ─────────────────────────────────
   GET action=check&token=xxx
   الطفل يفحص حالة طلبه
───────────────────────────────── */
if ($action === 'check' && $method === 'GET') {
    $token = $_GET['token'] ?? '';
    if (!$token) err('token مطلوب');

    $db = load_db(DB_PENDING);
    $requests = $db['requests'] ?? [];

    $found = null;
    foreach ($requests as $r) {
        if ($r['token'] === $token) { $found = $r; break; }
    }

    if (!$found) err('الطلب غير موجود أو منتهي الصلاحية', 404);

    ok(['status' => $found['status']]);
}

err('الإجراء غير معروف');
