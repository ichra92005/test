<?php
if (!defined('MAKAM_SITE_NAME')) {
    require_once __DIR__ . '/../../../config/config.php';
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $dash_title ?? 'لوحة تحكم المشرف' ?> — <?= MAKAM_SITE_NAME_EN ?></title>
<meta name="robots" content="noindex,nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
/* ════════════════════════════════════════
   MAKAM DASHBOARD — CORE VARIABLES
════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --green:#2D7A45;--green2:#3A9159;--green3:#46A866;
  --green-pale:#E8F5EE;--green-xpale:#F2FAF5;
  --orange:#E07824;--orange2:#C96B1A;--orange-pale:#FFF3E8;
  --gold:#E8B830;--gold2:#D4A520;--gold-pale:#FFF9E6;
  --red:#C1392B;--red-pale:#FDECEA;
  --purple:#7C3AED;--blue:#2563EB;
  --white:#fff;
  --gray-50:#F8F9FA;--gray-100:#F1F3F5;--gray-200:#E9ECEF;
  --gray-300:#DEE2E6;--gray-400:#ADB5BD;--gray-500:#6C757D;
  --gray-600:#495057;--gray-700:#343A40;--gray-800:#212529;
  /* Sidebar palette - Admin: slightly distinct, maybe darker blue-ish or keep black */
  --sb-bg:#0A0F1A;
  --sb-bg2:#111622;
  --sb-border:rgba(255,255,255,.06);
  --sb-gold:rgba(232,184,48,.9);
  --sidebar-w:272px;
  --topbar-h:68px;
  --font:'Cairo','Tajawal',sans-serif;
  --r:14px;--r-sm:9px;--r-full:9999px;
  --sh:0 2px 16px rgba(0,0,0,.07);
  --sh-md:0 6px 28px rgba(0,0,0,.1);
  --sh-green:0 6px 24px rgba(45,122,69,.22);
  --sh-orange:0 6px 24px rgba(224,120,36,.22);
  --tr:all .22s cubic-bezier(.4,0,.2,1);
}

