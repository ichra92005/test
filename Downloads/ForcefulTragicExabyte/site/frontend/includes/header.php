<?php
if (!defined('MAKAM_SITE_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}
$page_title  = $page_title  ?? MAKAM_SITE_NAME . ' — ' . MAKAM_TAGLINE;
$page_desc   = $page_desc   ?? MAKAM_DESCRIPTION;
$body_class  = $body_class  ?? '';
$active_page = $active_page ?? '';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<meta property="og:title"       content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
<meta property="og:type"        content="website">
<meta name="theme-color"        content="#2D7A45">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ══════════════════════════════════════
   MAKAM — SHARED BASE
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --green:#2D7A45;--green2:#3A9159;--green3:#46A866;
  --green-pale:#E8F5EE;--green-xpale:#F2FAF5;
  --orange:#E07824;--orange2:#C96B1A;--orange-pale:#FFF3E8;
  --gold:#E8B830;--gold2:#D4A520;
  --red:#C1392B;--red2:#A5301F;
  --white:#fff;--cream:#FFFCF8;--warm-bg:#FFF8F2;
  --gray-100:#f5f5f5;--gray-200:#e8e8e8;--gray-400:#aaa;
  --gray-500:#777;--gray-600:#555;--gray-800:#222;
  --font:'Cairo','Tajawal',sans-serif;
  --r:16px;--r-sm:10px;--r-lg:24px;--r-full:9999px;
  --sh-warm:0 4px 24px rgba(224,120,36,.13);
  --sh-green:0 4px 24px rgba(45,122,69,.13);
  --tr:all .3s cubic-bezier(.4,0,.2,1);
}
body{font-family:var(--font);color:var(--gray-800);direction:rtl;overflow-x:hidden;background:var(--white)}

/* ══════════════════════════════════════
   FLAG BAR
══════════════════════════════════════ */
.flag-bar{display:flex;height:4px;width:100%;position:fixed;top:0;left:0;right:0;z-index:1001}
.flag-g{flex:1;background:var(--green)}
.flag-w{flex:1;background:var(--white);border-top:1px solid rgba(0,0,0,.06);border-bottom:1px solid rgba(0,0,0,.06)}
.flag-r{flex:1;background:var(--red)}

/* ══════════════════════════════════════
   NAVBAR
══════════════════════════════════════ */
.navbar{
  position:fixed;top:4px;left:0;right:0;z-index:1000;
  background:rgba(255,255,255,.96);
  backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
  border-bottom:1.5px solid rgba(45,122,69,.09);
  transition:var(--tr);
}
.navbar.scrolled{
  box-shadow:0 4px 32px rgba(45,122,69,.13),0 1px 4px rgba(0,0,0,.05);
  background:rgba(255,255,255,.99);
  border-bottom-color:rgba(45,122,69,.15);
}
.nav-container{
  max-width:1340px;margin:0 auto;
  padding:.7rem 1.5rem;
  display:flex;align-items:center;gap:1.2rem;
}

/* ── Logo ── */
.nav-logo{
  display:flex;align-items:center;gap:.65rem;
  text-decoration:none;flex-shrink:0;
  transition:var(--tr);
}
.nav-logo:hover{opacity:.88}
.nav-logo-img{
  width:52px;height:52px;border-radius:50%;
  overflow:hidden;flex-shrink:0;
  border:2px solid rgba(45,122,69,.18);
  box-shadow:0 2px 12px rgba(45,122,69,.15);
  transition:var(--tr);
  background:var(--green-pale);
}
.nav-logo:hover .nav-logo-img{box-shadow:0 4px 18px rgba(45,122,69,.25);transform:scale(1.05)}
.nav-logo-img img{width:100%;height:100%;object-fit:cover;display:block}
.nav-logo-text-wrap{display:flex;flex-direction:column;line-height:1}
.nav-logo-en{font-size:1.4rem;font-weight:900;color:var(--green);letter-spacing:-1px}
.nav-logo-ar{font-size:.68rem;color:var(--gray-400);font-weight:700;letter-spacing:.08em;margin-top:1px}

/* ── Divider ── */
.nav-divider{width:1px;height:28px;background:rgba(45,122,69,.15);flex-shrink:0}

/* ── Links ── */
.nav-links{display:flex;list-style:none;gap:.15rem;flex:1;justify-content:center}
.nav-link{
  display:flex;align-items:center;gap:.38rem;
  text-decoration:none;color:var(--gray-600);font-weight:700;
  padding:.48rem 1rem;border-radius:var(--r-sm);
  transition:var(--tr);font-size:.92rem;position:relative;
  white-space:nowrap;
}
.nav-link i{font-size:1rem;opacity:.65;transition:var(--tr)}
.nav-link::after{
  content:'';position:absolute;bottom:4px;right:50%;left:50%;
  height:2.5px;background:var(--orange);border-radius:2px;
  transition:all .3s cubic-bezier(.4,0,.2,1);opacity:0;
}
.nav-link:hover,.nav-link.active{color:var(--green);background:var(--green-pale)}
.nav-link:hover i,.nav-link.active i{opacity:1;color:var(--green)}
.nav-link.active::after,.nav-link:hover::after{right:12px;left:12px;opacity:1}

/* Mobile nav-link full style */
@media(max-width:768px){
  .nav-link::after{display:none}
  .nav-link.active{background:var(--green-pale);color:var(--green)}
}

/* ── Actions ── */
.nav-actions{display:flex;align-items:center;gap:.6rem;flex-shrink:0}

.nav-btn-login{
  display:inline-flex;align-items:center;gap:.42rem;
  text-decoration:none;color:var(--green);
  border:2px solid rgba(45,122,69,.35);
  background:transparent;
  padding:.46rem 1.1rem;border-radius:var(--r-sm);
  font-weight:700;font-size:.88rem;font-family:var(--font);
  transition:var(--tr);cursor:pointer;
}
.nav-btn-login i{font-size:1rem;transition:var(--tr)}
.nav-btn-login:hover{
  background:var(--green);color:var(--white);
  border-color:var(--green);
  box-shadow:0 4px 16px rgba(45,122,69,.25);
  transform:translateY(-1px);
}
.nav-btn-login:hover i{color:var(--white)}

.nav-btn-register{
  display:inline-flex;align-items:center;gap:.42rem;
  text-decoration:none;
  background:linear-gradient(135deg,var(--orange),var(--orange2));
  color:var(--white);
  padding:.52rem 1.25rem;border-radius:var(--r-sm);
  font-weight:800;font-size:.88rem;font-family:var(--font);
  transition:var(--tr);cursor:pointer;border:none;
  box-shadow:0 3px 14px rgba(224,120,36,.3);
}
.nav-btn-register i{font-size:1rem}
.nav-btn-register:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(224,120,36,.4);
  background:linear-gradient(135deg,#EF8534,var(--orange));
}

/* ── Hamburger ── */
.hamburger{
  display:none;flex-direction:column;gap:5px;
  background:none;border:2px solid var(--green-pale);
  border-radius:var(--r-sm);cursor:pointer;
  padding:.48rem .6rem;transition:var(--tr);
}
.hamburger:hover{border-color:rgba(45,122,69,.3);background:var(--green-xpale)}
.hamburger span{display:block;width:22px;height:2.5px;background:var(--green);border-radius:3px;transition:var(--tr)}
.hamburger.open{background:var(--green-pale);border-color:var(--green)}
.hamburger.open span:nth-child(1){transform:translateY(7.5px) rotate(45deg)}
.hamburger.open span:nth-child(2){opacity:0;transform:scaleX(0)}
.hamburger.open span:nth-child(3){transform:translateY(-7.5px) rotate(-45deg)}

/* ══════════════════════════════════════
   MOBILE MENU
══════════════════════════════════════ */
@media(max-width:768px){
  .nav-links,.nav-actions{display:none}
  .nav-links.open{
    display:flex;flex-direction:column;
    position:fixed;top:0;right:0;bottom:0;width:290px;
    background:var(--white);padding:5.5rem 1.5rem 2rem;
    box-shadow:-12px 0 48px rgba(0,0,0,.16);z-index:999;gap:.3rem;
    border-left:2px solid var(--green-pale);
    overflow-y:auto;
  }
  .nav-links.open .nav-link{font-size:1rem;padding:.65rem 1rem}
  .nav-links.open + .nav-actions,
  .nav-links.open ~ .nav-actions{display:none}
  .hamburger{display:flex}
  .nav-divider{display:none}

  /* Mobile action buttons inside open menu */
  .nav-links.open::after{
    content:'';display:block;flex:1;min-height:0;
  }
}

/* Tablet: hide nav-links only, show divider */
@media(max-width:960px) and (min-width:769px){
  .nav-links{gap:.05rem}
  .nav-link{padding:.44rem .7rem;font-size:.87rem}
  .nav-btn-register{padding:.48rem 1rem}
}
</style>
</head>
<body class="<?= htmlspecialchars($body_class) ?>">

<!-- Algerian flag bar -->
<div class="flag-bar">
  <span class="flag-g"></span>
  <span class="flag-w"></span>
  <span class="flag-r"></span>
</div>

<nav class="navbar" id="navbar">
  <div class="nav-container">

    <!-- Logo -->
    <a href="/" class="nav-logo" aria-label="مكام — الصفحة الرئيسية">
      <div class="nav-logo-img">
        <img src="/site/frontend/logo/logo-no.png" alt="شعار مكام" width="52" height="52">
      </div>
      <div class="nav-logo-text-wrap">
        <span class="nav-logo-en"><?= MAKAM_SITE_NAME_EN ?></span>
        <span class="nav-logo-ar">مقـــــام</span>
      </div>
    </a>

    <div class="nav-divider"></div>

    <!-- Links -->
    <ul class="nav-links" id="navLinks">
      <li>
        <a href="/" class="nav-link <?= $active_page === 'home' ? 'active' : '' ?>">
          <i class="bi bi-house-fill"></i> الرئيسية
        </a>
      </li>
      <li>
        <a href="/#maqam" class="nav-link">
          <i class="bi bi-building-fill"></i> المواد
        </a>
      </li>
      <li>
        <a href="/#how" class="nav-link">
          <i class="bi bi-rocket-takeoff-fill"></i> كيف تعمل
        </a>
      </li>
      <li>
        <a href="/about/" class="nav-link">
          <i class="bi bi-people-fill"></i> من نحن
        </a>
      </li>
    </ul>

    <!-- Actions -->
    <div class="nav-actions" id="navActions">
      <a href="/login" class="nav-btn-login">
        <i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول
      </a>
      <a href="/register" class="nav-btn-register">
        <i class="bi bi-lightning-fill"></i> ابدأ مجاناً
      </a>
    </div>

    <!-- Hamburger -->
    <button class="hamburger" id="hamburger" aria-label="فتح القائمة" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

  </div>
</nav>
