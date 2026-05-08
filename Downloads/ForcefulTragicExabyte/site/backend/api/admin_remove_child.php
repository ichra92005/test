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
function ok_resp($d)        { echo json_encode(['ok'=>true,'data'=>$d],   JSON_UNESCAPED_UNICODE); exit; }
function err_resp($m,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) err_resp('بيانات غير صالحة', 400);

$child_id = trim($body['child_id'] ?? '');
if (!$child_id) err_resp('child_id مطلوب');

$parents_db  = load_db(DB_PARENTS);
$children_db = load_db(DB_CHILDREN);

$parents_list  = $parents_db['parents']   ?? [];
$children_list = $children_db['children'] ?? [];

$found = false;
$parent_id = null;
foreach ($children_list as $c) {
    if ($c['id'] === $child_id) { $found = true; $parent_id = $c['parent_id']; break; }
}
if (!$found) err_resp('الطفل غير موجود', 404);

// Remove child from children list
$children_db['children'] = array_values(array_filter($children_list, function($c) use ($child_id) {
    return $c['id'] !== $child_id;
}));
save_db(DB_CHILDREN, $children_db);

// Remove child_id from parent's children_ids
foreach ($parents_list as &$p) {
    if ($p['id'] === $parent_id && isset($p['children_ids'])) {
        $p['children_ids'] = array_values(array_filter($p['children_ids'], function($id) use ($child_id) {
            return $id !== $child_id;
        }));
    }
}
unset($p);
$parents_db['parents'] = $parents_list;
save_db(DB_PARENTS, $parents_db);

// Also clean up screen_time.json if exists
$st_file = __DIR__ . '/../database/users/screen_time.json';
if (file_exists($st_file)) {
    $st = json_decode(file_get_contents($st_file), true) ?: ['limits'=>[]];
    unset($st['limits'][$child_id]);
    file_put_contents($st_file, json_encode($st, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

ok_resp(['removed' => $child_id]);
