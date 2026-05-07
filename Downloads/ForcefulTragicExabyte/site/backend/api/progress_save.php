<?php
/**
 * POST /api/progress_save
 * يحفظ تقدم الطفل بعد إتمام لعبة أو نشاط
 * Body JSON: { child_id, subject, score, region_id?, level_done? }
 */
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

function pok($d)  { echo json_encode(['ok'=>true,'data'=>$d], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); exit; }
function perr($m,$c=400){ http_response_code($c); echo json_encode(['ok'=>false,'error'=>$m], JSON_UNESCAPED_UNICODE); exit; }

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) perr('JSON مطلوب');

$child_id   = trim($body['child_id']   ?? '');
$subject    = trim($body['subject']    ?? 'history');
$score      = max(0, (int)($body['score']      ?? 0));
$region_id  = trim($body['region_id']  ?? '');
$level_done = max(0, (int)($body['level_done'] ?? 0));

if (!$child_id) perr('child_id مطلوب');

$DB = __DIR__ . '/../database/users/progress.json';

$data = [];
if (file_exists($DB)) {
    $raw = file_get_contents($DB);
    $data = json_decode($raw, true) ?: [];
}
if (!isset($data['progress'])) $data['progress'] = [];

if (!isset($data['progress'][$child_id])) {
    $data['progress'][$child_id] = [
        'done_lessons'       => 0,
        'streak'             => 0,
        'status'             => 'online',
        'last_activity'      => date('Y-m-d H:i:s'),
        'time_today_minutes' => 0,
        'weekly_minutes'     => [0,0,0,0,0,0,0],
        'badges'             => ['🌱'],
        'subjects'           => [],
        'activities'         => [],
        'streak_days'        => [],
        'total_points'       => 0,
    ];
}

$p = &$data['progress'][$child_id];

$p['total_points']  = ($p['total_points'] ?? 0) + $score;
$p['status']        = 'online';
$p['last_activity'] = date('Y-m-d H:i:s');

/* ── تحديث المادة ── */
if ($subject) {
    $subjects = $p['subjects'] ?? [];
    $found    = false;
    foreach ($subjects as &$s) {
        if ($s['id'] === $subject) {
            $s['done'] = min(8, ($s['done'] ?? 0) + 1);
            $found = true;
            break;
        }
    }
    unset($s);
    if (!$found) $subjects[] = ['id' => $subject, 'done' => 1];
    $p['subjects'] = $subjects;
}

/* ── إجمالي الدروس ── */
$caps = ['math'=>8,'arabic'=>8,'science'=>8,'history'=>8,'french'=>8,'art'=>8];
$total_done = 0;
foreach ($p['subjects'] as $s) {
    $total_done += min($s['done'] ?? 0, $caps[$s['id']] ?? 8);
}
$p['done_lessons'] = $total_done;

/* ── سلسلة الأيام ── */
$today      = date('Y-m-d');
$yesterday  = date('Y-m-d', strtotime('-1 day'));
$sd         = $p['streak_days'] ?? [];
if (empty($sd[$today])) {
    $sd[$today]   = true;
    $p['streak']  = !empty($sd[$yesterday]) ? ($p['streak'] ?? 0) + 1 : 1;
}
$p['streak_days'] = $sd;

/* ── وقت أسبوعي ── */
$weekly = $p['weekly_minutes'] ?? [0,0,0,0,0,0,0];
while (count($weekly) < 7) $weekly[] = 0;
$dow = (int)date('N') - 1;
$weekly[$dow] = ($weekly[$dow] ?? 0) + 5;
$p['weekly_minutes'] = array_slice($weekly, 0, 7);

/* ── سجل النشاط ── */
$actTitle = $region_id
    ? "أكمل مستوى {$level_done} في منطقة {$region_id}"
    : "أكمل نشاط {$subject}";
$acts = $p['activities'] ?? [];
array_unshift($acts, [
    'icon'  => 'bi-check-circle-fill',
    'bg'    => '#E8F5EE',
    'ic'    => '#2D7A45',
    'title' => $actTitle,
    'time'  => 'الآن',
]);
$p['activities'] = array_slice($acts, 0, 10);

/* ── الشارات ── */
$badges = $p['badges'] ?? ['🌱'];
if (!in_array('🌱',$badges))                    $badges[] = '🌱';
if ($total_done >= 10 && !in_array('⭐',$badges)) $badges[] = '⭐';
if ($total_done >= 20 && !in_array('🏅',$badges)) $badges[] = '🏅';
if ($total_done >= 50 && !in_array('🏆',$badges)) $badges[] = '🏆';
$p['badges'] = array_values($badges);

/* ── المستوى ── */
$level_badge = '🌱'; $level = 'مبتدئ';
if ($total_done >= 50) { $level_badge = '🏆'; $level = 'بطل الجزائر'; }
elseif ($total_done >= 20) { $level_badge = '🏅'; $level = 'متعلم مثابر'; }
elseif ($total_done >= 10) { $level_badge = '⭐'; $level = 'نجم صاعد'; }

/* ── حفظ ── */
if (file_put_contents($DB, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) === false) {
    perr('فشل في حفظ البيانات', 500);
}

pok([
    'total_points' => $p['total_points'],
    'done_lessons' => $p['done_lessons'],
    'streak'       => $p['streak'],
    'level'        => $level,
    'level_badge'  => $level_badge,
    'badges'       => $p['badges'],
]);
