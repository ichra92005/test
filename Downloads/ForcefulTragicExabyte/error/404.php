<?php
require_once __DIR__ . '/../site/frontend/config/config.php';
$page_title = '٤٠٤ — الصفحة غير موجودة | ' . MAKAM_SITE_NAME_EN;
$body_class = 'page-404';
require_once __DIR__ . '/../site/frontend/includes/header.php';
http_response_code(404);
?>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--green:#006233;--green-pale:#e8f5ee;--red:#D21034;--white:#fff;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-600:#4b5563;--gray-800:#1f2937;--font:'Cairo','Tajawal',sans-serif}
body{font-family:var(--font);background:linear-gradient(135deg,#f0faf4,#e8f5ee);min-height:100vh;direction:rtl}
.flag-bar{display:flex;height:5px}.flag-green{flex:1;background:var(--green)}.flag-white{flex:1;background:var(--white);border-top:1px solid var(--gray-200)}.flag-red{flex:1;background:var(--red)}
.navbar{background:rgba(255,255,255,.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(0,98,51,.1);padding:.9rem 1.5rem}
.nav-container{max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:.5rem;text-decoration:none}
.logo-icon{font-size:1.8rem}.logo-text{font-size:1.5rem;font-weight:900;color:var(--green)}.logo-sub{font-size:.75rem;color:var(--gray-400);align-self:flex-end;margin-bottom:2px}
.nav-links,.hamburger{display:none}
.nav-actions{display:flex;gap:.75rem}
.btn-outline-nav{text-decoration:none;color:var(--green);border:2px solid var(--green);padding:.45rem 1.1rem;border-radius:10px;font-weight:700;font-size:.9rem;font-family:var(--font)}
.btn-primary-nav{text-decoration:none;background:var(--green);color:var(--white);padding:.5rem 1.1rem;border-radius:10px;font-weight:700;font-size:.9rem;font-family:var(--font)}
.page-404-content{min-height:80vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 1.5rem}
.error-emoji{font-size:7rem;margin-bottom:1rem;animation:shake .5s ease-in-out}
@keyframes shake{0%,100%{transform:rotate(0)}25%{transform:rotate(-8deg)}75%{transform:rotate(8deg)}}
.error-code{font-size:5rem;font-weight:900;color:var(--green);line-height:1;margin-bottom:.5rem}
.error-title{font-size:1.6rem;font-weight:800;color:var(--gray-800);margin-bottom:.75rem}
.error-desc{color:var(--gray-400);font-size:1rem;margin-bottom:2rem;line-height:1.7}
.error-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;gap:.5rem;padding:.8rem 2rem;border-radius:14px;font-family:var(--font);font-weight:700;font-size:1rem;text-decoration:none;transition:all .3s ease}
.btn-green{background:var(--green);color:var(--white)}.btn-green:hover{opacity:.9;transform:translateY(-2px)}
.btn-outline{border:2px solid var(--green);color:var(--green)}.btn-outline:hover{background:var(--green-pale)}
</style>
<div class="page-404-content">
  <div>
    <div class="error-emoji">🔍</div>
    <div class="error-code">٤٠٤</div>
    <div class="error-title">آووه! الصفحة غير موجودة</div>
    <div class="error-desc">يبدو أن الصفحة التي تبحث عنها غير متوفرة أو تم نقلها.<br>لا تقلق، عد للرئيسية وابدأ من جديد! 😊</div>
    <div class="error-actions">
      <a href="/" class="btn btn-green">🏠 العودة للرئيسية</a>
      <a href="/register" class="btn btn-outline">🚀 إنشاء حساب</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../site/frontend/includes/footer.php'; ?>
