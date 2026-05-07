<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['ok'=>false,'error'=>'Method not allowed']); exit; }

define('DB_PARENTS',  __DIR__ . '/../database/users/parents.json');
define('DB_CHILDREN', __DIR__ . '/../database/users/children.json');

function load_db($path) {
    if (!file_exists($path)) return [];
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    return $data ?: [];
}

function ok($data)  { echo json_encode(['ok'=>true, 'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function err($msg, $code=200) { http_response_code($code); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) err('بيانات غير صالحة', 400);

$type     = $body['type']     ?? '';
$login    = trim($body['login']    ?? '');
$password = $body['password'] ?? '';

if (!$type || !$login || !$password)
    err('جميع الحقول مطلوبة', 400);

$parents_db  = load_db(DB_PARENTS);
$children_db = load_db(DB_CHILDREN);

$parents_list  = $parents_db['parents']   ?? [];
$children_list = $children_db['children'] ?? [];

/* ─── ADMIN LOGIN ─── */
if ($type === 'parent' && $login === 'admin@admin' && $password === 'admin@admin') {
    ok([
        'type'  => 'admin',
        'id'    => 'admin',
        'fname' => 'مدير',
        'lname' => 'النظام',
        'email' => 'admin@admin'
    ]);
}

/* ─── PARENT LOGIN ─── */
if ($type === 'parent') {
    $found = null;
    foreach ($parents_list as $p) {
        $match_email    = strtolower($p['email']) === strtolower($login);
        $match_id       = $p['id'] === $login;
        if ($match_email || $match_id) {
            $found = $p;
            break;
        }
    }
    if (!$found) err('البريد الإلكتروني أو كلمة المرور غير صحيحة');
    if (!password_verify($password, $found['password'])) err('البريد الإلكتروني أو كلمة المرور غير صحيحة');

    $children_of_parent = array_values(array_filter($children_list, function($c) use ($found) {
        return $c['parent_id'] === $found['id'];
    }));

    ok([
        'type'      => 'parent',
        'id'        => $found['id'],
        'fname'     => $found['fname'],
        'lname'     => $found['lname'],
        'email'     => $found['email'],
        'children'  => array_map(function($c){
            return ['id'=>$c['id'],'fname'=>$c['fname'],'lname'=>$c['lname'],'age'=>$c['age'],'username'=>$c['username']];
        }, $children_of_parent),
    ]);
}

/* ─── CHILD LOGIN ─── */
if ($type === 'child') {
    $found = null;
    foreach ($children_list as $c) {
        $match_username = $c['username'] === $login;
        $match_id       = $c['id']       === $login;
        if ($match_username || $match_id) {
            $found = $c;
            break;
        }
    }
    if (!$found) err('اسم المستخدم أو كلمة السر غير صحيحة');

    if ($password !== $found['id'])
        err('اسم المستخدم أو كلمة السر غير صحيحة');

    $parent = null;
    foreach ($parents_list as $p) {
        if ($p['id'] === $found['parent_id']) { $parent = $p; break; }
    }

    /* ── تسجيل جلسة دخول الطفل ── */
    $sessions_file = __DIR__ . '/../database/users/child_sessions.json';
    $sdata = file_exists($sessions_file)
        ? (json_decode(file_get_contents($sessions_file), true) ?: ['sessions' => []])
        : ['sessions' => []];
    $now = date('Y-m-d H:i:s');
    $updated = false;
    foreach ($sdata['sessions'] as &$s) {
        if ($s['child_id'] === $found['id']) {
            $s['logged_at']   = $now;
            $s['parent_id']   = $found['parent_id'];
            $s['child_fname'] = $found['fname'];
            $s['child_lname'] = $found['lname'];
            $updated = true;
            break;
        }
    }
    unset($s);
    if (!$updated) {
        $sdata['sessions'][] = [
            'child_id'    => $found['id'],
            'parent_id'   => $found['parent_id'],
            'child_fname' => $found['fname'],
            'child_lname' => $found['lname'],
            'logged_at'   => $now,
        ];
    }
    file_put_contents($sessions_file, json_encode($sdata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    ok([
        'type'       => 'child',
        'id'         => $found['id'],
        'fname'      => $found['fname'],
        'lname'      => $found['lname'],
        'age'        => $found['age'],
        'gender'     => $found['gender'] ?? 'boy',
        'username'   => $found['username'],
        'parent_id'  => $found['parent_id'],
        'parent_name'=> $parent ? ($parent['fname'].' '.$parent['lname']) : '',
    ]);
}

err('نوع تسجيل الدخول غير معروف', 400);
