<?php
if (!defined('MAKAM_SITE_NAME')) {
    require_once __DIR__ . '/../../../config/config.php';
}
$student_name   = $student_name   ?? 'أمين';
$student_lname  = $student_lname  ?? 'بن علي';
$student_init   = $student_init   ?? 'أ';
$student_level  = $student_level  ?? 'مكتشف ناشئ';
$student_badge  = $student_badge  ?? '🌱';
$student_xp     = $student_xp     ?? 320;
$student_color  = $student_color  ?? '#2D7A45';
$student_streak = $student_streak ?? 5;
$dash_active    = $dash_active    ?? 'home';
$xp_pct         = min(100, round($student_xp / 500 * 100));
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($dash_title ?? 'لوحتي') ?> — مقام</title>
<meta name="robots" content="noindex,nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
/* ════════════════════════════════════════════════════
   MAKAM STUDENT DASHBOARD — REDESIGN v3
════════════════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --alg-green:#006233; --alg-green2:#0A7A3C; --alg-green3:#044d26;
  --alg-red:#D21034;   --alg-red2:#B80E2C;
  --green:#2D7A45;     --green2:#3A9159;
  --green-pale:#E6F4EC;--green-xpale:#F0FAF4;
  --red:#C1392B;       --red-pale:#FDECEA;
  --gold:#E8B830;      --gold2:#D4A520;  --gold-pale:#FFF9E6;
  --orange:#E07824;    --orange-pale:#FFF3E8;
  --sand:#F5E4B8;      --sand2:#FDFAF3;  --sand3:#FFF6E0;
  --purple:#7C3AED;    --blue:#2563EB;   --white:#fff;
  --gray-50:#F8F9FA;   --gray-100:#F1F3F5; --gray-200:#E9ECEF;
  --gray-300:#DEE2E6;  --gray-400:#ADB5BD; --gray-500:#6C757D;
  --gray-600:#495057;  --gray-700:#343A40; --gray-800:#212529;
  --sidebar-w:240px;
  --topbar-h:72px;
  --font:'Cairo','Tajawal',sans-serif;
  --r:16px; --r-sm:10px; --r-full:9999px;
  --sh:0 2px 16px rgba(0,0,0,.07);
  --sh-md:0 6px 28px rgba(0,0,0,.1);
  --sh-green:0 6px 24px rgba(0,98,51,.25);
  --sh-gold:0 6px 24px rgba(232,184,48,.3);
  --tr:all .22s cubic-bezier(.4,0,.2,1);
}

/* ── Base ── */
body{
  font-family:var(--font);
  background:var(--sand2);
  color:var(--gray-800);
  direction:rtl;
  display:flex;
  min-height:100vh;
  overflow-x:hidden;
}

