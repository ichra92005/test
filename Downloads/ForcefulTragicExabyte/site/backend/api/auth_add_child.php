<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok'=>false,'error'=>'Method not allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

define('DB_PARENTS',  __DIR__ . '/../database/users/parents.json');
define('DB_CHILDREN', __DIR__ . '/../database/users/children.json');

function load_db($path) {
    if (!file_exists($path)) return [];
    $data = json_decode(file_get_contents($path), true);
    return $data ?: [];
}
function save_db($path, $data) {
    file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
}
function gen_id() {
    return str_pad((string)random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
}
function ok_resp($d)       { echo json_encode(['ok'=>true,'data'=>$d],   JSON_UNESCAPED_UNICODE); exit; }
function err_resp($m,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) err_resp('بيانات غير صالحة', 400);

$parent_id = trim($body['parent_id'] ?? '');
$fname     = trim($body['fname']     ?? '');
$lname     = trim($body['lname']     ?? '');
$age       = (int)($body['age']      ?? 0);
$disease   = trim($body['disease']   ?? '');

if (!$parent_id) err_resp('parent_id مطلوب');
if (!$fname)     err_resp('اسم الطفل مطلوب');
if (!$lname)     err_resp('لقب الطفل مطلوب');
if ($age < 6 || $age > 18) err_resp('العمر يجب أن يكون بين 6 و18 سنة');

$parents_db  = load_db(DB_PARENTS);
$children_db = load_db(DB_CHILDREN);

$parents_list  = $parents_db['parents']   ?? [];
$children_list = $children_db['children'] ?? [];

$parent_idx = null;
foreach ($parents_list as $i => $p) {
    if ($p['id'] === $parent_id) { $parent_idx = $i; break; }
}
if ($parent_idx === null) err_resp('ولي الأمر غير موجود', 404);

/* توليد ID فريد */
$child_id = gen_id();
$existing_ids = array_column($children_list, 'id');
while (in_array($child_id, $existing_ids)) {
    $child_id = gen_id();
}

/* اسم المستخدم: fname (بدون مسافات) + آخر 4 أرقام من الـ id */
$username_base = preg_replace('/\s+/', '', $fname);
$username = $username_base . substr($child_id, -4);

/* بناء بيانات الطفل */
$child = [
    'id'         => $child_id,
    'parent_id'  => $parent_id,
    'fname'      => $fname,
    'lname'      => $lname,
    'age'        => $age,
    'username'   => $username,
    'created_at' => date('Y-m-d H:i:s'),
];
if ($disease !== '') {
    $child['disease'] = $disease;
}

$children_list[] = $child;
$children_db['children'] = $children_list;
save_db(DB_CHILDREN, $children_db);

/* تحديث قائمة أطفال ولي الأمر */
if (!isset($parents_list[$parent_idx]['children_ids'])) {
    $parents_list[$parent_idx]['children_ids'] = [];
}
$parents_list[$parent_idx]['children_ids'][] = $child_id;
$parents_db['parents'] = $parents_list;
save_db(DB_PARENTS, $parents_db);

ok_resp([
    'id'       => $child_id,
    'fname'    => $fname,
    'lname'    => $lname,
    'age'      => $age,
    'username' => $username,
    'password' => $child_id,
]);
