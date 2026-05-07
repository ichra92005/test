<?php
/**
 * API: /api/auth_stats
 * GET ?parent_id=xxx
 * يُرجع إحصائيات كاملة لجميع أطفال ولي الأمر
 */

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

define('DB_CHILDREN', __DIR__ . '/../database/users/children.json');
define('DB_PROGRESS', __DIR__ . '/../database/users/progress.json');

function stats_load($path) {
    if (!file_exists($path)) return [];
    $d = json_decode(file_get_contents($path), true);
    return $d ?: [];
}
function stats_ok($data)        { echo json_encode(['ok'=>true,'data'=>$data], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); exit; }
function stats_err($msg,$c=400) { http_response_code($c); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

$parent_id = trim($_GET['parent_id'] ?? '');
if (!$parent_id) stats_err('parent_id مطلوب');

/* ── جلب الأطفال ── */
$children_db  = stats_load(DB_CHILDREN);
$all_children = $children_db['children'] ?? [];
$children = array_values(array_filter($all_children, fn($c) => ($c['parent_id'] ?? '') === $parent_id));

if (!count($children)) {
    stats_ok(['children'=>[], 'totals'=>['children'=>0,'done_lessons'=>0,'avg_progress'=>0,'total_badges'=>0,'max_streak'=>0]]);
}

/* ── جلب بيانات التقدم ── */
$progress_db  = stats_load(DB_PROGRESS);
$all_progress = $progress_db['progress'] ?? [];

/* ── تعريف المواد الدراسية ── */
$subjects_config = [
    ['id'=>'math',    'name'=>'الرياضيات',        'icon'=>'bi-calculator-fill', 'color'=>'#4F46E5', 'total'=>8],
    ['id'=>'arabic',  'name'=>'اللغة العربية',    'icon'=>'bi-book-fill',       'color'=>'#006233', 'total'=>8],
    ['id'=>'science', 'name'=>'العلوم',            'icon'=>'bi-flask-fill',      'color'=>'#8B5CF6', 'total'=>8],
    ['id'=>'history', 'name'=>'التاريخ الجزائري', 'icon'=>'bi-flag-fill',       'color'=>'#E8B830', 'total'=>8],
    ['id'=>'french',  'name'=>'اللغة الفرنسية',   'icon'=>'bi-translate',       'color'=>'#2563EB', 'total'=>8],
    ['id'=>'art',     'name'=>'التربية الفنية',    'icon'=>'bi-palette-fill',    'color'=>'#DB2777', 'total'=>8],
];

$child_colors = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];

$result = [];
foreach ($children as $idx => $child) {
    $cid  = $child['id'];
    $prog = $all_progress[$cid] ?? [];

    /* ── معالجة المواد ── */
    $subjects_raw  = $prog['subjects'] ?? [];
    $subjects_data = [];
    $total_done    = 0;
    $total_lessons = 0;

    foreach ($subjects_config as $subj) {
        $found = array_values(array_filter($subjects_raw, fn($s) => ($s['id'] ?? '') === $subj['id']));
        $done  = (int)($found[0]['done'] ?? 0);
        $done  = min($done, $subj['total']); // لا يتجاوز الحد

        $subjects_data[] = [
            'id'    => $subj['id'],
            'name'  => $subj['name'],
            'icon'  => $subj['icon'],
            'color' => $subj['color'],
            'done'  => $done,
            'total' => $subj['total'],
            'pct'   => $subj['total'] > 0 ? round($done/$subj['total']*100) : 0,
        ];
        $total_done    += $done;
        $total_lessons += $subj['total'];
    }

    $progress_pct = $total_lessons > 0 ? round($total_done / $total_lessons * 100) : 0;

    /* ── الشارات ── */
    $badges = $prog['badges'] ?? [];
    if (!in_array('🌱',$badges))               $badges[] = '🌱'; // كل طفل مسجل
    if ($total_done >= 10 && !in_array('⭐',$badges)) $badges[] = '⭐';
    if ($total_done >= 20 && !in_array('🏅',$badges)) $badges[] = '🏅';
    if ($total_done >= 50 && !in_array('🏆',$badges)) $badges[] = '🏆';

    /* ── المستوى ── */
    $level_badge = '🌱'; $level = 'مبتدئ';
    if ($total_done >= 50) { $level_badge = '🏆'; $level = 'بطل الجزائر'; }
    elseif ($total_done >= 20) { $level_badge = '🏅'; $level = 'متعلم مثابر'; }
    elseif ($total_done >= 10) { $level_badge = '⭐'; $level = 'نجم صاعد'; }

    /* ── وقت التعلم والنشاط ── */
    $streak          = (int)($prog['streak'] ?? 0);
    $weekly_minutes  = $prog['weekly_minutes'] ?? [0,0,0,0,0,0,0];
    // ضمان 7 قيم
    while (count($weekly_minutes) < 7) $weekly_minutes[] = 0;
    $weekly_minutes  = array_slice($weekly_minutes, 0, 7);

    $time_today      = (int)($prog['time_today_minutes'] ?? 0);
    $time_week       = array_sum($weekly_minutes);
    $last_activity   = $prog['last_activity'] ?? null;

    /* ── النشاطات الأخيرة ── */
    $activities = $prog['activities'] ?? [];

    /* ── سلسلة الأيام (بيانات الـ 28 يوم) ── */
    $streak_days = $prog['streak_days'] ?? []; // مصفوفة ['YYYY-MM-DD'=>true/false]

    $result[] = [
        'id'               => $cid,
        'fname'            => $child['fname'],
        'lname'            => $child['lname'],
        'age'              => (int)$child['age'],
        'username'         => $child['username'],
        'created_at'       => $child['created_at'] ?? '',
        'color'            => $child_colors[$idx % count($child_colors)],
        'progress_pct'     => $progress_pct,
        'done_lessons'     => $total_done,
        'total_lessons'    => $total_lessons,
        'streak'           => $streak,
        'badges'           => array_values($badges),
        'level'            => $level,
        'level_badge'      => $level_badge,
        'weekly_minutes'   => array_values($weekly_minutes),
        'subjects'         => $subjects_data,
        'time_today_min'   => $time_today,
        'time_week_min'    => $time_week,
        'last_activity'    => $last_activity,
        'activities'       => $activities,
        'streak_days'      => $streak_days,
        'status'           => $prog['status'] ?? 'offline',
    ];
}

/* ── الإجماليات ── */
$totals = [
    'children'      => count($result),
    'done_lessons'  => array_sum(array_column($result,'done_lessons')),
    'avg_progress'  => count($result) ? round(array_sum(array_column($result,'progress_pct'))/count($result)) : 0,
    'total_badges'  => array_sum(array_map(fn($c) => count($c['badges']), $result)),
    'max_streak'    => count($result) ? max(array_column($result,'streak')) : 0,
    'time_week'     => array_sum(array_column($result,'time_week_min')),
];

stats_ok(['children'=>$result,'totals'=>$totals]);