/* ════════════════════════════════════════════════════
   SIDEBAR — FULL WIDTH WITH LABELS
════════════════════════════════════════════════════ */
.dash-sidebar{
  position:fixed;top:0;right:0;bottom:0;
  width:var(--sidebar-w);
  background:linear-gradient(175deg,#062C14 0%,#041C0D 50%,#020F07 100%);
  display:flex;flex-direction:column;
  z-index:300;
  box-shadow:-4px 0 40px rgba(0,0,0,.35);
  overflow:hidden;
}

/* Algerian pattern overlay */
.dash-sidebar::before{
  content:'';position:absolute;inset:0;
  background-image:
    radial-gradient(circle at 20% 20%, rgba(0,98,51,.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 80%, rgba(210,16,52,.08) 0%, transparent 40%),
    radial-gradient(circle at 50% 50%, rgba(232,184,48,.04) 0%, transparent 60%);
  pointer-events:none;
}

/* Decorative side line */
.dash-sidebar::after{
  content:'';position:absolute;top:0;left:0;bottom:0;width:3px;
  background:linear-gradient(180deg,transparent 0%,var(--gold) 30%,var(--alg-green) 70%,transparent 100%);
  opacity:.4;pointer-events:none;
}

/* ── Sidebar Header / Brand ── */
.sb-brand{
  padding:1.4rem 1.2rem 1rem;
  border-bottom:1px solid rgba(255,255,255,.06);
  flex-shrink:0;position:relative;z-index:1;
  display:flex;align-items:center;gap:.85rem;
}
.sb-brand-logo{
  width:46px;height:46px;border-radius:14px;
  overflow:hidden;flex-shrink:0;
  border:2px solid rgba(232,184,48,.3);
  box-shadow:0 0 16px rgba(232,184,48,.15);
}
.sb-brand-logo img{width:100%;height:100%;object-fit:cover}
.sb-brand-text{}
.sb-brand-name{
  font-size:1.2rem;font-weight:900;
  background:linear-gradient(135deg,#E8B830,#fff 60%,#E8B830);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  background-clip:text;line-height:1.1;
}
.sb-brand-tagline{
  font-size:.65rem;color:rgba(255,255,255,.4);font-weight:700;
  margin-top:.1rem;
}

/* ── Student Profile Card inside sidebar ── */
.sb-profile{
  margin:1rem .9rem;
  background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.08);
  border-radius:16px;padding:.9rem .85rem;
  position:relative;z-index:1;
  flex-shrink:0;
  backdrop-filter:blur(8px);
}
.sb-profile-top{display:flex;align-items:center;gap:.75rem}
.sb-avatar-ring{
  width:52px;height:52px;border-radius:50%;flex-shrink:0;
  background:conic-gradient(var(--gold) 0% <?= $xp_pct ?>%, rgba(255,255,255,.08) <?= $xp_pct ?>% 100%);
  display:flex;align-items:center;justify-content:center;
  padding:3px;position:relative;
}
.sb-avatar{
  width:46px;height:46px;border-radius:50%;
  background:linear-gradient(135deg,#D4A520,#F59E0B);
  display:flex;align-items:center;justify-content:center;
  font-weight:900;color:#333;font-size:1.2rem;
  box-shadow:0 0 0 2px #041C0D;
}
.sb-badge-float{
  position:absolute;bottom:-2px;right:-2px;
  font-size:.85rem;line-height:1;
  filter:drop-shadow(0 2px 4px rgba(0,0,0,.5));
}
.sb-profile-info{flex:1;min-width:0}
.sb-student-name{
  font-size:.92rem;font-weight:900;color:#fff;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.sb-student-level{
  font-size:.67rem;color:rgba(255,255,255,.5);font-weight:700;
  margin-top:.05rem;
}
/* XP bar inside profile */
.sb-xp-section{margin-top:.75rem}
.sb-xp-row{
  display:flex;justify-content:space-between;align-items:center;
  font-size:.65rem;font-weight:800;margin-bottom:.3rem;
}
.sb-xp-lbl{color:rgba(255,255,255,.4)}
.sb-xp-val{color:var(--gold);font-size:.72rem}
.sb-xp-bar{height:5px;border-radius:50px;background:rgba(255,255,255,.08);overflow:hidden}
.sb-xp-fill{
  height:100%;border-radius:50px;
  background:linear-gradient(90deg,var(--gold),#F59E0B);
  width:<?= $xp_pct ?>%;transition:width 1.4s ease;
}
/* Streak pill */
.sb-streak-row{
  display:flex;align-items:center;gap:.35rem;margin-top:.6rem;
  background:rgba(232,184,48,.1);border:1px solid rgba(232,184,48,.18);
  border-radius:50px;padding:.28rem .65rem;width:fit-content;
  font-size:.68rem;font-weight:900;color:var(--gold);
}

/* ── Nav Section Label ── */
.sb-section-label{
  font-size:.6rem;font-weight:800;
  color:rgba(255,255,255,.25);
  text-transform:uppercase;letter-spacing:.1em;
  padding:.6rem 1.4rem .25rem;
  position:relative;z-index:1;
  flex-shrink:0;
}

/* ── Nav ── */
.sb-nav{
  flex:1;padding:.3rem .9rem;
  overflow-y:auto;overflow-x:hidden;
  position:relative;z-index:1;
}
.sb-nav::-webkit-scrollbar{width:3px}
.sb-nav::-webkit-scrollbar-track{background:transparent}
.sb-nav::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:10px}

.sb-nav-item{
  display:flex;align-items:center;gap:.75rem;
  padding:.68rem .85rem;border-radius:13px;
  cursor:pointer;transition:var(--tr);
  position:relative;text-decoration:none;
  color:rgba(255,255,255,.5);font-size:.86rem;font-weight:800;
  margin-bottom:.2rem;white-space:nowrap;
  border:1px solid transparent;
}
.sb-nav-item:hover{
  background:rgba(255,255,255,.07);
  color:rgba(255,255,255,.85);
  border-color:rgba(255,255,255,.06);
}
.sb-nav-item.active{
  background:linear-gradient(135deg,rgba(0,98,51,.55),rgba(10,122,60,.3));
  color:#fff;
  border-color:rgba(0,98,51,.4);
  box-shadow:0 4px 20px rgba(0,98,51,.25);
}
.sb-nav-item.active::after{
  content:'';position:absolute;right:-1px;top:25%;bottom:25%;
  width:3px;border-radius:3px;
  background:linear-gradient(180deg,var(--gold),#F59E0B);
}
.sni-icon-wrap{
  width:36px;height:36px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:var(--tr);font-size:1rem;
  background:rgba(255,255,255,.06);
}
.sb-nav-item.active .sni-icon-wrap{
  background:rgba(0,98,51,.5);
  box-shadow:0 2px 10px rgba(0,98,51,.3);
  color:#fff;
}
.sb-nav-item:hover:not(.active) .sni-icon-wrap{
  background:rgba(255,255,255,.1);
  color:rgba(255,255,255,.9);
}
.sni-svg{width:18px;height:18px;fill:currentColor}
.sni-label{flex:1}
.sni-dot{
  width:8px;height:8px;border-radius:50%;
  background:var(--alg-red);
  box-shadow:0 0 6px rgba(210,16,52,.6);
  animation:pulse-dot 2s ease-in-out infinite;
  flex-shrink:0;
}
.sni-chip{
  font-size:.6rem;font-weight:900;padding:.15rem .45rem;border-radius:50px;
  background:rgba(232,184,48,.2);color:var(--gold);
  border:1px solid rgba(232,184,48,.25);
  flex-shrink:0;
}

/* ── Separator ── */
.sb-separator{
  height:1px;background:rgba(255,255,255,.06);
  margin:.5rem .9rem;position:relative;z-index:1;flex-shrink:0;
}

/* ── Sidebar Bottom ── */
.sb-bottom{
  flex-shrink:0;
  border-top:1px solid rgba(255,255,255,.06);
  padding:.75rem .9rem;
  position:relative;z-index:1;
}
.sb-back-btn{
  display:flex;align-items:center;gap:.65rem;
  padding:.62rem .85rem;border-radius:13px;
  color:rgba(255,255,255,.35);
  text-decoration:none;font-size:.83rem;font-weight:800;
  transition:var(--tr);border:1px solid transparent;
}
.sb-back-btn:hover{
  background:rgba(210,16,52,.1);
  color:#ff8a80;border-color:rgba(210,16,52,.15);
}
.sb-back-btn .sni-icon-wrap{
  width:34px;height:34px;border-radius:9px;
  background:rgba(210,16,52,.08);
  color:rgba(255,255,255,.35);
}
.sb-back-btn:hover .sni-icon-wrap{
  background:rgba(210,16,52,.2);color:#ff8a80;
}

/* ════════════════════════════════════════════════════
   MAIN AREA
════════════════════════════════════════════════════ */
.dash-main{
  margin-right:var(--sidebar-w);
  flex:1;display:flex;flex-direction:column;min-height:100vh;
}

/* ════════════════════════════════════════════════════
   TOPBAR — REDESIGNED
════════════════════════════════════════════════════ */
.dash-topbar{
  position:sticky;top:0;z-index:200;
  height:var(--topbar-h);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 1.8rem;
  background:rgba(253,250,243,.95);
  border-bottom:1px solid rgba(232,184,48,.2);
  backdrop-filter:blur(20px);
  -webkit-backdrop-filter:blur(20px);
  box-shadow:0 1px 0 rgba(232,184,48,.1),0 4px 24px rgba(0,0,0,.06);
}

/* Decorative green bar at bottom of topbar */
.dash-topbar::after{
  content:'';position:absolute;bottom:0;right:0;left:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--alg-green) 30%,var(--gold) 50%,var(--alg-red) 70%,transparent);
  opacity:.35;
}

/* ── Left: page info ── */
.dt-left{}
.dt-page-info{display:flex;align-items:center;gap:.9rem}

.dt-icon-wrap{
  width:46px;height:46px;border-radius:13px;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:1.25rem;
  background:linear-gradient(135deg,var(--green-pale),#D4EDDF);
  border:1.5px solid rgba(0,98,51,.14);
  box-shadow:0 3px 12px rgba(0,98,51,.12);
  position:relative;overflow:hidden;
}
.dt-icon-wrap::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.5),transparent);
  pointer-events:none;
}

