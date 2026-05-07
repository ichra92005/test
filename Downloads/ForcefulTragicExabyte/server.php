<?php
/**
 * منصة زاد الكشفية للقرآن — الراوتر الرئيسي
 * يُستخدم مع خادم PHP المدمج (php -S) ومع أبتشي/إنجن إكس عبر الـ rewrite.
 */

// تخزين مؤقت للإخراج لمنع مشاكل الترويسات
ob_start();

// استخراج المسار من الـ URL
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// === 1) خدمة الملفات الثابتة (CSS, JS, صور...) مباشرةً ===
$requestedFile = __DIR__ . $uri;
if ($uri !== '/' && file_exists($requestedFile) && is_file($requestedFile)) {
    // عند تشغيل php -S أرجع false ليتولى الخادم تقديم الملف بنفسه
    if (php_sapi_name() === 'cli-server') {
        return false;
    }
    // في حالة عدم وجود الخادم المدمج، نرسل الملف يدوياً
    $mime = mime_content_type($requestedFile) ?: 'application/octet-stream';
    if (preg_match('/\.css$/', $requestedFile)) $mime = 'text/css';
    if (preg_match('/\.js$/', $requestedFile)) $mime = 'application/javascript';
    if (preg_match('/\.jsx$/', $requestedFile)) $mime = 'text/jsx';
    header('Content-Type: ' . $mime);
    readfile($requestedFile);
    exit;
} else if ($uri !== '/') {
    // Fallback: check if the file exists in dashboard/student/ (for maqam 2 assets)
    $studentFile = __DIR__ . '/dashboard/student' . $uri;
    if (file_exists($studentFile) && is_file($studentFile)) {
        $mime = mime_content_type($studentFile) ?: 'application/octet-stream';
        if (preg_match('/\.css$/', $studentFile)) $mime = 'text/css';
        if (preg_match('/\.js$/', $studentFile)) $mime = 'application/javascript';
        if (preg_match('/\.jsx$/', $studentFile)) $mime = 'text/jsx';
        header('Content-Type: ' . $mime);
        readfile($studentFile);
        exit;
    }
}

// === 1.4) خريطة الموقع الديناميكية ===
if (in_array($uri, ['/sitemap.xml', '/sitemap.php'], true)) {
    require_once __DIR__ . '/sitemap.php';
    ob_end_flush();
    exit;
}

// === 1.5) تتبّع الزيارات — جميع الصفحات العامة (ليس API/إدارة/أصول) ===
// ملاحظة: على InfinityFree يُعالج التتبع من config.php مباشرةً لأن Apache قد يتجاوز هذا الراوتر.
// نضع العلم ZAD_VISIT_TRACKED أولاً حتى لا يحسب config.php الزيارة مرتين في البيئة المحلية.
{
    $trackUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $skipTrack = preg_match('#^/(admin|api|dashboard|site|sitemap)(/|$)#i', $trackUri)
              || preg_match('#\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|map|json|txt|xml|php)$#i', $trackUri);
    if (!$skipTrack && !defined('ZAD_VISIT_TRACKED') && file_exists(__DIR__ . '/site/backend/api/_helpers.php')) {
        define('ZAD_VISIT_TRACKED', true);
        require_once __DIR__ . '/site/backend/api/_helpers.php';
        $canonPath = $trackUri;
        if (in_array($canonPath, ['/index', '/index.php'], true)) $canonPath = '/';
        if ($canonPath !== '/' && substr($canonPath, -1) === '/') $canonPath = rtrim($canonPath, '/');
        @zad_track_visit($canonPath);
    }
}

// === 2) جدول التوجيه (Routing Table) ===
$routes = [
    '/'            => __DIR__ . '/index.php',
    '/index'       => __DIR__ . '/index.php',
    '/index.php'   => __DIR__ . '/index.php',
    '/about'       => __DIR__ . '/about/index.php',
    '/program'     => __DIR__ . '/program/index.php',
    '/programs'    => __DIR__ . '/program/index.php',
    '/help'        => __DIR__ . '/help/index.php',
    '/support'     => __DIR__ . '/help/index.php',
    '/privacy'     => __DIR__ . '/privacy/index.php',
    '/privacy-policy' => __DIR__ . '/privacy/index.php',
    '/terms'       => __DIR__ . '/terms/index.php',
    '/terms-of-service' => __DIR__ . '/terms/index.php',
    '/tos'         => __DIR__ . '/terms/index.php',
    '/register'        => __DIR__ . '/register/index.php',
    '/login'           => __DIR__ . '/login/index.php',
];

// تنظيف المسار (إزالة السلاش الأخير عدا الجذر)
$cleanUri = $uri;
if ($cleanUri !== '/' && substr($cleanUri, -1) === '/') {
    $cleanUri = rtrim($cleanUri, '/');
}

// === 3) مطابقة المسار وتنفيذ الصفحة المناسبة ===
if (isset($routes[$cleanUri])) {
    require_once $routes[$cleanUri];
    ob_end_flush();
    exit;
}

