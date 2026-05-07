<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$DB_Q = __DIR__ . '/../database/map_questions.json';
$DB_P = __DIR__ . '/../database/map_progress.json';

function load_json($path) {
    if (!file_exists($path)) return null;
    $raw = file_get_contents($path);
    return json_decode($raw, true);
}
function save_json($path, $data) {
    file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
function ok($data)  { echo json_encode(['ok'=>true,  'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function err($msg)  { http_response_code(400); echo json_encode(['ok'=>false,'error'=>$msg], JSON_UNESCAPED_UNICODE); exit; }

$action     = $_GET['action'] ?? ($_POST['action'] ?? '');
$student_id = $_GET['student_id'] ?? 'default';

/* ─────────────────────────────────────────
   GET questions
   GET /api/map_game?action=questions&region=1&game=quiz
───────────────────────────────────────── */
if ($action === 'questions') {
    $region = $_GET['region'] ?? '';
    $game   = $_GET['game']   ?? '';
    if (!$region || !$game) err('region and game required');

    $db = load_json($DB_Q);
    if (!$db) err('Questions database not found');
    if (!isset($db['regions'][$region])) err('Region not found');
    if (!isset($db['regions'][$region][$game])) err('Game not found');

    $questions = $db['regions'][$region][$game];
    if (empty($questions)) err('No questions for this region/game yet');

    /* Shuffle for quiz and tf */
    if (in_array($game, ['quiz','tf'])) shuffle($questions);

    ok(['questions' => $questions, 'region' => $db['regions'][$region]['name']]);
}

/* ─────────────────────────────────────────
   POST submit score
   POST /api/map_game?action=submit
   Body: { region, game, score, total }
───────────────────────────────────────── */
if ($action === 'submit') {
    $body   = json_decode(file_get_contents('php://input'), true) ?? [];
    $region = $body['region'] ?? '';
    $game   = $body['game']   ?? '';
    $score  = (int)($body['score'] ?? 0);
    $total  = (int)($body['total'] ?? 0);
    $sid    = $body['student_id'] ?? 'default';

    if (!$region || !$game) err('region and game required');

    $xp_map = ['quiz'=>50,'tf'=>40,'fill'=>45,'memory'=>60];
    $base_xp = $xp_map[$game] ?? 40;
    $pct     = $total > 0 ? $score/$total : 0;
    $xp      = (int)round($base_xp * $pct);

    $db = load_json($DB_P) ?? ['students'=>[]];
    if (!isset($db['students'][$sid])) {
        $db['students'][$sid] = [
            'name'=>'طالب','total_xp'=>0,
            'regions'=>['1'=>['unlocked'=>true,'quiz'=>['completed'=>false,'score'=>0,'total'=>0,'xp'=>0],'tf'=>['completed'=>false,'score'=>0,'total'=>0,'xp'=>0],'fill'=>['completed'=>false,'score'=>0,'total'=>0,'xp'=>0],'memory'=>['completed'=>false,'score'=>0,'total'=>0,'xp'=>0]]]
        ];
    }

    $prev_xp = $db['students'][$sid]['regions'][$region][$game]['xp'] ?? 0;
    $new_xp  = max($prev_xp, $xp); /* keep best */

    $db['students'][$sid]['regions'][$region][$game] = [
        'completed' => $score >= $total * 0.5,
        'score'     => $score,
        'total'     => $total,
        'xp'        => $new_xp,
        'best_score'=> max($score, $db['students'][$sid]['regions'][$region][$game]['score'] ?? 0),
        'attempts'  => ($db['students'][$sid]['regions'][$region][$game]['attempts'] ?? 0) + 1,
        'last_at'   => date('Y-m-d H:i:s'),
    ];

    /* Recalculate total XP */
    $total_xp = 0;
    foreach ($db['students'][$sid]['regions'] as $rk => $rv) {
        foreach (['quiz','tf','fill','memory'] as $gk) {
            $total_xp += ($rv[$gk]['xp'] ?? 0);
        }
    }
    $db['students'][$sid]['total_xp'] = $total_xp;

    save_json($DB_P, $db);
    ok(['xp_earned'=>$xp, 'total_xp'=>$total_xp, 'completed'=>$score >= $total * 0.5]);
}

/* ─────────────────────────────────────────
   GET progress
   GET /api/map_game?action=progress&student_id=default
───────────────────────────────────────── */
if ($action === 'progress') {
    $db = load_json($DB_P);
    if (!$db) ok(['regions'=>[],'total_xp'=>0]);
    $student = $db['students'][$student_id] ?? $db['students']['default'] ?? null;
    if (!$student) ok(['regions'=>[],'total_xp'=>0]);
    ok($student);
}

err('Unknown action');