.dt-title-wrap{}
.dt-title{
  font-size:1.05rem;font-weight:900;color:var(--gray-800);
  line-height:1.2;display:flex;align-items:center;gap:.4rem;
}
.dt-title-dot{
  width:6px;height:6px;border-radius:50%;
  background:var(--alg-green);display:inline-block;
  animation:pulse-dot 2s ease-in-out infinite;
}
.dt-breadcrumb{
  display:flex;align-items:center;gap:.3rem;
  font-size:.68rem;color:var(--gray-400);font-weight:700;margin-top:.08rem;
}
.dt-bc-sep{color:var(--gray-300);font-size:.6rem}

/* ── Right: actions area ── */
.dt-right{display:flex;align-items:center;gap:.7rem}

/* XP chip */
.dt-xp-chip{
  display:flex;align-items:center;gap:.6rem;
  background:linear-gradient(135deg,rgba(232,184,48,.1),rgba(245,158,11,.06));
  border:1.5px solid rgba(232,184,48,.28);
  border-radius:50px;padding:.42rem 1rem .42rem .85rem;
  cursor:pointer;transition:var(--tr);
  text-decoration:none;
}
.dt-xp-chip:hover{
  background:var(--gold-pale);
  border-color:var(--gold);
  transform:translateY(-1px);
  box-shadow:0 4px 16px rgba(232,184,48,.2);
}
.dt-xp-icon{
  width:30px;height:30px;border-radius:9px;
  background:linear-gradient(135deg,var(--gold),#F59E0B);
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;flex-shrink:0;
  box-shadow:0 2px 8px rgba(232,184,48,.35);
}
.dt-xp-info{}
.dt-xp-label{font-size:.58rem;font-weight:800;color:var(--gray-400);margin-bottom:.18rem}
.dt-xp-bar{height:4px;border-radius:50px;background:var(--gray-200);overflow:hidden;width:56px}
.dt-xp-fill{
  height:100%;border-radius:50px;
  background:linear-gradient(90deg,var(--gold),#F59E0B);
  transition:width 1.2s ease;
}
.dt-xp-val{font-size:.8rem;font-weight:900;color:var(--gold2)}

/* Streak chip */
.dt-streak-chip{
  display:flex;align-items:center;gap:.4rem;
  background:linear-gradient(135deg,rgba(224,120,36,.1),rgba(224,120,36,.06));
  border:1.5px solid rgba(224,120,36,.22);
  border-radius:50px;padding:.42rem .9rem;
  font-size:.82rem;font-weight:900;color:var(--orange);
  cursor:pointer;transition:var(--tr);white-space:nowrap;
}
.dt-streak-chip:hover{
  background:var(--orange-pale);
  border-color:var(--orange);
  transform:translateY(-1px);
}
.dt-streak-num{font-size:.9rem}

/* Notif button */
.dt-notif-btn{
  width:42px;height:42px;border-radius:13px;
  background:var(--white);
  border:1.5px solid var(--gray-200);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;color:var(--gray-500);font-size:1.05rem;
  position:relative;transition:var(--tr);
  box-shadow:var(--sh);
}
.dt-notif-btn:hover{
  border-color:var(--gold);
  color:var(--gold2);
  background:var(--gold-pale);
  transform:translateY(-1px);
  box-shadow:0 4px 16px rgba(232,184,48,.15);
}
.dt-notif-badge{
  position:absolute;top:-5px;left:-5px;
  width:18px;height:18px;border-radius:50%;
  background:var(--alg-red);border:2px solid var(--sand2);
  font-size:.5rem;font-weight:900;color:#fff;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 2px 6px rgba(210,16,52,.4);
}

/* Play button */
.dt-play-btn{
  display:flex;align-items:center;gap:.5rem;
  padding:.5rem 1.3rem;border-radius:50px;
  background:linear-gradient(135deg,var(--alg-green),var(--alg-green2));
  color:#fff;border:none;
  font-family:var(--font);font-size:.85rem;font-weight:900;
  cursor:pointer;transition:var(--tr);
  box-shadow:0 4px 18px rgba(0,98,51,.3);
  white-space:nowrap;
}
.dt-play-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 28px rgba(0,98,51,.4);
  background:linear-gradient(135deg,var(--alg-green2),#0D8F46);
}
.dt-play-btn svg{width:15px;height:15px;fill:currentColor;flex-shrink:0}

/* Student name chip (mobile) */
.dt-student-chip{
  display:none;align-items:center;gap:.5rem;
  padding:.38rem .8rem;border-radius:50px;
  background:var(--green-pale);border:1.5px solid rgba(0,98,51,.14);
  font-size:.8rem;font-weight:900;color:var(--alg-green);
}

/* ── Content wrapper ── */
.dash-content{padding:1.8rem 2rem;flex:1}

/* ════════════════════════════════════════════════════
   MOBILE BOTTOM NAV
════════════════════════════════════════════════════ */
.mobile-bottom-nav{
  display:none;
  position:fixed;bottom:0;left:0;right:0;
  background:linear-gradient(0deg,#041C0D,#062C14);
  border-top:1px solid rgba(255,255,255,.08);
  padding:.5rem 0 calc(.5rem + env(safe-area-inset-bottom));
  z-index:400;
  box-shadow:0 -4px 30px rgba(0,0,0,.3);
}
.mbn-nav{
  display:flex;align-items:center;justify-content:space-around;
}
.mbn-item{
  display:flex;flex-direction:column;align-items:center;gap:.2rem;
  padding:.35rem .6rem;border-radius:12px;
  color:rgba(255,255,255,.4);text-decoration:none;
  transition:var(--tr);flex:1;
}
.mbn-item.active{color:var(--gold)}
.mbn-item.active .mbn-icon{
  background:rgba(0,98,51,.5);
  box-shadow:0 2px 10px rgba(0,98,51,.3);
}
.mbn-icon{
  width:38px;height:38px;border-radius:11px;
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;transition:var(--tr);
  background:rgba(255,255,255,.05);
}
.mbn-label{font-size:.58rem;font-weight:800;line-height:1}

/* ════════════════════════════════════════════════════
   KEYFRAMES
════════════════════════════════════════════════════ */
@keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:none}}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes spin-slow{from{transform:rotate(0)}to{transform:rotate(360deg)}}
@keyframes pulse-dot{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.4);opacity:.6}}
@keyframes shimmer{0%{background-position:200% center}100%{background-position:-200% center}}
@keyframes toastUp{from{opacity:0;transform:translateX(-50%) translateY(14px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}

/* ════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════ */
@media(max-width:1100px){
  :root{--sidebar-w:72px}
  .sb-brand-text,.sb-profile-info,.sb-section-label,
  .sni-label,.sni-dot,.sni-chip,.sb-bottom .sb-back-btn span,
  .sb-student-level,.sb-xp-section,.sb-streak-row{display:none}
  .sb-brand{justify-content:center;padding:1rem .5rem}
  .sb-brand-logo{width:44px;height:44px}
  .sb-profile{padding:.7rem .5rem;display:flex;justify-content:center;margin:.8rem .6rem}
  .sb-profile-top{justify-content:center}
  .sb-nav-item{padding:.7rem;justify-content:center;gap:0}
  .sni-icon-wrap{width:40px;height:40px;border-radius:12px}
  .sb-bottom{padding:.5rem .6rem}
  .sb-back-btn{justify-content:center;padding:.62rem;gap:0}
  .dt-xp-chip,.dt-streak-chip{display:none}
  .dt-student-chip{display:flex}
}
@media(max-width:768px){
  :root{--sidebar-w:0px;--topbar-h:64px}
  .dash-sidebar{display:none}
  .dash-main{margin-right:0;padding-bottom:70px}
  .mobile-bottom-nav{display:block}
  .dt-xp-chip,.dt-streak-chip,.dt-play-btn{display:none}
  .dt-student-chip{display:flex}
  .dash-topbar{padding:0 1rem}
  .dash-content{padding:1rem}
}
@media(max-width:480px){
  .dt-notif-btn{display:none}
}
</style>
</head>
<body>

<!-- ════════════════════ SIDEBAR ════════════════════ -->
<aside class="dash-sidebar">

  <!-- Brand -->
  <div class="sb-brand">
    <div class="sb-brand-logo">
      <img src="/site/frontend/logo/logo.png" alt="مقام" onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#006233,#0A7A3C);font-size:1.3rem;font-weight:900;color:#E8B830;\'>م</div>'">
    </div>
    <div class="sb-brand-text">
      <div class="sb-brand-name">مقام</div>
      <div class="sb-brand-tagline">منصة التعلم الجزائرية</div>
    </div>
  </div>

  <!-- Student Profile -->
  <div class="sb-profile">
    <div class="sb-profile-top">
      <div class="sb-avatar-ring" id="sbAvatarRing">
        <div class="sb-avatar" id="sbAvatar">؟</div>
        <div class="sb-badge-float" id="sbBadge">🌱</div>
      </div>
      <div class="sb-profile-info">
        <div class="sb-student-name" id="sbName">جارٍ التحميل…</div>
        <div class="sb-student-level" id="sbLevel">مبتدئ ناشئ</div>
      </div>
    </div>
    <div class="sb-xp-section">
      <div class="sb-xp-row">
        <span class="sb-xp-lbl">تقدم المستوى</span>
        <span class="sb-xp-val" id="sbXpVal">⚡ 0</span>
      </div>
      <div class="sb-xp-bar"><div class="sb-xp-fill" id="sbXpFill" style="width:0%"></div></div>
    </div>
    <div class="sb-streak-row">
      🔥 <span id="sbStreakTxt">0 أيام متتالية</span>
    </div>
  </div>

  <!-- Nav Section: الرئيسية -->
  <div class="sb-section-label">الرئيسية</div>
  <nav class="sb-nav">

    <a href="/dashboard/student" class="sb-nav-item <?= $dash_active==='home'?'active':'' ?>">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      </div>
      <span class="sni-label">لوحتي الرئيسية</span>
    </a>

    <a href="#citiesSection" class="sb-nav-item <?= $dash_active==='cities'?'active':'' ?>" onclick="scrollTo2('citiesSection');return false">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M15 11V5l-3-3-3 3v2H3v14h18V11h-6zm-8 8H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V9h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm6 12h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
      </div>
      <span class="sni-label">مدن الجزائر</span>
    </a>

    <a href="/dashboard/student/games" class="sb-nav-item <?= $dash_active==='games'?'active':'' ?>">
      <div class="sni-icon-wrap" style="position:relative">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5S14.67 12 15.5 12s1.5.67 1.5 1.5S16.33 15 15.5 15zm3-3c-.83 0-1.5-.67-1.5-1.5S17.67 9 18.5 9s1.5.67 1.5 1.5S19.33 12 18.5 12z"/></svg>
      </div>
      <span class="sni-label">العب وتعلّم</span>
      <span class="sni-dot"></span>
    </a>

    <div class="sb-separator"></div>
    <div class="sb-section-label" style="padding-top:.3rem">تقدمي</div>

    <a href="#badgesSection" class="sb-nav-item <?= $dash_active==='badges'?'active':'' ?>" onclick="scrollTo2('badgesSection');return false">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0011 15.9V18H9v2h6v-2h-2v-2.1a5.01 5.01 0 003.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
      </div>
      <span class="sni-label">جوائزي وشاراتي</span>
      <span class="sni-chip">١</span>
    </a>

    <a href="#" class="sb-nav-item <?= $dash_active==='progress'?'active':'' ?>" onclick="showKidToast('📊 تقدمي الكامل قريباً!');return false">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
      </div>
      <span class="sni-label">تقدمي ونتائجي</span>
    </a>

    <a href="#" class="sb-nav-item" onclick="showKidToast('🗺️ خريطة الجزائر قريباً!');return false">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/></svg>
      </div>
      <span class="sni-label">خريطة الجزائر</span>
    </a>

    <div class="sb-separator"></div>
    <div class="sb-section-label" style="padding-top:.3rem">الدعم</div>

    <a href="#" class="sb-nav-item" onclick="showKidToast('⚙️ الإعدادات قريباً!');return false">
      <div class="sni-icon-wrap">
        <svg class="sni-svg" viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
      </div>
      <span class="sni-label">الإعدادات</span>
    </a>

  </nav>

  <!-- Bottom: Back -->
  <div class="sb-bottom">
    <a href="/dashboard/parent" class="sb-back-btn">
      <div class="sni-icon-wrap">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"/></svg>
      </div>
      <span>عودة لولي الأمر</span>
    </a>
  </div>

</aside>

<!-- ════════════════════ MOBILE BOTTOM NAV ════════════════════ -->
<nav class="mobile-bottom-nav">
  <div class="mbn-nav">
    <a href="/dashboard/student" class="mbn-item <?= $dash_active==='home'?'active':'' ?>">
      <div class="mbn-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      </div>
      <span class="mbn-label">لوحتي</span>
    </a>
    <a href="#citiesSection" class="mbn-item <?= $dash_active==='cities'?'active':'' ?>" onclick="scrollTo2('citiesSection');return false">
      <div class="mbn-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M15 11V5l-3-3-3 3v2H3v14h18V11h-6zm-8 8H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V9h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm6 12h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
      </div>
      <span class="mbn-label">المدن</span>
    </a>
    <a href="/dashboard/student/games" class="mbn-item <?= $dash_active==='games'?'active':'' ?>">
      <div class="mbn-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5S14.67 12 15.5 12s1.5.67 1.5 1.5S16.33 15 15.5 15zm3-3c-.83 0-1.5-.67-1.5-1.5S17.67 9 18.5 9s1.5.67 1.5 1.5S19.33 12 18.5 12z"/></svg>
      </div>
      <span class="mbn-label">العب</span>
    </a>
    <a href="#badgesSection" class="mbn-item <?= $dash_active==='badges'?'active':'' ?>" onclick="scrollTo2('badgesSection');return false">
      <div class="mbn-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0011 15.9V18H9v2h6v-2h-2v-2.1a5.01 5.01 0 003.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
      </div>
      <span class="mbn-label">شاراتي</span>
    </a>
    <a href="#" class="mbn-item" onclick="showKidToast('📊 تقدمي قريباً!');return false">
      <div class="mbn-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
      </div>
      <span class="mbn-label">تقدمي</span>
    </a>
  </div>
</nav>

<!-- ════════════════════ MAIN ════════════════════ -->
<div class="dash-main">

  <!-- ══ TOPBAR ══ -->
  <header class="dash-topbar">

    <!-- Left: Page info -->
    <div class="dt-left">
      <div class="dt-page-info">
        <div class="dt-icon-wrap"><?= $dash_emoji ?? '🏠' ?></div>
        <div class="dt-title-wrap">
          <div class="dt-title">
            <?= htmlspecialchars($dash_title ?? 'لوحتي') ?>
            <span class="dt-title-dot"></span>
          </div>
          <div class="dt-breadcrumb">
            <span>مقام</span>
            <span class="dt-bc-sep">›</span>
            <span id="dtBreadcrumbName">…</span>
            <span class="dt-bc-sep">›</span>
            <span style="color:var(--alg-green)"><?= htmlspecialchars($dash_title ?? 'لوحتي') ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Right: Actions -->
    <div class="dt-right">

      <!-- Student chip (shown on mid screens) -->
      <div class="dt-student-chip">
        <span id="dtChipName">…</span>
        <span id="dtChipBadge">🌱</span>
      </div>

      <!-- XP chip -->
      <div class="dt-xp-chip" onclick="showKidToast('⚡ ' + (_stu?_stu.xp||0:0) + ' / 500 نقطة XP!')">
        <div class="dt-xp-icon">⚡</div>
        <div class="dt-xp-info">
          <div class="dt-xp-label">نقاط التجربة</div>
          <div class="dt-xp-bar">
            <div class="dt-xp-fill" id="dtXpFill" style="width:0%"></div>
          </div>
        </div>
        <div class="dt-xp-val" id="dtXpVal">0</div>
      </div>

      <!-- Streak chip -->
      <div class="dt-streak-chip" onclick="showKidToast('🔥 ' + (_stu?_stu.streak||0:0) + ' أيام متتالية!')">
        🔥 <span class="dt-streak-num" id="dtStreakNum">0</span> يوم
      </div>

      <!-- Notifications -->
      <div class="dt-notif-btn" onclick="showKidToast('🔔 لديك إشعاران جديدان!')">
        <i class="bi bi-bell-fill"></i>
        <div class="dt-notif-badge">2</div>
      </div>

      <!-- Play button -->
      <button class="dt-play-btn" onclick="showKidToast('🎮 سيتوفر قريباً!')">
        <svg viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5S14.67 12 15.5 12s1.5.67 1.5 1.5S16.33 15 15.5 15zm3-3c-.83 0-1.5-.67-1.5-1.5S17.67 9 18.5 9s1.5.67 1.5 1.5S19.33 12 18.5 12z"/></svg>
        ابدأ اللعب
      </button>

    </div>
  </header>

  <!-- Content -->
  <div class="dash-content">
