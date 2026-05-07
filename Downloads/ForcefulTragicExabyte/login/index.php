<?php
require_once __DIR__ . '/../site/frontend/config/config.php';
$page_title  = 'تسجيل الدخول — منصة مقام';
$page_desc   = 'سجّل الدخول إلى منصة مكام التعليمية الجزائرية';
$active_page = 'login';
$body_class  = 'page-auth';
require_once __DIR__ . '/../site/frontend/includes/header.php';
?>

<style>
/* ══════════════════════════════════════
   MAKAM — LOGIN PAGE
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --green:#2D7A45;--green2:#3A9159;--green3:#46A866;
  --green-pale:#E8F5EE;--green-xpale:#F2FAF5;
  --orange:#E07824;--orange2:#C96B1A;--orange-pale:#FFF3E8;
  --gold:#E8B830;--gold2:#D4A520;--gold-pale:#FFF9E6;
  --red:#C1392B;
  --white:#fff;--cream:#FFFCF8;--warm-bg:#FFF8F2;
  --gray-100:#f5f5f5;--gray-200:#e8e8e8;--gray-400:#aaa;
  --gray-500:#777;--gray-600:#555;--gray-800:#222;
  --font:'Cairo','Tajawal',sans-serif;
  --r:16px;--r-sm:10px;--r-full:9999px;
  --sh-warm:0 8px 32px rgba(224,120,36,.14);
  --sh-green:0 8px 32px rgba(45,122,69,.14);
  --tr:all .3s cubic-bezier(.4,0,.2,1);
}
body{
  font-family:var(--font);
  background:linear-gradient(145deg,#FFF8F0 0%,#FFFCF5 40%,#F0FAF4 75%,#E8F5EE 100%);
  min-height:100vh;direction:rtl;color:var(--gray-800);overflow-x:hidden;
}

/* Blobs */
.bg-blob{position:fixed;border-radius:50%;pointer-events:none;filter:blur(70px);opacity:.13;z-index:0}
.bb-1{width:500px;height:500px;background:var(--orange);top:-180px;right:-150px;animation:blobF 10s ease-in-out infinite}
.bb-2{width:380px;height:380px;background:var(--gold);bottom:-120px;left:-100px;animation:blobF 12s ease-in-out 2s infinite}
.bb-3{width:220px;height:220px;background:var(--green);top:45%;right:35%;animation:blobF 8s ease-in-out 1s infinite}
@keyframes blobF{0%,100%{transform:scale(1) translateY(0)}50%{transform:scale(1.06) translateY(-18px)}}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:none}}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(45,122,69,.4)}70%{box-shadow:0 0 0 12px rgba(45,122,69,0)}}
@keyframes scanLine{0%{top:8%}100%{top:88%}}
@keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-8px)}40%{transform:translateX(8px)}60%{transform:translateX(-6px)}80%{transform:translateX(6px)}}
@keyframes qrBlink{0%,100%{border-color:var(--green);box-shadow:0 0 0 0 rgba(45,122,69,.4)}50%{border-color:var(--gold);box-shadow:0 0 0 6px rgba(232,184,48,.15)}}

/* ── Layout ── */
.auth-page{
  min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  padding:7rem 1.5rem 3rem;
  position:relative;z-index:1;
}
.auth-wrap{
  display:grid;grid-template-columns:1fr 1fr;
  gap:3.5rem;align-items:center;
  width:100%;max-width:1100px;
}

/* ══ LEFT SIDE — visual panel ══ */
.auth-visual{position:relative;display:flex;flex-direction:column;align-items:center;gap:2rem}
.av-logo-wrap{position:relative;display:flex;justify-content:center;align-items:center}
.av-logo-img{
  width:220px;height:220px;border-radius:50%;
  object-fit:cover;
  border:3px solid rgba(232,184,48,.25);
  box-shadow:0 20px 60px rgba(45,122,69,.2),0 4px 18px rgba(232,184,48,.12);
  animation:floatY 6s ease-in-out infinite;
  position:relative;z-index:2;
  background:var(--green-xpale);
}
.av-ring{
  position:absolute;width:270px;height:270px;border-radius:50%;
  border:2px dashed rgba(232,184,48,.3);
  animation:spin 22s linear infinite;pointer-events:none;
}
.av-ring2{
  position:absolute;width:310px;height:310px;border-radius:50%;
  border:1.5px dashed rgba(45,122,69,.15);
  animation:spin 30s linear reverse infinite;pointer-events:none;
}
.av-badge{
  position:absolute;background:var(--white);border-radius:14px;
  padding:.55rem .9rem;box-shadow:0 6px 24px rgba(0,0,0,.1);
  display:flex;align-items:center;gap:.45rem;font-weight:800;font-size:.8rem;
  border:1.5px solid rgba(232,184,48,.2);white-space:nowrap;z-index:3;
}
.av-badge i{font-size:.95rem}
.avb-1{top:0;left:-10px;color:var(--orange2);animation:floatY 3.2s ease-in-out infinite}
.avb-2{bottom:10px;left:-20px;color:var(--green);animation:floatY 3.8s ease-in-out .6s infinite}
.avb-3{top:20px;right:-20px;color:var(--gold2);animation:floatY 4s ease-in-out 1.2s infinite}

