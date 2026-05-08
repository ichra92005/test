<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok'=>false,'error'=>'Method not allowed']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) {
    echo json_encode(['ok'=>false, 'error'=>'بيانات غير صالحة']);
    exit;
}

/* ── list_parents action for admin panel ── */
if (($body['action'] ?? '') === 'list_parents') {
    $db_path = __DIR__ . '/../database/users/parents.json';
    $db = file_exists($db_path) ? (json_decode(file_get_contents($db_path), true) ?: []) : [];
    $parents = array_map(function($p) {
        return [
            'id'          => $p['id'],
            'fname'       => $p['fname'],
            'lname'       => $p['lname'],
            'email'       => $p['email'],
            'children_ids'=> $p['children_ids'] ?? [],
            'created_at'  => $p['created_at'] ?? '',
        ];
    }, $db['parents'] ?? []);
    echo json_encode(['ok'=>true,'data'=>['parents'=>$parents]], JSON_UNESCAPED_UNICODE);
    exit;
}

$type = $body['type'] ?? '';
$name = trim($body['name'] ?? '');
$email_username = trim($body['email_username'] ?? '');
$password = $body['password'] ?? '';

if (!$type || !$name || !$email_username || !$password) {
    echo json_encode(['ok'=>false, 'error'=>'جميع الحقول مطلوبة']);
    exit;
}

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

if ($type === 'parent') {
    $db_path = __DIR__ . '/../database/users/parents.json';
    $db = load_db($db_path);
    $parents = $db['parents'] ?? [];
    
    // Check if email exists
    foreach($parents as $p) {
        if ($p['email'] === $email_username) {
            echo json_encode(['ok'=>false, 'error'=>'البريد الإلكتروني مستخدم بالفعل']);
            exit;
        }
    }
    
    $existing_ids = array_column($parents, 'id');
    $id = gen_id($existing_ids);
    
    // split name
    $parts = explode(' ', $name, 2);
    $fname = $parts[0];
    $lname = $parts[1] ?? '';
    
    $parents[] = [
        'id' => $id,
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email_username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('c'),
        'children' => []
    ];
    $db['parents'] = $parents;
    save_db($db_path, $db);
    echo json_encode(['ok'=>true]);
    
} else if ($type === 'child') {
    $db_path = __DIR__ . '/../database/users/children.json';
    $db = load_db($db_path);
    $children = $db['children'] ?? [];
    
    // Check if username exists
    foreach($children as $c) {
        if ($c['username'] === $email_username) {
            echo json_encode(['ok'=>false, 'error'=>'اسم المستخدم مستخدم بالفعل']);
            exit;
        }
    }
    
    $existing_ids = array_column($children, 'id');
    $id = gen_id($existing_ids);
    
    $parts = explode(' ', $name, 2);
    $fname = $parts[0];
    $lname = $parts[1] ?? '';
    
    $children[] = [
        'id' => $id,
        'parent_id' => 'admin_created',
        'fname' => $fname,
        'lname' => $lname,
        'username' => $email_username,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Note: original system might use plain or different hash
        'age' => 8,
        'created_at' => date('c')
    ];
    $db['children'] = $children;
    save_db($db_path, $db);
    echo json_encode(['ok'=>true]);
} else {
    echo json_encode(['ok'=>false, 'error'=>'نوع حساب غير صالح']);
}