// === 4) مسارات الـ API ===
//   /api/<endpoint>            -> site/backend/api/<endpoint>.php
//   /api/<endpoint>/<...rest>  -> site/backend/api/<endpoint>.php (مع تمرير المسار)
//   /api/mail-<endpoint>       -> site/backend/site/mail/api/<endpoint>.php
if (preg_match('#^/api/([a-zA-Z0-9_\-]+)(?:/(.*))?/?$#', $cleanUri, $m)) {
    $name = $m[1];
    $candidates = [];
    if (strpos($name, 'mail-') === 0) {
        // /api/mail-<endpoint>  ->  site/backend/site/mail/api/<endpoint>.php
        // الشرطات في URL تُترجم إلى شرطات سفلية في اسم الملف
        $sub = str_replace('-', '_', substr($name, 5));
        $candidates[] = __DIR__ . '/site/backend/site/mail/api/' . $sub . '.php';
    }
    $candidates[] = __DIR__ . '/site/backend/api/' . $name . '.php';
    $candidates[] = __DIR__ . '/site/backend/api/' . str_replace('-', '_', $name) . '.php';
    $candidates[] = __DIR__ . '/api/' . $name . '.php';
    $candidates[] = __DIR__ . '/api/' . str_replace('-', '_', $name) . '.php';

    foreach ($candidates as $apiFile) {
        if (file_exists($apiFile)) {
            require_once $apiFile;
            ob_end_flush();
            exit;
        }
    }

    http_response_code(404);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => 'API endpoint not found'], JSON_UNESCAPED_UNICODE);
    ob_end_flush();
    exit;
}

// === 5) مطابقة بادئات معروفة (للصفحات المستقبلية) ===
if (preg_match('/^\/register/', $cleanUri) && file_exists(__DIR__ . '/register/index.php')) {
    require_once __DIR__ . '/register/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('/^\/login/', $cleanUri) && file_exists(__DIR__ . '/login/index.php')) {
    require_once __DIR__ . '/login/index.php';
    ob_end_flush();
    exit;
}
// === لوحة الإدارة العليا ===
if (preg_match('#^/admin/login/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/index.php')) {
    require_once __DIR__ . '/admin/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/api/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/api.php')) {
    require_once __DIR__ . '/admin/api.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/logout/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/logout.php')) {
    require_once __DIR__ . '/admin/logout.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/overview/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/overview.php')) {
    require_once __DIR__ . '/admin/overview.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/users/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/users.php')) {
    require_once __DIR__ . '/admin/users.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/analytics/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/analytics.php')) {
    require_once __DIR__ . '/admin/analytics.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/content/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/content.php')) {
    require_once __DIR__ . '/admin/content.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/about/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/about.php')) {
    require_once __DIR__ . '/admin/about.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin/system/?$#', $cleanUri) && file_exists(__DIR__ . '/admin/system.php')) {
    require_once __DIR__ . '/admin/system.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/admin(?:/.*)?$#', $cleanUri) && file_exists(__DIR__ . '/admin/index.php')) {
    require_once __DIR__ . '/admin/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/profiles/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/profiles/index.php')) {
    require_once __DIR__ . '/dashboard/profiles/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/profile/edit/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/profile/edit/index.php')) {
    require_once __DIR__ . '/dashboard/profile/edit/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/profile/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/profile/index.php')) {
    require_once __DIR__ . '/dashboard/profile/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/rings(?:/([0-9]+))?/?$#', $cleanUri, $rm) && file_exists(__DIR__ . '/dashboard/rings/index.php')) {
    if (!empty($rm[1])) $_GET['id'] = $rm[1];
    require_once __DIR__ . '/dashboard/rings/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/students/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/students/index.php')) {
    require_once __DIR__ . '/dashboard/students/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/reports/export(?:\.php)?/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/reports/export.php')) {
    require_once __DIR__ . '/dashboard/reports/export.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/certificates/view/([0-9]+)/?$#', $cleanUri, $cm) && file_exists(__DIR__ . '/dashboard/certificates/view.php')) {
    $_GET['id'] = $cm[1];
    require_once __DIR__ . '/dashboard/certificates/view.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/certificates/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/certificates/index.php')) {
    require_once __DIR__ . '/dashboard/certificates/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/schedule/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/schedule/index.php')) {
    require_once __DIR__ . '/dashboard/schedule/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/reports/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/reports/index.php')) {
    require_once __DIR__ . '/dashboard/reports/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/settings/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/settings/index.php')) {
    require_once __DIR__ . '/dashboard/settings/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/memorization/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/memorization/index.php')) {
    require_once __DIR__ . '/dashboard/memorization/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/rings-control/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/rings-control/index.php')) {
    require_once __DIR__ . '/dashboard/rings-control/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/supervisors/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/supervisors/index.php')) {
    require_once __DIR__ . '/dashboard/supervisors/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/support/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/support/index.php')) {
    require_once __DIR__ . '/dashboard/support/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/teachers/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/teachers/index.php')) {
    require_once __DIR__ . '/dashboard/teachers/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/help/assistant/?$#', $cleanUri) && file_exists(__DIR__ . '/help/assistant/index.php')) {
    require_once __DIR__ . '/help/assistant/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/activities/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/activities/index.php')) {
    require_once __DIR__ . '/dashboard/activities/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/student/games/map/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/student/games/map/index.php')) {
    require_once __DIR__ . '/dashboard/student/games/map/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/student/games/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/student/games/index.php')) {
    require_once __DIR__ . '/dashboard/student/games/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/student(?:/.*)?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/student/index.html')) {
    require_once __DIR__ . '/dashboard/student/index.html';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/parent/statistics/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/parent/statistics/index.php')) {
    require_once __DIR__ . '/dashboard/parent/statistics/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/parent/settings/?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/parent/settings/index.php')) {
    require_once __DIR__ . '/dashboard/parent/settings/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('#^/dashboard/parent(?:/.*)?$#', $cleanUri) && file_exists(__DIR__ . '/dashboard/parent/index.php')) {
    require_once __DIR__ . '/dashboard/parent/index.php';
    ob_end_flush();
    exit;
}
if (preg_match('/^\/dashboard/', $cleanUri) && file_exists(__DIR__ . '/dashboard/index.php')) {
    require_once __DIR__ . '/dashboard/index.php';
    ob_end_flush();
    exit;
}

// === 5) صفحة 404 احتياطية — تُستدعى من المجلد error/ ===
require_once __DIR__ . '/error/404.php';
ob_end_flush();
