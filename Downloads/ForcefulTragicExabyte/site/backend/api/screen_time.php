<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

define('ST_FILE', __DIR__ . '/../database/users/screen_time.json');

function load_st() {
    if (!file_exists(ST_FILE)) return ['limits'=>[]];
    $data = json_decode(file_get_contents(ST_FILE), true);
    return $data ?: ['limits'=>[]];
}
function save_st($data) {
    file_put_contents(ST_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function ok_resp($d)        { echo json_encode(['ok'=>true,'data'=>$d],   JSON_UNESCAPED_UNICODE); exit; }
function err_resp($m,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

/* ── GET: return limits for a parent's children ── */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $parent_id = trim($_GET['parent_id'] ?? '');
    if (!$parent_id) err_resp('parent_id مطلوب', 400);

    // Load children to find the parent's kids
    $children_file = __DIR__ . '/../database/users/children.json';
    $children_db = file_exists($children_file)
        ? (json_decode(file_get_contents($children_file), true) ?: [])
        : [];
    $children_list = $children_db['children'] ?? [];

    $st = load_st();
    $result = [];
    foreach ($children_list as $c) {
        if ($c['parent_id'] === $parent_id) {
            $result[$c['id']] = [
                'child_id'     => $c['id'],
                'fname'        => $c['fname'],
                'daily_minutes'=> (int)($st['limits'][$c['id']] ?? 0),
                'enabled'      => isset($st['limits'][$c['id']]) && $st['limits'][$c['id']] > 0,
            ];
        }
    }
    ok_resp(['limits' => array_values($result)]);
}

/* ── POST: set limit for one child ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    if (!$body) err_resp('بيانات غير صالحة', 400);

    $child_id      = trim($body['child_id']      ?? '');
    $daily_minutes = (int)($body['daily_minutes'] ?? 0);
    $enabled       = (bool)($body['enabled']      ?? true);

    if (!$child_id) err_resp('child_id مطلوب');
    if ($daily_minutes < 0 || $daily_minutes > 1440) err_resp('المدة يجب أن تكون بين 0 و 1440 دقيقة');

    $st = load_st();
    if ($enabled && $daily_minutes > 0) {
        $st['limits'][$child_id] = $daily_minutes;
    } else {
        unset($st['limits'][$child_id]);
    }
    save_st($st);

    ok_resp(['child_id' => $child_id, 'daily_minutes' => $daily_minutes, 'enabled' => $enabled]);
}

err_resp('طريقة الطلب غير مدعومة', 405);