body{
  font-family:var(--font);
  background:linear-gradient(160deg,#FFF8F0 0%,#FFFCF5 35%,#F2FAF5 70%,#F5F8FF 100%);
  color:var(--gray-800);
  direction:rtl;
  display:flex;
  min-height:100vh;
  overflow-x:hidden;
}

/* ════════════════════════════════════════
   SIDEBAR
════════════════════════════════════════ */
.dash-sidebar{
  position:fixed;top:0;right:0;bottom:0;
  width:var(--sidebar-w);
  background:var(--sb-bg);
  display:flex;flex-direction:column;
  z-index:300;
  overflow:hidden;
  box-shadow:
    -4px 0 0 rgba(232,184,48,.06),
    0 0 0 1px rgba(255,255,255,.04),
    -8px 0 40px rgba(0,0,0,.35);
}

.dash-sidebar::before{
  content:'';
  position:absolute;top:0;right:0;left:0;
  height:2px;
  background:linear-gradient(to left,var(--gold) 0%,rgba(232,184,48,.3) 60%,transparent 100%);
  z-index:10;
}

.dash-sidebar::after{
  content:'';
  position:absolute;inset:0;
  background:url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 .5H32M.5 0V32' stroke='%23ffffff' stroke-opacity='0.018' fill='none'/%3E%3C/svg%3E");
  pointer-events:none;
}

.sb-brand{
  display:flex;align-items:center;gap:.85rem;
  padding:1.4rem 1.5rem 1.2rem;
  border-bottom:1px solid var(--sb-border);
  flex-shrink:0;position:relative;z-index:2;
}
.sb-logo-wrap{
  width:46px;height:46px;border-radius:14px;
  overflow:hidden;flex-shrink:0;
  border:1.5px solid rgba(232,184,48,.25);
  background:rgba(232,184,48,.08);
  box-shadow:0 4px 16px rgba(0,0,0,.3), inset 0 1px 0 rgba(255,255,255,.08);
  transition:var(--tr);
}
.sb-logo-wrap:hover{border-color:rgba(232,184,48,.5);box-shadow:0 4px 20px rgba(232,184,48,.2)}
.sb-logo-wrap img{width:100%;height:100%;object-fit:cover}
.sb-brand-text{}
.sb-name{
  font-size:1.3rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,#fff 20%,var(--gold) 80%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  letter-spacing:.04em;
}
.sb-tagline{
  font-size:.62rem;color:rgba(255,255,255,.32);font-weight:700;
  margin-top:.25rem;display:flex;align-items:center;gap:.35rem;
  letter-spacing:.06em;text-transform:uppercase;
}
.sb-tagline::before{
  content:'';width:16px;height:1.5px;
  background:linear-gradient(to left,var(--gold),transparent);
  border-radius:2px;flex-shrink:0;
}

.sb-parent{
  margin:.85rem .9rem .2rem;
  background:linear-gradient(135deg,rgba(193,57,43,.18) 0%,rgba(193,57,43,.08) 100%);
  border-radius:14px;
  border:1px solid rgba(193,57,43,.25);
  padding:1rem 1.1rem;
  display:flex;align-items:center;gap:.8rem;
  flex-shrink:0;position:relative;overflow:hidden;
  box-shadow:0 4px 20px rgba(0,0,0,.15),inset 0 1px 0 rgba(255,255,255,.05);
  transition:var(--tr);
}
.sb-parent::before{
  content:'';position:absolute;top:-20px;left:-20px;
  width:80px;height:80px;border-radius:50%;
  background:rgba(193,57,43,.15);filter:blur(20px);pointer-events:none;
}
.sb-parent:hover{
  background:linear-gradient(135deg,rgba(193,57,43,.25) 0%,rgba(193,57,43,.12) 100%);
  border-color:rgba(193,57,43,.4);
}
.sb-avatar{
  width:42px;height:42px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,var(--red),#E53935);
  display:flex;align-items:center;justify-content:center;
  font-weight:900;color:#fff;font-size:1.05rem;
  box-shadow:0 4px 16px rgba(193,57,43,.45), 0 0 0 2px rgba(255,255,255,.1);
  position:relative;z-index:1;
}
.sb-parent-info{flex:1;min-width:0;position:relative;z-index:1}
.sb-parent-name{
  font-size:.85rem;font-weight:900;color:#fff;
  line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.sb-parent-role{
  display:inline-flex;align-items:center;gap:.3rem;
  font-size:.62rem;color:rgba(255,255,255,.38);font-weight:700;
  margin-top:.18rem;
}
.sb-parent-role i{font-size:.65rem;color:var(--gold);opacity:.8}
.sb-online-dot{
  width:9px;height:9px;border-radius:50%;
  background:#FF4B4B;flex-shrink:0;
  box-shadow:0 0 0 2px rgba(255,75,75,.25);
  animation:sbPulse 2s ease-in-out infinite;
  position:relative;z-index:1;
}
@keyframes sbPulse{0%,100%{box-shadow:0 0 0 2px rgba(255,75,75,.25)}50%{box-shadow:0 0 0 5px rgba(255,75,75,.08)}}

.sb-nav{
  flex:1;padding:.8rem .9rem;overflow-y:auto;
  display:flex;flex-direction:column;gap:.08rem;
  position:relative;z-index:2;
}
.sb-nav::-webkit-scrollbar{width:2px}
.sb-nav::-webkit-scrollbar-thumb{background:rgba(255,255,255,.08);border-radius:50px}

.sb-section-label{
  font-size:.58rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;
  color:rgba(255,255,255,.2);
  padding:.9rem .7rem .35rem;
  display:flex;align-items:center;gap:.6rem;
  margin-top:.2rem;
}
.sb-section-label::after{
  content:'';flex:1;height:1px;
  background:linear-gradient(to left,rgba(255,255,255,.08),transparent);
}

.sb-link{
  display:flex;align-items:center;gap:.8rem;
  padding:.68rem .85rem;border-radius:12px;
  text-decoration:none;
  color:rgba(255,255,255,.48);
  font-size:.86rem;font-weight:700;
  transition:var(--tr);
  position:relative;overflow:hidden;
}
.sb-link-icon{
  width:32px;height:32px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;flex-shrink:0;
  background:rgba(255,255,255,.05);
  transition:var(--tr);
}
.sb-link-icon i{transition:transform .25s ease}
.sb-link:hover{
  color:rgba(255,255,255,.88);
  background:rgba(255,255,255,.05);
}
.sb-link:hover .sb-link-icon{
  background:rgba(255,255,255,.1);
}
.sb-link:hover .sb-link-icon i{transform:scale(1.15)}

.sb-link.active{
  color:#fff;
  background:linear-gradient(135deg,rgba(193,57,43,.38) 0%,rgba(193,57,43,.18) 100%);
  box-shadow:0 2px 16px rgba(193,57,43,.2),inset 0 1px 0 rgba(255,255,255,.06);
}
.sb-link.active .sb-link-icon{
  background:linear-gradient(135deg,var(--red),#E53935);
  box-shadow:0 4px 14px rgba(193,57,43,.4);
}
.sb-link.active .sb-link-icon i{color:#fff}
.sb-link.active::after{
  content:'';position:absolute;right:0;top:20%;bottom:20%;
  width:3px;border-radius:3px 0 0 3px;
  background:linear-gradient(to bottom,#E53935,var(--red));
}

.sb-link-gold{color:rgba(232,184,48,.7)!important}
.sb-link-gold .sb-link-icon{background:rgba(232,184,48,.1)!important}
.sb-link-gold .sb-link-icon i{color:var(--gold)!important}
.sb-link-gold:hover{color:var(--gold)!important;background:rgba(232,184,48,.08)!important}

.sb-notif-badge{
  margin-right:auto;
  background:linear-gradient(135deg,var(--red),#E53935);
  color:#fff;font-size:.58rem;font-weight:900;
  min-width:18px;height:18px;border-radius:50px;
  display:flex;align-items:center;justify-content:center;
  padding:0 .35rem;
  box-shadow:0 2px 8px rgba(193,57,43,.4);
  animation:badgePop .3s cubic-bezier(.34,1.56,.64,1);
}
@keyframes badgePop{from{transform:scale(0)}to{transform:scale(1)}}

.sb-sep{
  margin:.5rem .9rem;height:1px;
  background:linear-gradient(to left,transparent,rgba(255,255,255,.07),transparent);
}

.sb-bottom{
  padding:.75rem .9rem;
  border-top:1px solid var(--sb-border);
  flex-shrink:0;position:relative;z-index:2;
  background:rgba(0,0,0,.1);
}
.sb-bottom-links{display:flex;flex-direction:column;gap:.05rem}
.sb-logout{
  display:flex;align-items:center;gap:.8rem;
  padding:.65rem .85rem;border-radius:12px;
  text-decoration:none;color:rgba(255,255,255,.35);
  font-size:.84rem;font-weight:700;
  transition:var(--tr);cursor:pointer;
  background:none;border:none;width:100%;font-family:var(--font);
  direction:rtl;
}
.sb-logout .sb-link-icon{
  background:rgba(255,255,255,.04);
  width:32px;height:32px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:.9rem;flex-shrink:0;transition:var(--tr);
}
.sb-logout:hover{color:#ff8a80}
.sb-logout:hover .sb-link-icon{background:rgba(193,57,43,.2);color:#ff8a80}

.sb-version{
  display:flex;align-items:center;justify-content:center;
  margin-top:.6rem;
  font-size:.58rem;color:rgba(255,255,255,.15);font-weight:700;letter-spacing:.08em;
}

/* ════════════════════════════════════════
   MAIN AREA
════════════════════════════════════════ */
.dash-main{
  margin-right:var(--sidebar-w);
  flex:1;display:flex;flex-direction:column;
  min-height:100vh;
}

/* ════════════════════════════════════════
   TOPBAR
════════════════════════════════════════ */
.dash-topbar{
  position:sticky;top:0;z-index:200;
  height:var(--topbar-h);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 2rem;
  background:rgba(255,255,253,.88);
  backdrop-filter:blur(20px) saturate(1.6);
  -webkit-backdrop-filter:blur(20px) saturate(1.6);
  border-bottom:1px solid rgba(232,184,48,.12);
  box-shadow:0 1px 0 rgba(255,255,255,.8),0 4px 24px rgba(224,120,36,.06);
  transition:var(--tr);
}

.dt-left{}
.dt-breadcrumb-row{
  display:flex;align-items:center;gap:.4rem;
  font-size:.7rem;color:var(--gray-400);font-weight:600;
  margin-bottom:.22rem;
}
.dt-breadcrumb-row i{font-size:.65rem;color:var(--gold)}
.dt-breadcrumb-sep{opacity:.5}
.dt-page-title{
  display:flex;align-items:center;gap:.6rem;
  font-size:1rem;font-weight:900;color:var(--gray-800);
}
.dt-page-icon{
  width:30px;height:30px;border-radius:9px;
  background:linear-gradient(135deg,var(--red),#E53935);
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;color:#fff;flex-shrink:0;
  box-shadow:0 3px 10px rgba(193,57,43,.3);
}

.dt-right{display:flex;align-items:center;gap:.75rem}

.dt-date-chip{
  display:flex;align-items:center;gap:.45rem;
  background:var(--red-pale);border:1.5px solid rgba(193,57,43,.12);
  border-radius:50px;padding:.38rem .9rem;
  font-size:.75rem;font-weight:800;color:var(--red);
  transition:var(--tr);cursor:default;
}
.dt-date-chip i{font-size:.8rem;color:var(--red)}

.dt-search{
  display:flex;align-items:center;gap:.5rem;
  background:var(--gray-100);border:1.5px solid var(--gray-200);
  border-radius:50px;padding:.42rem 1.1rem;
  transition:var(--tr);
}
.dt-search:focus-within{
  background:var(--white);border-color:var(--red);
  box-shadow:0 0 0 3px rgba(193,57,43,.08),0 4px 16px rgba(193,57,43,.08);
}
.dt-search i{color:var(--gray-400);font-size:.88rem;flex-shrink:0}
.dt-search input{
  background:none;border:none;outline:none;
  font-family:var(--font);font-size:.84rem;color:var(--gray-700);
  width:148px;direction:rtl;
}
.dt-search input::placeholder{color:var(--gray-400)}

.dt-icon-btn{
  width:40px;height:40px;border-radius:50%;
  background:var(--white);border:1.5px solid var(--gray-200);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:var(--tr);
  color:var(--gray-500);font-size:1rem;
  position:relative;text-decoration:none;
  box-shadow:0 2px 8px rgba(0,0,0,.05);
}
.dt-icon-btn:hover{
  background:var(--red-pale);color:var(--red);
  border-color:rgba(193,57,43,.22);
  box-shadow:0 4px 16px rgba(193,57,43,.12);
  transform:translateY(-1px);
}
.dt-icon-btn .dib-badge{
  position:absolute;top:-3px;left:-3px;
  width:17px;height:17px;border-radius:50%;
  background:linear-gradient(135deg,var(--red),#E53935);
  color:#fff;font-size:.58rem;font-weight:900;
  display:flex;align-items:center;justify-content:center;
  border:2px solid var(--white);
  box-shadow:0 2px 8px rgba(193,57,43,.35);
}

.dt-back-pill{
  display:flex;align-items:center;gap:.45rem;
  padding:.42rem 1.1rem;border-radius:50px;
  background:linear-gradient(135deg,rgba(193,57,43,.08),rgba(193,57,43,.04));
  border:1.5px solid rgba(193,57,43,.14);
  color:var(--red);font-size:.8rem;font-weight:800;
  text-decoration:none;transition:var(--tr);
  font-family:var(--font);
  box-shadow:0 2px 8px rgba(193,57,43,.06);
}
.dt-back-pill:hover{
  background:linear-gradient(135deg,var(--red),#E53935);
  color:#fff;border-color:transparent;
  box-shadow:0 6px 20px rgba(193,57,43,.28);
  transform:translateY(-1px);
}
.dt-back-pill i{font-size:.88rem}

.dt-divider{
  width:1px;height:24px;
  background:linear-gradient(to bottom,transparent,var(--gray-200),transparent);
  flex-shrink:0;
}

.dash-content{
  padding:1.8rem 2rem;
  flex:1;
}

@keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:none}}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(45,122,69,.4)}70%{box-shadow:0 0 0 10px rgba(45,122,69,0)}}

@media(max-width:960px){
  :root{--sidebar-w:0px}
  .dash-sidebar{display:none}
  .dash-main{margin-right:0}
  .dt-date-chip{display:none}
}
@media(max-width:640px){
  .dash-content{padding:1rem}
  .dash-topbar{padding:0 1rem}
  .dt-search{display:none}
  .dt-divider{display:none}
}
</style>
</head>
<body>

<aside class="dash-sidebar">
  <div class="sb-brand">
    <div class="sb-logo-wrap">
      <img src="/site/frontend/logo/logo-dash-no.png" alt="مقام">
    </div>
    <div class="sb-brand-text">
      <div class="sb-name">مـقـام</div>
      <div class="sb-tagline">لوحة تحكم المشرفين</div>
    </div>
  </div>

  <div class="sb-parent">
    <div class="sb-avatar" id="sbParentInit"><i class="bi bi-shield-lock-fill"></i></div>
    <div class="sb-parent-info">
      <div class="sb-parent-name" id="sbParentName">المدير العام</div>
      <div class="sb-parent-role"><i class="bi bi-shield-fill-check"></i> إدارة المنصة</div>
    </div>
    <div class="sb-online-dot" title="متصل"></div>
  </div>

  <nav class="sb-nav">
    <div class="sb-section-label">الإدارة العامة</div>

    <a href="/dashboard/admin" class="sb-link <?= (!isset($dash_active)||$dash_active==='overview')?'active':'' ?>">
      <div class="sb-link-icon"><i class="bi bi-speedometer2"></i></div>
      الرئيسية
    </a>

    <a href="?tab=activities" class="sb-link <?= (isset($dash_active)&&$dash_active==='activities')?'active':'' ?>" onclick="switchTab('activities'); return false;">
      <div class="sb-link-icon"><i class="bi bi-activity"></i></div>
      نشاطات الحسابات
    </a>
    
    <div class="sb-sep"></div>
    <div class="sb-section-label">المحتوى</div>

    <a href="?tab=content" class="sb-link <?= (isset($dash_active)&&$dash_active==='content')?'active':'' ?>" onclick="switchTab('content'); return false;">
      <div class="sb-link-icon"><i class="bi bi-pencil-square"></i></div>
      تحديث المحتوى
    </a>
    
    <div class="sb-sep"></div>
    <div class="sb-section-label">إعدادات النظام</div>

    <a href="#" class="sb-link">
      <div class="sb-link-icon"><i class="bi bi-gear-fill"></i></div>
      إعدادات المنصة
    </a>
  </nav>

  <div class="sb-bottom">
    <div class="sb-bottom-links">
      <button class="sb-logout" onclick="window.location.href='/login'">
        <div class="sb-link-icon"><i class="bi bi-box-arrow-left"></i></div>
        تسجيل الخروج
      </button>
    </div>
    <div class="sb-version">MAQAM Admin v1.0 — <?= date('Y') ?></div>
  </div>
</aside>

<div class="dash-main">
  <header class="dash-topbar">
    <div class="dt-left">
      <div class="dt-breadcrumb-row">
        <i class="bi bi-shield-lock-fill"></i>
        <span>منصة مقام</span>
        <span class="dt-breadcrumb-sep">›</span>
        <span>لوحة الإدارة</span>
        <span class="dt-breadcrumb-sep">›</span>
        <span style="color:var(--gray-600);font-weight:700"><?= $dash_title ?? 'الرئيسية' ?></span>
      </div>
      <div class="dt-page-title">
        <div class="dt-page-icon"><i class="bi bi-<?= $dash_icon ?? 'speedometer2' ?>"></i></div>
        <?= $dash_title ?? 'لوحة الإدارة' ?>
      </div>
    </div>

    <div class="dt-right">
      <div class="dt-date-chip" id="dtDateChip">
        <i class="bi bi-calendar3-fill"></i>
        <span id="dtDateText">—</span>
      </div>
      <div class="dt-divider"></div>
      <div class="dt-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="بحث في النظام...">
      </div>
      <div class="dt-icon-btn" title="الإشعارات">
        <i class="bi bi-bell-fill"></i>
        <div class="dib-badge">3</div>
      </div>
      <div class="dt-divider"></div>
      <a href="/" class="dt-back-pill">
        <i class="bi bi-arrow-right"></i>
        العودة للموقع
      </a>
    </div>
  </header>

  <div class="dash-content">
<script>
(function(){
  try {
    var now  = new Date();
    var opts = {weekday:'short', year:'numeric', month:'long', day:'numeric'};
    var dtEl = document.getElementById('dtDateText');
    if(dtEl) dtEl.textContent = now.toLocaleDateString('ar-DZ', opts);
  } catch(e){}
})();
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(function(el) {
        el.style.display = 'none';
    });
    document.getElementById(tabId).style.display = 'block';
    
    document.querySelectorAll('.sb-link').forEach(function(el) {
        el.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}
</script>
