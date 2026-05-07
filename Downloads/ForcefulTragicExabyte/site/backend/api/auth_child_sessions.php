<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$sessions_file  = __DIR__ . '/../database/users/child_sessions.json';
$children_file  = __DIR__ . '/../database/users/children.json';

function ok($d)  { echo json_encode(['ok'=>true,'data'=>$d], JSON_UNESCAPED_UNICODE); exit; }
function err($m) { echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

$parent_id = trim($_GET['parent_id'] ?? '');
if (!$parent_id) err('parent_id مطلوب');

/* جلب أطفال هذا الوالد */
$cdata = file_exists($children_file)
    ? (json_decode(file_get_contents($children_file), true) ?: [])
    : [];
$children_list = $cdata['children'] ?? [];
$parent_child_ids = array_map(
    fn($c) => $c['id'],
    array_filter($children_list, fn($c) => $c['parent_id'] === $parent_id)
);

/* جلب الجلسات المخزّنة */
$sdata = file_exists($sessions_file)
    ? (json_decode(file_get_contents($sessions_file), true) ?: ['sessions'=>[]])
    : ['sessions'=>[]];
$all_sessions = $sdata['sessions'] ?? [];

/* بناء خريطة child_id → آخر جلسة */
$session_map = [];
foreach ($all_sessions as $s) {
    if (in_array($s['child_id'], $parent_child_ids)) {
        $session_map[$s['child_id']] = $s;
    }
}

/* دمج بيانات الأطفال مع جلساتهم */
$result = [];
foreach ($children_list as $c) {
    if ($c['parent_id'] !== $parent_id) continue;
    $sess = $session_map[$c['id']] ?? null;

    /* "متصل الآن" إذا آخر دخول كان منذ أقل من 30 دقيقة */
    $online   = false;
    $last_login = null;
    if ($sess && !empty($sess['logged_at'])) {
        $last_login = $sess['logged_at'];
        $diff = time() - strtotime($last_login);
        $online = ($diff < 1800);
    }

    $result[] = [
        'child_id'   => $c['id'],
        'fname'      => $c['fname'],
        'lname'      => $c['lname'],
        'age'        => $c['age'],
        'username'   => $c['username'],
        'pin'        => $c['id'],
        'online'     => $online,
        'last_login' => $last_login,
    ];
}

/* الأطفال المتصلون أولاً */
usort($result, function($a, $b) {
    if ($a['online'] !== $b['online']) return $b['online'] <=> $a['online'];
    if ($a['last_login'] && $b['last_login']) return strcmp($b['last_login'], $a['last_login']);
    return 0;
});

ok(['children' => $result]);
