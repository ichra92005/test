<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['ok'=>false,'error'=>'Method not allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

function ok($d)  { echo json_encode(['ok'=>true,'data'=>$d], JSON_UNESCAPED_UNICODE); exit; }
function err($m,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

$id = trim($_GET['id'] ?? '');
if (!$id) err('id مطلوب');

$db_path = __DIR__ . '/../database/users/children.json';
if (!file_exists($db_path)) err('قاعدة البيانات غير موجودة', 500);

$data     = json_decode(file_get_contents($db_path), true);
$children = $data['children'] ?? [];

$found = null;
foreach ($children as $c) {
    if ($c['id'] === $id) { $found = $c; break; }
}

if (!$found) err('الطالب غير موجود', 404);

/* أرجع البيانات الآمنة فقط */
ok([
    'id'         => $found['id'],
    'fname'      => $found['fname'],
    'lname'      => $found['lname'],
    'age'        => $found['age'],
    'username'   => $found['username'],
    'parent_id'  => $found['parent_id'],
    'created_at' => $found['created_at'] ?? '',
]);
