<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'GET')  { http_response_code(405); echo json_encode(['ok'=>false,'error'=>'Method not allowed']); exit; }

define('DB_CHILDREN', __DIR__ . '/../database/users/children.json');

function load_db($path) {
    if (!file_exists($path)) return [];
    $data = json_decode(file_get_contents($path), true);
    return $data ?: [];
}
function ok($data)       { echo json_encode(['ok'=>true,'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function err($msg,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

$parent_id = trim($_GET['parent_id'] ?? '');
if (!$parent_id) err('parent_id مطلوب');

$db       = load_db(DB_CHILDREN);
$all      = $db['children'] ?? [];
$children = array_values(array_filter($all, fn($c) => $c['parent_id'] === $parent_id));

/* Load screen time limits */
$st_file = __DIR__ . '/../database/users/screen_time.json';
$st_data = file_exists($st_file) ? (json_decode(file_get_contents($st_file), true) ?: ['limits'=>[]]) : ['limits'=>[]];
$st_limits = $st_data['limits'] ?? [];

$result = array_map(fn($c) => [
    'id'                  => $c['id'],
    'fname'               => $c['fname'],
    'lname'               => $c['lname'],
    'age'                 => $c['age'],
    'gender'              => $c['gender'] ?? 'boy',
    'username'            => $c['username'],
    'password'            => $c['id'],
    'disease'             => $c['disease'] ?? '',
    'created_at'          => $c['created_at'] ?? '',
    'screen_time_minutes' => (int)($st_limits[$c['id']] ?? 0),
], $children);

ok(['children' => $result]);
