<?php
// Maqam PHP Router — built-in server entry point
require_once __DIR__ . '/dashboard/student/config/config.php';
require_once __DIR__ . '/dashboard/student/includes/functions.php';

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri  = rtrim($uri, '/') ?: '/';
$file = __DIR__ . $uri;

// ── Block sensitive paths ───────────────────────────────────────────────────
$blocked = ['/data/', '/composer.json', '/composer.lock', '/.env'];
foreach ($blocked as $b) {
    if (strpos($uri, $b) === 0 || $uri === $b) {
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden'], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ── API routes → api/*.php ──────────────────────────────────────────────────
if (strpos($uri, '/api/') === 0) {
    $endpoint = __DIR__ . '/api/' . basename($uri) . '.php';
    if (file_exists($endpoint)) {
        require $endpoint;
    } else {
        http_response_code(404);
        json_response(['error' => 'API endpoint not found'], 404);
    }
    exit;
}

// ── JSX files — force correct MIME type ────────────────────────────────────
if (str_ends_with($uri, '.jsx') && file_exists($file)) {
    header('Content-Type: application/javascript; charset=utf-8');
    readfile($file);
    exit;
}

// ── Static files — let PHP serve directly ──────────────────────────────────
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// ── Everything else → main router ──────────────────────────────────────────
require __DIR__ . '/server.php';
