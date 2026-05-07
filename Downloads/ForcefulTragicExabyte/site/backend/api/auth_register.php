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

function save_db($path, $data) {
    $dir = dirname($path);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function gen_id($existing_ids) {
    do {
        $id = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
    } while (in_array($id, $existing_ids));
    return $id;
}

function ok($data)  { echo json_encode(['ok'=>true, 'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function err($msg, $code=400) { http_response_code($code); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) err('بيانات غير صالحة');

$p_fname    = trim($body['p_fname']    ?? '');
$p_lname    = trim($body['p_lname']    ?? '');
$p_email    = trim($body['p_email']    ?? '');
$p_password = $body['p_password']      ?? '';
$k_fname    = trim($body['k_fname']    ?? '');
$k_lname    = trim($body['k_lname']    ?? '');
$k_age      = intval($body['k_age']    ?? 0);
$k_gender   = in_array($body['k_gender'] ?? '', ['boy','girl']) ? $body['k_gender'] : 'boy';
$k_needs    = (bool)($body['k_needs']  ?? false);
$k_disease  = trim($body['k_disease']  ?? '');

if (!$p_fname || !$p_lname || !$p_email || !$p_password || !$k_fname || !$k_lname || !$k_age)
    err('جميع الحقول الأساسية مطلوبة');

if (!filter_var($p_email, FILTER_VALIDATE_EMAIL))
    err('البريد الإلكتروني غير صحيح');

if (strlen($p_password) < 8)
    err('كلمة المرور يجب أن تكون 8 أحرف على الأقل');

if ($k_age < 6 || $k_age > 18)
    err('عمر الطفل يجب أن يكون بين 6 و 18 سنة');

$parents_db  = load_db(DB_PARENTS);
$children_db = load_db(DB_CHILDREN);

$parents_list  = $parents_db['parents']   ?? [];
$children_list = $children_db['children'] ?? [];

foreach ($parents_list as $p) {
    if (strtolower($p['email']) === strtolower($p_email))
        err('هذا البريد الإلكتروني مسجّل مسبقاً');
}

$existing_parent_ids  = array_column($parents_list, 'id');
$existing_child_ids   = array_column($children_list, 'id');

$parent_id = gen_id($existing_parent_ids);
$child_id  = gen_id(array_merge($existing_parent_ids, $existing_child_ids, [$parent_id]));

$hashed_password = password_hash($p_password, PASSWORD_DEFAULT);

$new_parent = [
    'id'          => $parent_id,
    'fname'       => $p_fname,
    'lname'       => $p_lname,
    'email'       => strtolower($p_email),
    'password'    => $hashed_password,
    'children_ids'=> [$child_id],
    'created_at'  => date('Y-m-d H:i:s'),
];

$new_child = [
    'id'           => $child_id,
    'parent_id'    => $parent_id,
    'fname'        => $k_fname,
    'lname'        => $k_lname,
    'age'          => $k_age,
    'gender'       => $k_gender,
    'special_needs'=> $k_needs,
    'disease'      => $k_disease,
    'username'     => $k_fname . $child_id,
    'created_at'   => date('Y-m-d H:i:s'),
];

$parents_list[]  = $new_parent;
$children_list[] = $new_child;

save_db(DB_PARENTS,  ['parents'  => $parents_list]);
save_db(DB_CHILDREN, ['children' => $children_list]);

ok([
    'parent_id'  => $parent_id,
    'child_id'   => $child_id,
    'child_username' => $new_child['username'],
    'parent_name'=> $p_fname . ' ' . $p_lname,
    'child_name' => $k_fname . ' ' . $k_lname,
    'child_age'  => $k_age,
    'email'      => strtolower($p_email),
]);