.av-info{
  background:var(--white);border-radius:20px;padding:1.5rem 1.8rem;
  box-shadow:var(--sh-warm);border:1.5px solid rgba(232,184,48,.18);
  width:100%;max-width:340px;
}
.av-info-title{font-size:1.1rem;font-weight:900;color:var(--gray-800);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.av-info-title i{color:var(--orange);font-size:1.2rem}
.av-perks{display:flex;flex-direction:column;gap:.7rem}
.av-perk{display:flex;align-items:center;gap:.7rem;font-size:.88rem;font-weight:700;color:var(--gray-600)}
.av-perk-icon{width:32px;height:32px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.av-perk-icon i{font-size:.95rem}
.api-g{background:#E8F5EE}.api-g i{color:var(--green)}
.api-o{background:#FFF3E8}.api-o i{color:var(--orange)}
.api-gold{background:#FFF9E6}.api-gold i{color:var(--gold2)}
.api-r{background:#FDECEA}.api-r i{color:var(--red)}

/* ══ RIGHT SIDE — card ══ */
.auth-card{
  background:rgba(255, 255, 255, 0.6);border-radius:28px;
  padding:2.8rem 2.5rem;
  box-shadow:0 24px 70px rgba(45,122,69,.11),0 4px 20px rgba(224,120,36,.08);
  border:2px solid rgba(255, 255, 255, 0.8);
  animation:fadeUp .6s ease;
  position:relative;overflow:hidden;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.auth-card::before{
  content:'';position:absolute;top:0;right:0;width:120px;height:120px;
  border-radius:0 28px 0 120px;
  background:linear-gradient(135deg,rgba(232,184,48,.08),rgba(224,120,36,.05));
  pointer-events:none;
}

.auth-card-header{text-align:center;margin-bottom:2rem}
.auth-card-title{font-size:1.7rem;font-weight:900;color:var(--gray-800);line-height:1.2;margin-bottom:.4rem}
.auth-card-title em{color:var(--orange);font-style:normal}
.auth-card-sub{font-size:.92rem;color:var(--gray-400);font-weight:600}

/* ── Tab switcher ── */
.tab-switch{display:flex;background:var(--green-xpale);border-radius:var(--r-full);padding:5px;margin-bottom:2rem;gap:4px;border:1.5px solid rgba(45,122,69,.1)}
.tab-btn{
  flex:1;display:flex;align-items:center;justify-content:center;gap:.5rem;
  padding:.65rem 1rem;border:none;border-radius:var(--r-full);
  font-family:var(--font);font-size:.88rem;font-weight:800;
  cursor:pointer;transition:var(--tr);background:none;color:var(--gray-400);
}
.tab-btn i{font-size:1rem}
.tab-btn.active-parent{background:linear-gradient(135deg,var(--green),var(--green2));color:var(--white);box-shadow:0 4px 14px rgba(45,122,69,.28)}
.tab-btn.active-kid{background:linear-gradient(135deg,var(--orange),var(--orange2));color:var(--white);box-shadow:0 4px 14px rgba(224,120,36,.28)}

/* ── Forms ── */
.login-panel{display:none}
.login-panel.active{display:block}

.form-group{margin-bottom:1.3rem}
.form-label{display:flex;align-items:center;gap:.4rem;font-weight:800;font-size:.88rem;color:var(--gray-600);margin-bottom:.45rem}
.form-label i{font-size:.95rem;color:var(--gray-400)}
.input-wrap{position:relative}
.form-input{
  width:100%;padding:.82rem 1rem .82rem 3rem;
  border:2px solid var(--gray-200);border-radius:var(--r);
  font-family:var(--font);font-size:.95rem;color:var(--gray-800);
  transition:var(--tr);outline:none;background:var(--green-xpale);
  direction:ltr;text-align:right;
}
.form-input::placeholder{color:var(--gray-400);direction:rtl;text-align:right}
.form-input:focus{border-color:var(--green);background:var(--white);box-shadow:0 0 0 4px rgba(45,122,69,.09)}
.form-input.err{border-color:var(--red);background:#FFF5F5}
.input-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:1.05rem;pointer-events:none;transition:var(--tr)}
.form-input:focus ~ .input-icon{color:var(--green)}
.pw-toggle{position:absolute;right:.9rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-400);font-size:1rem;transition:var(--tr);padding:.2rem}
.pw-toggle:hover{color:var(--green)}

/* Login type toggle (email / username) */
.login-type-toggle{display:flex;gap:.5rem;margin-bottom:1.3rem}
.ltt-btn{
  flex:1;display:flex;align-items:center;justify-content:center;gap:.4rem;
  padding:.5rem;border-radius:var(--r-sm);border:1.5px solid var(--gray-200);
  font-family:var(--font);font-size:.8rem;font-weight:800;cursor:pointer;
  background:var(--white);color:var(--gray-400);transition:var(--tr);
}
.ltt-btn i{font-size:.9rem}
.ltt-btn.active{border-color:var(--green);color:var(--green);background:var(--green-pale)}

/* Remember + Forgot */
.form-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
.remember-label{display:flex;align-items:center;gap:.45rem;font-size:.84rem;color:var(--gray-500);cursor:pointer;font-weight:700}
.remember-label input[type=checkbox]{accent-color:var(--green);width:15px;height:15px}
.forgot-link{font-size:.84rem;color:var(--orange2);font-weight:800;text-decoration:none}
.forgot-link:hover{text-decoration:underline}

/* Submit btn */
.btn-submit{
  display:flex;align-items:center;justify-content:center;gap:.55rem;
  width:100%;padding:.95rem;border:none;border-radius:var(--r);
  font-family:var(--font);font-size:1rem;font-weight:900;
  cursor:pointer;transition:var(--tr);line-height:1;
}
.btn-submit i{font-size:1.1rem}
.bts-green{background:linear-gradient(135deg,var(--green),var(--green2));color:var(--white);box-shadow:0 4px 18px rgba(45,122,69,.28)}
.bts-green:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(45,122,69,.38)}
.bts-orange{background:linear-gradient(135deg,var(--orange),var(--orange2));color:var(--white);box-shadow:0 4px 18px rgba(224,120,36,.28)}
.bts-orange:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.38)}

/* Info banner */
.info-banner{
  display:flex;align-items:flex-start;gap:.7rem;
  background:var(--green-pale);border:1.5px solid rgba(45,122,69,.18);
  border-radius:var(--r);padding:.85rem 1rem;margin-bottom:1.4rem;
}
.info-banner i{font-size:1.1rem;color:var(--green);flex-shrink:0;margin-top:1px}
.info-banner p{font-size:.84rem;color:var(--green);font-weight:700;line-height:1.6;margin:0}
.ib-orange{background:var(--orange-pale);border-color:rgba(224,120,36,.18)}
.ib-orange i,.ib-orange p{color:var(--orange2)}

/* Divider */
.divider{text-align:center;color:var(--gray-400);font-size:.88rem;margin:1.5rem 0;position:relative}
.divider::before{content:'';position:absolute;top:50%;right:0;left:0;height:1.5px;background:var(--gray-200)}
.divider span{background:var(--white);padding:0 .8rem;position:relative}

.auth-footer-note{text-align:center;font-size:.88rem;color:var(--gray-400);margin-top:1.3rem}
.auth-footer-note a{color:var(--green);font-weight:800;text-decoration:none}
.auth-footer-note a:hover{text-decoration:underline}

/* ══ KID WELCOME BOX ══ */
.kid-welcome-box{
  display:flex;align-items:center;gap:.9rem;
  background:rgba(255, 243, 230, 0.6);
  border:1.5px solid rgba(224,120,36,.22);
  border-radius:var(--r);padding:.85rem 1.1rem;margin-bottom:1.2rem;
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}
.kwb-icon{font-size:2rem;line-height:1;flex-shrink:0;color:var(--orange2)}
.kwb-title{font-size:1rem;font-weight:900;color:var(--orange2);margin-bottom:.18rem}
.kwb-sub{font-size:.82rem;font-weight:700;color:var(--gray-600);line-height:1.45}
.kwb-sub strong{color:var(--orange2)}

/* ══ PIN DISPLAY ══ */
.pin-display-wrap{
  background:linear-gradient(135deg,#F0FAF4,#E8F5EE);
  border:2px solid rgba(45,122,69,.18);
  border-radius:var(--r);padding:1rem 1.2rem 1.1rem;
  text-align:center;margin-bottom:1rem;cursor:pointer;
}
.pin-label{font-size:.8rem;font-weight:800;color:var(--green);margin-bottom:.65rem;
  display:flex;align-items:center;justify-content:center;gap:.3rem}
.pin-label i{font-size:.85rem}
.pin-dots{
  display:flex;align-items:center;justify-content:center;gap:.4rem;
  direction:ltr;
}
.pd{
  width:36px;height:44px;border-radius:10px;
  border:2px solid rgba(45,122,69,.25);
  background:var(--white);
  display:flex;align-items:center;justify-content:center;
  font-size:1.35rem;font-weight:900;color:var(--green);
  transition:all .15s ease;
}
.pd.filled{border-color:var(--green);background:var(--green-pale);box-shadow:0 2px 8px rgba(45,122,69,.15)}
.pd.active{border-color:var(--green2);box-shadow:0 0 0 3px rgba(45,122,69,.18);animation:pulse .6s ease infinite}
.pd-sep{font-size:.9rem;color:var(--gray-400);font-weight:700;margin:0 .1rem}

/* ══ PIN PAD ══ */
.pin-pad{
  display:grid;grid-template-columns:repeat(3,1fr);gap:.55rem;
  margin-bottom:1rem;
}
.pp-btn{
  height:52px;border:none;border-radius:12px;
  font-family:var(--font);font-size:1.4rem;font-weight:800;
  background:var(--white);color:var(--gray-800);
  box-shadow:0 2px 8px rgba(0,0,0,.08);
  cursor:pointer;transition:all .12s ease;
  display:flex;align-items:center;justify-content:center;
  border:1.5px solid var(--gray-200);
}
.pp-btn:active{transform:scale(.92);background:var(--green-pale);border-color:var(--green);color:var(--green)}
.pp-btn:hover{background:var(--green-xpale);border-color:rgba(45,122,69,.2)}
.pp-del{background:var(--orange-pale);border-color:rgba(224,120,36,.2);color:var(--orange2);font-size:1.1rem}
.pp-del:hover{background:#FFE8D6;border-color:var(--orange)}
.pp-clear{background:#FFF0F0;border-color:rgba(193,57,43,.15);color:var(--red);font-size:1rem}
.pp-clear:hover{background:#FFE0E0}

.kid-err-msg{
  display:flex;align-items:center;gap:.5rem;
  background:#FFF1F0;border:1.5px solid rgba(193,57,43,.2);
  border-radius:var(--r-sm);padding:.65rem .85rem;margin-bottom:.8rem;
  font-size:.83rem;font-weight:800;color:var(--red);
  animation:fadeUp .3s ease;
}

/* ══ QR PANEL ══ */
/* QR canvas wrap */
.qr-canvas-wrap{
  width:220px;height:220px;margin:0 auto 1rem;position:relative;
  border-radius:18px;padding:10px;
  background:var(--white);
  box-shadow:0 12px 40px rgba(45,122,69,.15),0 0 0 3px rgba(232,184,48,.2);
}
#qrCanvas{display:block;width:200px;height:200px;border-radius:10px}
.qr-refresh-btn{
  position:absolute;top:-10px;left:-10px;
  width:32px;height:32px;border-radius:50%;border:none;cursor:pointer;
  background:linear-gradient(135deg,var(--orange),var(--orange2));
  color:#fff;display:flex;align-items:center;justify-content:center;
  box-shadow:0 4px 12px rgba(224,120,36,.35);transition:var(--tr);font-size:.85rem;
}
.qr-refresh-btn:hover{transform:rotate(180deg) scale(1.1)}
.qr-code-label{
  text-align:center;margin-bottom:1rem;
}
.qr-code-label .qr-code-text{
  font-size:1.15rem;font-weight:900;letter-spacing:.22em;color:var(--green);
  background:var(--green-xpale);border:1.5px dashed rgba(45,122,69,.25);
  border-radius:10px;padding:.4rem 1rem;display:inline-block;direction:ltr;
}
.qr-code-label .qr-code-hint{font-size:.76rem;color:var(--gray-400);margin-top:.3rem;font-weight:700}

/* Scan line on canvas wrap */
.qr-canvas-wrap::after{
  content:'';position:absolute;left:16px;right:16px;height:2.5px;
  background:linear-gradient(90deg,transparent,var(--green),var(--gold),var(--green),transparent);
  border-radius:2px;box-shadow:0 0 8px rgba(45,122,69,.5);
  animation:scanLine 2s ease-in-out infinite alternate;top:30%;
  pointer-events:none;
}

/* QR action buttons */
.qr-actions{display:flex;flex-direction:column;gap:.75rem}
.qr-open-btn{
  display:flex;align-items:center;justify-content:center;gap:.55rem;
  width:100%;padding:.82rem;border:none;border-radius:var(--r);
  font-family:var(--font);font-size:.92rem;font-weight:800;
  cursor:pointer;transition:var(--tr);
  background:linear-gradient(135deg,var(--orange),var(--orange2));
  color:var(--white);box-shadow:0 4px 18px rgba(224,120,36,.28);
}
.qr-open-btn:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.38)}
.qr-open-btn i{font-size:1.05rem}

/* QR steps */
.qr-steps{
  display:flex;align-items:center;justify-content:center;gap:.3rem;
  margin-bottom:1rem;flex-wrap:wrap;
}
.qr-step{display:flex;align-items:center;gap:.4rem;font-size:.75rem;font-weight:700;color:var(--gray-400)}
.qr-step-num{
  width:22px;height:22px;border-radius:50%;
  background:linear-gradient(135deg,var(--orange),var(--orange2));
  color:var(--white);display:flex;align-items:center;justify-content:center;
  font-size:.7rem;font-weight:900;flex-shrink:0;
}
.qr-step-arrow{color:var(--gray-300);font-size:.7rem}

/* ══ KID PIN SUBMIT BTN ══ */
.bts-orange-kid{
  background:linear-gradient(135deg,var(--orange),var(--orange2));
  color:var(--white);box-shadow:0 4px 18px rgba(224,120,36,.28);
}
.bts-orange-kid:hover:not(:disabled){transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.38)}
.bts-orange-kid:disabled{opacity:.45;cursor:not-allowed;transform:none !important}

.kid-pin-form{}

/* ══ RESPONSIVE ══ */
@media(max-width:900px){
  .auth-wrap{grid-template-columns:1fr;max-width:480px;gap:2rem}
  .auth-visual{display:none}
}
@media(max-width:560px){
  .auth-card{padding:2rem 1.4rem}
  .auth-page{padding:5.5rem 1rem 2rem}
}
</style>

<!-- Bg blobs -->
<div class="bg-blob bb-1"></div>
<div class="bg-blob bb-2"></div>
<div class="bg-blob bb-3"></div>

<div class="auth-page">
  <div class="auth-wrap">

    <!-- ══ LEFT: Visual ══ -->
    <div class="auth-visual">
      <div class="av-logo-wrap">
        <div class="av-ring"></div>
        <div class="av-ring2"></div>
        <img src="/site/frontend/logo/logo-no.png" alt="مكام" class="av-logo-img">
        
      </div>

      <div class="av-info">
        <div class="av-info-title"><i class="bi bi-info-circle-fill"></i> مرحباً بك في مقام</div>
        <div class="av-perks">
          <div class="av-perk"><div class="av-perk-icon api-g"><i class="bi bi-mortarboard-fill"></i></div> تعلّم تفاعلي وممتع</div>
          <div class="av-perk"><div class="av-perk-icon api-o"><i class="bi bi-flag-fill"></i></div> محتوى جزائري أصيل</div>
          <div class="av-perk"><div class="av-perk-icon api-gold"><i class="bi bi-trophy-fill"></i></div> نظام شارات وتحديات</div>
          <div class="av-perk"><div class="av-perk-icon api-r"><i class="bi bi-people-fill"></i></div> إشراف ولي الأمر الكامل</div>
        </div>
      </div>
    </div>

    <!-- ══ RIGHT: Card ══ -->
    <div class="auth-card">
      <div class="auth-card-header">
        <h1 class="auth-card-title">أهلاً بك في <em>مقام</em></h1>
        <p class="auth-card-sub">سجّل دخولك ومتابعة رحلة التعلم</p>
      </div>

      <!-- Tab Switch -->
      <div class="tab-switch">
        <button class="tab-btn active-parent" id="btnParent" onclick="switchLoginTab('parent')">
          <i class="bi bi-people-fill"></i> ولي الأمر
        </button>
        <button class="tab-btn" id="btnKid" onclick="switchLoginTab('kid')">
          <i class="bi bi-emoji-smile-fill"></i> الطفل / الدارس
        </button>
      </div>

      <!-- ══ PARENT PANEL ══ -->
      <div class="login-panel active" id="panelParent">

        <div class="info-banner">
          <i class="bi bi-person-check-fill"></i>
          <p>سجّل الدخول باستخدام بريدك الإلكتروني أو اسم المستخدم مع كلمة المرور</p>
        </div>

        <!-- Login type toggle -->
        <div class="login-type-toggle">
          <button class="ltt-btn active" id="lttEmail" onclick="switchLoginType('email')">
            <i class="bi bi-envelope-fill"></i> البريد الإلكتروني
          </button>
          <button class="ltt-btn" id="lttUser" onclick="switchLoginType('username')">
            <i class="bi bi-at"></i> اسم المستخدم
          </button>
        </div>

        <form id="parentForm" novalidate onsubmit="submitParent(event)">
          <!-- Email / Username field -->
          <div class="form-group" id="fgEmail">
            <label class="form-label" for="p_email"><i class="bi bi-envelope-fill"></i> البريد الإلكتروني</label>
            <div class="input-wrap">
              <input type="email" id="p_email" class="form-input" placeholder="exemple@email.com" autocomplete="email">
              <i class="bi bi-envelope-fill input-icon"></i>
            </div>
          </div>
          <div class="form-group" id="fgUsername" style="display:none">
            <label class="form-label" for="p_user"><i class="bi bi-at"></i> اسم المستخدم</label>
            <div class="input-wrap">
              <input type="text" id="p_user" class="form-input" placeholder="اسم_المستخدم" autocomplete="username">
              <i class="bi bi-at input-icon"></i>
            </div>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label class="form-label" for="p_pass"><i class="bi bi-lock-fill"></i> كلمة المرور</label>
            <div class="input-wrap">
              <input type="password" id="p_pass" class="form-input" placeholder="••••••••" autocomplete="current-password">
              <i class="bi bi-lock-fill input-icon"></i>
              <button type="button" class="pw-toggle" id="pwToggleP" onclick="togglePw('p_pass','pwToggleP')">
                <i class="bi bi-eye-fill"></i>
              </button>
            </div>
          </div>

          <!-- Remember + Forgot -->
          <div class="form-meta">
            <label class="remember-label">
              <input type="checkbox" id="p_remember"> تذكّرني
            </label>
            <a href="#" class="forgot-link">نسيت كلمة المرور؟</a>
          </div>

          <button type="submit" class="btn-submit bts-green" id="btnParentSubmit">
            <i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول
          </button>
        </form>

        <div class="divider"><span>ليس لديك حساب؟</span></div>
        <div class="auth-footer-note">
          <a href="/register"><i class="bi bi-person-plus-fill"></i> إنشاء حساب مجاني الآن</a>
        </div>
      </div>

      <!-- ══ KID PANEL ══ -->
      <div class="login-panel" id="panelKid">

        <!-- بطاقة الإرشاد -->
        <div class="kid-welcome-box">
          <div class="kwb-icon"><i class="bi bi-controller"></i></div>
          <div class="kwb-text">
            <div class="kwb-title">أهلاً يا بطل!</div>
            <div class="kwb-sub">أدخل <strong>رقمك الثماني</strong> الموجود لدى ولي أمرك</div>
          </div>
        </div>

        <!-- ─── نموذج الطفل (PIN) ─── -->
        <form class="kid-pin-form" novalidate onsubmit="submitKidPin(event)">

          <!-- عرض الأرقام المُدخلة -->
          <div class="pin-display-wrap">
            <div class="pin-label"><i class="bi bi-key-fill"></i> رقمك الثماني</div>
            <div class="pin-dots" id="pinDots">
              <span class="pd"></span><span class="pd"></span><span class="pd"></span><span class="pd"></span>
              <span class="pd-sep">—</span>
              <span class="pd"></span><span class="pd"></span><span class="pd"></span><span class="pd"></span>
            </div>
            <!-- حقل مخفي للإدخال الفعلي -->
            <input type="tel" id="kid_pin_input" maxlength="8" inputmode="numeric"
                   pattern="[0-9]*" autocomplete="off"
                   style="position:absolute;opacity:0;pointer-events:none;width:1px;height:1px"
                   oninput="onPinInput(this.value)">
          </div>

          <!-- لوحة الأرقام -->
          <div class="pin-pad">
            <button type="button" class="pp-btn" onclick="pinPress('1')">1</button>
            <button type="button" class="pp-btn" onclick="pinPress('2')">2</button>
            <button type="button" class="pp-btn" onclick="pinPress('3')">3</button>
            <button type="button" class="pp-btn" onclick="pinPress('4')">4</button>
            <button type="button" class="pp-btn" onclick="pinPress('5')">5</button>
            <button type="button" class="pp-btn" onclick="pinPress('6')">6</button>
            <button type="button" class="pp-btn" onclick="pinPress('7')">7</button>
            <button type="button" class="pp-btn" onclick="pinPress('8')">8</button>
            <button type="button" class="pp-btn" onclick="pinPress('9')">9</button>
            <button type="button" class="pp-btn pp-clear" onclick="pinClear()"><i class="bi bi-x-circle-fill"></i></button>
            <button type="button" class="pp-btn" onclick="pinPress('0')">0</button>
            <button type="button" class="pp-btn pp-del" onclick="pinDelete()"><i class="bi bi-backspace-fill"></i></button>
          </div>

          <!-- رسالة خطأ -->
          <div class="kid-err-msg" id="kidErrMsg" style="display:none">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span id="kidErrText">الرقم غير صحيح — اسأل ولي أمرك!</span>
          </div>

          <!-- زر الدخول -->
          <button type="submit" class="btn-submit bts-orange-kid" id="btnKidSubmit" disabled>
            <i class="bi bi-lightning-fill"></i> دخول وتعلّم!
          </button>

        </form>

        <div class="divider"><span>مشكلة في الدخول؟</span></div>
        <div class="auth-footer-note">اسأل ولي أمرك أو <a href="#" onclick="switchLoginTab('parent');return false">سجّل الدخول كولي أمر</a></div>
      </div>

    </div><!-- /auth-card -->
  </div><!-- /auth-wrap -->
</div><!-- /auth-page -->

<script>
/* ══════════════════════════════
   TAB SWITCHERS
══════════════════════════════ */
function switchLoginTab(tab){
  var isParent = tab === 'parent';
  document.getElementById('panelParent').classList.toggle('active', isParent);
  document.getElementById('panelKid').classList.toggle('active', !isParent);
  document.getElementById('btnParent').className = 'tab-btn' + (isParent ? ' active-parent' : '');
  document.getElementById('btnKid').className   = 'tab-btn' + (!isParent ? ' active-kid' : '');
  /* kid panel — no QR needed */
}

function switchKidMethod(method){ /* legacy — tabs removed */ }

/* ══════════════════════════════
   PARENT LOGIN TYPE (email/user)
══════════════════════════════ */
var currentLoginType = 'email';
function switchLoginType(type){
  currentLoginType = type;
  var isEmail = type === 'email';
  document.getElementById('fgEmail').style.display    = isEmail ? '' : 'none';
  document.getElementById('fgUsername').style.display = isEmail ? 'none' : '';
  document.getElementById('lttEmail').classList.toggle('active', isEmail);
  document.getElementById('lttUser').classList.toggle('active', !isEmail);
}

/* ══════════════════════════════
   PASSWORD TOGGLE
══════════════════════════════ */
function togglePw(inputId, btnId){
  var el   = document.getElementById(inputId);
  var btn  = document.getElementById(btnId);
  var show = el.type === 'password';
  el.type  = show ? 'text' : 'password';
  btn.querySelector('i').className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
}

/* ══════════════════════════════
   PARENT SUBMIT
══════════════════════════════ */
function submitParent(e){
  e.preventDefault();
  var val  = currentLoginType === 'email'
             ? document.getElementById('p_email').value.trim()
             : document.getElementById('p_user').value.trim();
  var pass = document.getElementById('p_pass').value;
  if(!val || !pass){
    if(!val)  document.getElementById(currentLoginType === 'email' ? 'p_email' : 'p_user').classList.add('err');
    if(!pass) document.getElementById('p_pass').classList.add('err');
    setTimeout(function(){ document.querySelectorAll('.err').forEach(function(el){el.classList.remove('err');}); }, 2000);
    return;
  }
  var btn = document.getElementById('btnParentSubmit');
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري التحقق...';

  fetch('/api/auth_login', {
    method : 'POST',
    headers: {'Content-Type': 'application/json'},
    body   : JSON.stringify({ type: 'parent', login: val, password: pass }),
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول';
    if(res.ok){
      showToast('أهلاً ' + res.data.fname + '! جاري تحويلك...', 'green');
      sessionStorage.setItem('makam_user', JSON.stringify(res.data));
      if (res.data.type === 'admin') {
        setTimeout(function(){ window.location.href = '/dashboard/admin/index.php'; }, 1200);
      } else {
        setTimeout(function(){ window.location.href = '/dashboard/profiles'; }, 1200);
      }
    } else {
      showToast(res.error || 'خطأ في تسجيل الدخول', 'orange');
    }
  })
  .catch(function(){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول';
    showToast('تعذّر الاتصال بالخادم، حاول مجدداً', 'orange');
  });
}

/* ══════════════════════════════
   QR GENERATOR (canvas)
══════════════════════════════ */
var currentQrCode = '';

function generateQR(){
  var canvas = document.getElementById('qrCanvas');
  if(!canvas) return;
  var ctx = canvas.getContext('2d');
  var size = 200;
  var cells = 21;
  var cell  = Math.floor(size / cells);

  /* random seed */
  var chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
  var code  = 'MAQ-';
  for(var i=0;i<4;i++) code += chars[Math.floor(Math.random()*chars.length)];
  currentQrCode = code;
  document.getElementById('qrCodeDisplay').textContent = code;

  /* seeded pseudo-random from code */
  var seed = 0;
  for(var c=0;c<code.length;c++) seed = (seed*31 + code.charCodeAt(c)) & 0xFFFFFF;
  function rand(){ seed = (seed * 1664525 + 1013904223) & 0xFFFFFFFF; return (seed>>>0)/0xFFFFFFFF; }

  /* background */
  ctx.fillStyle = '#ffffff';
  ctx.fillRect(0,0,size,size);

  /* draw modules */
  for(var row=0;row<cells;row++){
    for(var col=0;col<cells;col++){
      var x = col*cell, y = row*cell;
      /* finder patterns (top-left, top-right, bottom-left) */
      var inFinder = isFinderPattern(row,col,cells);
      var dark;
      if(inFinder){
        dark = isFinderDark(row,col,cells);
      } else {
        dark = rand() > 0.52;
      }
      if(dark){
        ctx.fillStyle = '#1A3A26';
        var r = 2;
        roundRect(ctx, x+1, y+1, cell-2, cell-2, r);
        ctx.fill();
      }
    }
  }

  /* gold accent dots */
  ctx.fillStyle = 'rgba(232,184,48,.55)';
  for(var d=0;d<6;d++){
    var dr = Math.floor(rand()*(cells-2))+1;
    var dc = Math.floor(rand()*(cells-2))+1;
    if(!isFinderPattern(dr,dc,cells)){
      ctx.beginPath();
      ctx.arc(dc*cell+cell/2, dr*cell+cell/2, cell*0.32, 0, Math.PI*2);
      ctx.fill();
    }
  }

  /* center logo square */
  var cx = Math.floor(cells/2)*cell - cell;
  var cw = cell*3;
  ctx.fillStyle = '#fff';
  roundRect(ctx, cx-2, cx-2, cw+4, cw+4, 6); ctx.fill();
  ctx.fillStyle = '#2D7A45';
  roundRect(ctx, cx+1, cx+1, cw-2, cw-2, 5); ctx.fill();
  ctx.fillStyle = '#fff';
  ctx.font = 'bold '+(cell+1)+'px Cairo,sans-serif';
  ctx.textAlign='center'; ctx.textBaseline='middle';
  ctx.fillText('M', cx+cw/2, cx+cw/2+1);
}

function roundRect(ctx,x,y,w,h,r){
  ctx.beginPath();
  ctx.moveTo(x+r,y);
  ctx.lineTo(x+w-r,y); ctx.quadraticCurveTo(x+w,y,x+w,y+r);
  ctx.lineTo(x+w,y+h-r); ctx.quadraticCurveTo(x+w,y+h,x+w-r,y+h);
  ctx.lineTo(x+r,y+h); ctx.quadraticCurveTo(x,y+h,x,y+h-r);
  ctx.lineTo(x,y+r); ctx.quadraticCurveTo(x,y,x+r,y);
  ctx.closePath();
}

function isFinderPattern(r,c,n){
  /* top-left */
  if(r<8 && c<8) return true;
  /* top-right */
  if(r<8 && c>=n-8) return true;
  /* bottom-left */
  if(r>=n-8 && c<8) return true;
  return false;
}

function isFinderDark(r,c,n){
  function check(br,bc){
    var lr=r-br, lc=c-bc;
    if(lr<0||lr>6||lc<0||lc>6) return false;
    if(lr===0||lr===6||lc===0||lc===6) return true;
    if(lr>=2&&lr<=4&&lc>=2&&lc<=4) return true;
    return false;
  }
  if(r<8&&c<8   && check(0,0))   return true;
  if(r<8&&c>=n-8 && check(0,n-7)) return true;
  if(r>=n-8&&c<8 && check(n-7,0)) return true;
  return false;
}

/* ══════════════════════════════
   QR CAMERA
══════════════════════════════ */
function openQrCamera(){
  showToast('📷 المسح بالكاميرا سيكون متاحاً في النسخة الكاملة!', 'orange');
}

/* ══════════════════════════════
   KID PIN PAD
══════════════════════════════ */
var kidPin = '';

function pinPress(digit){
  if(kidPin.length >= 8) return;
  kidPin += digit;
  updatePinDisplay();
}
function pinDelete(){
  if(!kidPin.length) return;
  kidPin = kidPin.slice(0, -1);
  updatePinDisplay();
}
function pinClear(){
  kidPin = '';
  updatePinDisplay();
  hideKidErr();
}
function onPinInput(val){
  kidPin = val.replace(/\D/g,'').slice(0,8);
  updatePinDisplay();
}
function updatePinDisplay(){
  var dots = document.querySelectorAll('#pinDots .pd');
  dots.forEach(function(dot, i){
    var d = kidPin[i];
    if(d !== undefined){
      dot.textContent = '●';
      dot.classList.add('filled');
      dot.classList.remove('active');
    } else if(i === kidPin.length){
      dot.textContent = '';
      dot.classList.remove('filled');
      dot.classList.add('active');
    } else {
      dot.textContent = '';
      dot.classList.remove('filled','active');
    }
  });
  var inp = document.getElementById('kid_pin_input');
  if(inp) inp.value = kidPin;
  var btn = document.getElementById('btnKidSubmit');
  btn.disabled = kidPin.length !== 8;
}

function submitKidPin(e){
  e.preventDefault();
  if(kidPin.length !== 8) return;
  hideKidErr();
  var btn = document.getElementById('btnKidSubmit');
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري التحقق...';

  fetch('/api/auth_login', {
    method : 'POST',
    headers: {'Content-Type':'application/json'},
    body   : JSON.stringify({ type:'child', login: kidPin, password: kidPin }),
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(!res.ok){
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-lightning-fill"></i> دخول وتعلّم!';
      showKidErr('الرقم غير صحيح — اسأل ولي أمرك!');
      /* اهتزاز لوحة الأرقام */
      var dots = document.getElementById('pinDots');
      dots.style.animation = 'shake .4s ease';
      setTimeout(function(){ dots.style.animation = ''; pinClear(); }, 450);
      return;
    }
    /* دخول مباشر — حفظ الجلسة والتحويل */
    sessionStorage.setItem('makam_user', JSON.stringify(res.data));
    showToast('مرحباً يا ' + res.data.fname + '!', 'green');
    setTimeout(function(){ 
      var age = parseInt(res.data.age) || 0;
      var cat = 1;
      if (age >= 8 && age <= 11) cat = 2;
      else if (age >= 12) cat = 3;
      window.location.href = '/dashboard/student?category=' + cat; 
    }, 1100);
  })
  .catch(function(){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-lightning-fill"></i> دخول وتعلّم!';
    showToast('تعذّر الاتصال بالخادم، حاول مجدداً', 'orange');
  });
}

function showKidErr(msg){
  var box = document.getElementById('kidErrMsg');
  document.getElementById('kidErrText').textContent = msg;
  box.style.display = 'flex';
}
function hideKidErr(){
  var box = document.getElementById('kidErrMsg');
  if(box) box.style.display = 'none';
}

/* ══════════════════════════════
   TOAST
══════════════════════════════ */
function showToast(msg, type){
  var old = document.getElementById('maqToast');
  if(old) old.remove();
  var t = document.createElement('div');
  t.id = 'maqToast';
  t.style.cssText = [
    'position:fixed;bottom:2rem;left:50%;transform:translateX(-50%)',
    'background:' + (type==='green' ? 'var(--green)' : 'var(--orange)'),
    'color:#fff;font-family:var(--font);font-weight:800;font-size:.9rem',
    'padding:.85rem 1.8rem;border-radius:50px;box-shadow:0 8px 28px rgba(0,0,0,.2)',
    'z-index:9999;animation:fadeUp .4s ease;max-width:90vw;text-align:center;direction:rtl'
  ].join(';');
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(function(){ t.style.opacity='0'; t.style.transition='opacity .4s'; setTimeout(function(){ t.remove(); }, 400); }, 3200);
}

/* ══════════════════════════════
   INIT
══════════════════════════════ */
document.addEventListener('DOMContentLoaded', function(){
  /* تهيئة عرض PIN */
  updatePinDisplay();
  /* دعم الكيبورد للأرقام */
  document.addEventListener('keydown', function(e){
    if(document.getElementById('panelKid').classList.contains('active')){
      if(e.key >= '0' && e.key <= '9') pinPress(e.key);
      else if(e.key === 'Backspace') pinDelete();
      else if(e.key === 'Escape') pinClear();
    }
  });
});
</script>

<?php require_once __DIR__ . '/../site/frontend/includes/footer.php'; ?>
