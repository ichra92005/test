<?php
require_once __DIR__ . '/../site/frontend/config/config.php';
$page_title  = 'إنشاء حساب — منصة مكام';
$page_desc   = 'سجّل كولي أمر وأنشئ ملف طفلك على منصة مكام التعليمية الجزائرية';
$active_page = 'register';
$body_class  = 'page-auth';
require_once __DIR__ . '/../site/frontend/includes/header.php';
?>

<style>
/* ══════════════════════════════════════
   MAKAM — REGISTER PAGE (LIGHT MODE)
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --green:#2D7A45;--green2:#3A9159;--green3:#46A866;
  --green-pale:#E8F5EE;--green-xpale:#F2FAF5;
  --orange:#E07824;--orange2:#C96B1A;--orange-pale:#FFF3E8;
  --gold:#E8B830;--gold2:#D4A520;--gold-pale:#FFF9E6;
  --red:#C1392B;--red-pale:#FDECEA;
  --white:#fff;--cream:#FFFCF8;--warm-bg:#FFF8F2;
  --gray-100:#f5f5f5;--gray-200:#e8e8e8;--gray-300:#d0d0d0;
  --gray-400:#aaa;--gray-500:#777;--gray-600:#555;--gray-800:#222;
  --font:'Cairo','Tajawal',sans-serif;
  --r:16px;--r-sm:10px;--r-full:9999px;
  --sh:0 4px 24px rgba(0,0,0,.07);
  --sh-green:0 8px 32px rgba(45,122,69,.18);
  --sh-orange:0 8px 32px rgba(224,120,36,.18);
  --tr:all .3s cubic-bezier(.4,0,.2,1);
}
body{
  font-family:var(--font);
  background: linear-gradient(145deg,#F0FFF6 0%,#FFF8F0 50%,#F5F0FF 100%);
  min-height:100vh;direction:rtl;color:var(--gray-800);overflow-x:hidden;
}

/* ── Soft blobs ── */
.bg-blob{position:fixed;border-radius:50%;pointer-events:none;filter:blur(90px);opacity:.45;z-index:0}
.bb-1{width:500px;height:500px;background:#CCEED9;top:-180px;right:-150px;animation:blobF 10s ease-in-out infinite}
.bb-2{width:380px;height:380px;background:#FFE8CE;bottom:-120px;left:-100px;animation:blobF 12s ease-in-out 2s infinite}
.bb-3{width:220px;height:220px;background:#E8DCFF;top:45%;right:35%;animation:blobF 8s ease-in-out 1s infinite}
@keyframes blobF{0%,100%{transform:scale(1) translateY(0)}50%{transform:scale(1.06) translateY(-18px)}}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:none}}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@keyframes slideIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:none}}
@keyframes slideOut{from{opacity:1;transform:none}to{opacity:0;transform:translateX(-30px)}}
@keyframes successPop{0%{transform:scale(0)}60%{transform:scale(1.12)}100%{transform:scale(1)}}

/* ── Layout ── */
.auth-page{
  min-height:100vh;display:flex;align-items:center;justify-content:center;
  padding:7rem 1.5rem 3rem;position:relative;z-index:1;
}
.auth-wrap{
  display:grid;grid-template-columns:1fr 1fr;
  gap:3.5rem;align-items:flex-start;
  width:100%;max-width:1160px;
}

/* ══ LEFT SIDE ══ */
.auth-visual{position:sticky;top:7rem;display:flex;flex-direction:column;align-items:center;gap:2rem}
.av-logo-wrap{position:relative;display:flex;justify-content:center;align-items:center}
.av-logo-img{
  width:200px;height:200px;border-radius:50%;object-fit:cover;
  border:3px solid rgba(45,122,69,.15);
  box-shadow:0 20px 60px rgba(45,122,69,.15);
  animation:floatY 6s ease-in-out infinite;position:relative;z-index:2;
  background:var(--green-xpale);
}
.av-ring{position:absolute;width:255px;height:255px;border-radius:50%;border:2px dashed rgba(45,122,69,.2);animation:spin 22s linear infinite;pointer-events:none}
.av-ring2{position:absolute;width:296px;height:296px;border-radius:50%;border:1.5px dashed rgba(45,122,69,.1);animation:spin 30s linear reverse infinite;pointer-events:none}
.av-badge{
  position:absolute;background:#fff;border-radius:14px;
  padding:.5rem .9rem;box-shadow:0 6px 24px rgba(0,0,0,.1);
  display:flex;align-items:center;gap:.45rem;font-weight:800;font-size:.78rem;
  border:1.5px solid var(--gray-200);white-space:nowrap;z-index:3;
  color:var(--gray-700);
}
.av-badge i{font-size:.92rem;color:var(--green)}
.avb-1{top:0;left:-10px;animation:floatY 3.2s ease-in-out infinite}
.avb-2{bottom:10px;left:-20px;animation:floatY 3.8s ease-in-out .6s infinite}
.avb-3{top:20px;right:-20px;animation:floatY 4s ease-in-out 1.2s infinite}

.av-info{
  background:#fff;border-radius:20px;padding:1.4rem 1.6rem;
  box-shadow:var(--sh);border:1.5px solid var(--gray-200);
  width:100%;max-width:320px;
}
.av-info-title{font-size:1rem;font-weight:900;color:var(--gray-800);margin-bottom:.85rem;display:flex;align-items:center;gap:.5rem}
.av-info-title i{color:var(--green);font-size:1.1rem}
.av-perks{display:flex;flex-direction:column;gap:.6rem}
.av-perk{display:flex;align-items:center;gap:.65rem;font-size:.85rem;font-weight:700;color:var(--gray-600)}
.av-perk-icon{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.av-perk-icon i{font-size:.88rem;color:#fff}
.api-g{background:var(--green)}
.api-o{background:var(--orange)}
.api-gold{background:var(--gold2)}
.api-r{background:var(--red)}

/* ══ RIGHT SIDE — Card ══ */
.auth-card{
  background:#fff;
  border-radius:24px;
  padding:2.5rem 2.2rem;
  box-shadow:0 8px 48px rgba(0,0,0,.09);
  border:1.5px solid var(--gray-200);
  animation:fadeUp .6s ease;position:relative;overflow:hidden;
}
.auth-card::before{
  content:'';position:absolute;top:0;right:0;width:110px;height:110px;
  border-radius:0 24px 0 110px;
  background:linear-gradient(135deg,var(--green-pale),transparent);
  pointer-events:none;
}

/* ── Progress bar ── */
.reg-progress{margin-bottom:2rem}
.reg-steps-row{display:flex;align-items:center;justify-content:center;gap:0;margin-bottom:.8rem}
.reg-step-circle{
  width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-weight:900;font-size:.88rem;border:2.5px solid var(--gray-200);
  background:var(--gray-100);color:var(--gray-400);transition:var(--tr);position:relative;z-index:1;
}
.reg-step-circle.done{
  background:var(--green);border-color:var(--green);color:#fff;
  box-shadow:0 4px 14px rgba(45,122,69,.3);
}
.reg-step-circle.active{
  background:var(--green);border-color:var(--green);color:#fff;
  box-shadow:0 4px 14px rgba(45,122,69,.3);
}
.reg-step-line{flex:1;height:3px;background:var(--gray-200);transition:var(--tr);margin:0 -1px}
.reg-step-line.done{background:linear-gradient(to left,var(--green),var(--green2))}
.reg-steps-labels{display:flex;justify-content:space-between;padding:0 4px}
.reg-step-label{font-size:.72rem;font-weight:800;color:var(--gray-400);text-align:center;flex:1;transition:var(--tr)}
.reg-step-label.active{color:var(--green)}
.reg-step-label.done{color:var(--green)}

/* ── Step panels ── */
.reg-step-panel{display:none;animation:slideIn .4s ease}
.reg-step-panel.active{display:block}

/* ── Section sub-title ── */
.step-heading{margin-bottom:1.6rem}
.step-title{font-size:1.35rem;font-weight:900;color:var(--gray-800);line-height:1.2;margin-bottom:.3rem}
.step-title em{color:var(--green);font-style:normal}
.step-sub{font-size:.85rem;color:var(--gray-500);font-weight:600}

/* ── Info banner ── */
.info-banner{
  display:flex;align-items:flex-start;gap:.65rem;
  border-radius:var(--r);padding:.8rem .95rem;margin-bottom:1.4rem;
}
.info-banner i{font-size:1.05rem;flex-shrink:0;margin-top:1px}
.info-banner p{font-size:.82rem;font-weight:700;line-height:1.6;margin:0}
.ib-green{background:var(--green-xpale);border:1.5px solid rgba(45,122,69,.15)}
.ib-green i{color:var(--green)}
.ib-green p{color:var(--green)}

/* ── Form fields ── */
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:.9rem}
.form-group{margin-bottom:1.1rem}
.form-label{display:flex;align-items:center;gap:.38rem;font-weight:700;font-size:.84rem;color:var(--gray-700);margin-bottom:.4rem}
.form-label i{font-size:.9rem;color:var(--gray-400)}
.form-label .req{color:var(--red);margin-right:1px}
.input-wrap{position:relative}
.form-input{
  width:100%;padding:.78rem 1rem .78rem 2.8rem;
  border:1.5px solid var(--gray-200);border-radius:12px;
  font-family:var(--font);font-size:.92rem;color:var(--gray-800);
  transition:var(--tr);outline:none;background:var(--gray-100);
  direction:rtl;
}
.form-input::placeholder{color:var(--gray-400)}
.form-input:focus{border-color:var(--green);background:#fff;box-shadow:0 0 0 4px rgba(45,122,69,.08)}
.form-input.err{border-color:var(--red);background:var(--red-pale)}
.form-input.ok{border-color:var(--green);background:#fff}
.input-icon{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:1rem;pointer-events:none;transition:var(--tr)}
.form-input:focus ~ .input-icon{color:var(--green)}
.pw-toggle{position:absolute;right:.85rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-400);font-size:.95rem;padding:.2rem;transition:var(--tr)}
.pw-toggle:hover{color:var(--gray-700)}
.field-hint{font-size:.74rem;color:var(--gray-500);margin-top:.3rem;font-weight:600;display:flex;align-items:center;gap:.3rem}
.field-hint i{font-size:.8rem}
.field-err{font-size:.75rem;color:var(--red);margin-top:.3rem;font-weight:700;display:none;align-items:center;gap:.3rem}
.field-err.show{display:flex}
.field-err i{font-size:.8rem}

/* Password strength */
.pw-strength-bar{height:4px;border-radius:3px;margin-top:.4rem;background:var(--gray-200);overflow:hidden}
.pw-strength-fill{height:100%;border-radius:3px;width:0;transition:width .4s,background .4s}

/* CAPTCHA */
.captcha-wrap{
  background:var(--gray-100);border:1.5px solid var(--gray-200);
  border-radius:12px;padding:1rem 1.1rem;margin-bottom:1.2rem;
}
.captcha-label{font-size:.82rem;font-weight:700;color:var(--gray-600);margin-bottom:.6rem;display:flex;align-items:center;gap:.4rem}
.captcha-label i{color:var(--green);font-size:.9rem}
.captcha-equation{
  display:flex;align-items:center;gap:.7rem;margin-bottom:.7rem;flex-wrap:wrap;
}
.captcha-num{
  background:#fff;color:var(--gray-800);
  font-size:1.3rem;font-weight:900;padding:.35rem .8rem;border-radius:8px;
  font-family:monospace;min-width:44px;text-align:center;
  border:1.5px solid var(--gray-200);
}
.captcha-op{font-size:1.4rem;font-weight:900;color:var(--gray-600)}
.captcha-eq{font-size:1.2rem;color:var(--gray-500);font-weight:900}
.captcha-input{
  width:80px;padding:.55rem .7rem;border:1.5px solid var(--gray-300);
  border-radius:8px;font-family:var(--font);font-size:1.1rem;font-weight:900;
  text-align:center;color:var(--gray-800);background:#fff;
  outline:none;transition:var(--tr);direction:ltr;
}
.captcha-input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(45,122,69,.08)}
.captcha-input.err{border-color:var(--red);background:var(--red-pale)}
.captcha-input.ok{border-color:var(--green);background:var(--green-xpale)}
.captcha-refresh{
  background:none;border:none;cursor:pointer;color:var(--gray-400);
  font-size:.85rem;transition:var(--tr);padding:.2rem;
}
.captcha-refresh:hover{color:var(--green);transform:rotate(180deg)}

/* Terms checkbox */
.terms-check{
  display:flex;align-items:flex-start;gap:.75rem;
  background:var(--gray-100);border:1.5px solid var(--gray-200);
  border-radius:12px;padding:.9rem 1rem;margin-bottom:1.4rem;
  cursor:pointer;user-select:none;transition:var(--tr);
}
.terms-check:hover{background:var(--green-xpale);border-color:rgba(45,122,69,.3)}
.terms-check input[type=checkbox]{display:none}
.terms-box{
  width:22px;height:22px;border-radius:6px;border:2.5px solid var(--gray-300);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  background:#fff;transition:var(--tr);margin-top:1px;
}
.terms-check.checked .terms-box{background:var(--green);border-color:var(--green);box-shadow:0 2px 8px rgba(45,122,69,.3)}
.terms-box i{font-size:.75rem;color:#fff;opacity:0;transition:var(--tr)}
.terms-check.checked .terms-box i{opacity:1}
.terms-text{font-size:.82rem;color:var(--gray-600);font-weight:700;line-height:1.6}
.terms-text a{color:var(--green);text-decoration:none;font-weight:900}
.terms-text a:hover{text-decoration:underline}

/* Buttons */
.reg-actions{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-top:2rem}
.btn{
  padding:.85rem 1.6rem;border-radius:12px;font-family:var(--font);
  font-size:.95rem;font-weight:800;cursor:pointer;border:none;
  display:inline-flex;align-items:center;justify-content:center;gap:.6rem;
  transition:var(--tr);
}
.btn-next{background:var(--green);color:#fff;box-shadow:var(--sh-green);flex:2}
.btn-next:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(45,122,69,.35)}
.btn-next:disabled{opacity:.6;cursor:not-allowed;transform:none}
.btn-prev{background:var(--gray-100);color:var(--gray-600);border:1.5px solid var(--gray-200);flex:1}
.btn-prev:hover{background:var(--gray-200)}
.btn-submit{
  display:inline-flex;align-items:center;justify-content:center;gap:.6rem;
  padding:.85rem 1.6rem;border-radius:12px;font-family:var(--font);
  font-size:.95rem;font-weight:800;cursor:pointer;border:none;
  transition:var(--tr);width:100%;
}
.bts-green{background:linear-gradient(135deg,var(--green),var(--green2));color:#fff;box-shadow:var(--sh-green)}
.bts-green:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(45,122,69,.38)}
.bts-orange{background:linear-gradient(135deg,var(--orange),var(--orange2));color:#fff;box-shadow:var(--sh-orange)}
.bts-orange:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.38)}
.btn-back{
  display:flex;align-items:center;justify-content:center;gap:.45rem;
  width:100%;padding:.75rem;border:2px solid var(--gray-200);border-radius:var(--r);
  font-family:var(--font);font-size:.9rem;font-weight:800;
  cursor:pointer;background:#fff;color:var(--gray-500);
  transition:var(--tr);margin-bottom:.7rem;
}
.btn-back:hover{border-color:var(--green);color:var(--green);background:var(--green-xpale)}

/* Divider */
.divider{text-align:center;color:var(--gray-400);font-size:.85rem;margin:1.3rem 0;position:relative}
.divider::before{content:'';position:absolute;top:50%;right:0;left:0;height:1.5px;background:var(--gray-200)}
.divider span{background:#fff;padding:0 .8rem;position:relative}
.auth-footer-note{text-align:center;font-size:.86rem;color:var(--gray-500);margin-top:1.1rem}
.auth-footer-note a{color:var(--green);font-weight:800;text-decoration:none}
.auth-footer-note a:hover{text-decoration:underline}

/* ── SUCCESS SCREEN ── */
.success-screen{display:none;text-align:center;padding:1.5rem .5rem 1rem;animation:fadeUp .6s ease}
.success-screen.show{display:block}
.success-icon{
  width:90px;height:90px;border-radius:50%;margin:0 auto 1.2rem;
  background:linear-gradient(135deg,var(--green),var(--green2));
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 12px 36px rgba(45,122,69,.3);
  animation:successPop .6s cubic-bezier(.175,.885,.32,1.275);
}
.success-icon i{font-size:2.5rem;color:#fff}
.success-title{font-size:1.5rem;font-weight:900;color:var(--gray-800);margin-bottom:.5rem}
.success-title em{color:var(--green);font-style:normal}
.success-desc{font-size:.92rem;color:var(--gray-500);line-height:1.75;margin-bottom:1.5rem}
.success-details{
  background:var(--green-xpale);border:1.5px solid rgba(45,122,69,.15);
  border-radius:var(--r);padding:1rem 1.2rem;margin-bottom:1.5rem;text-align:right;
}
.success-row{display:flex;align-items:center;justify-content:space-between;font-size:.86rem;padding:.35rem 0;border-bottom:1px solid rgba(45,122,69,.08)}
.success-row:last-child{border-bottom:none}
.success-row span:first-child{color:var(--gray-500);font-weight:700}
.success-row span:last-child{color:var(--green);font-weight:900}

/* ── RESPONSIVE ── */
@media(max-width:980px){
  .auth-wrap{grid-template-columns:1fr;max-width:520px;gap:2rem}
  .auth-visual{display:none}
}
@media(max-width:560px){
  .auth-card{padding:1.8rem 1.2rem}
  .auth-page{padding:5.5rem .9rem 2rem}
  .form-row{grid-template-columns:1fr}
}
</style>

<!-- Blobs -->
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
        <img src="/site/frontend/logo/logo-no.png" alt="مقــــام " class="av-logo-img">
        
      </div>
      <div class="av-info">
        <div class="av-info-title"><i class="bi bi-stars" style="color:var(--green)"></i> لماذا مقــــام ؟</div>
        <div class="av-perks">
          <div class="av-perk"><div class="av-perk-icon api-g"><i class="bi bi-mortarboard-fill"></i></div> تعلّم تفاعلي بالمنهج الجزائري</div>
          <div class="av-perk"><div class="av-perk-icon api-g"><i class="bi bi-graph-up-arrow"></i></div> تتبع تقدم طفلك لحظة بلحظة</div>
          <div class="av-perk"><div class="av-perk-icon api-g"><i class="bi bi-trophy-fill"></i></div> نظام شارات وجوائز تحفيزية</div>
          <div class="av-perk"><div class="av-perk-icon api-g"><i class="bi bi-people-fill"></i></div> ملفات لجميع أطفالك من حساب واحد</div>
        </div>
      </div>
    </div>

    <!-- ══ RIGHT: Card ══ -->
    <div class="auth-card" id="authCard">

      <!-- Progress -->
      <div class="reg-progress" id="regProgress">
        <div class="reg-steps-row">
          <div class="reg-step-circle active" id="sc1"><i class="bi bi-people-fill" style="font-size:.85rem"></i></div>
          <div class="reg-step-line" id="sl1"></div>
          <div class="reg-step-circle" id="sc2"><i class="bi bi-person-heart" style="font-size:.85rem"></i></div>
        </div>
        <div class="reg-steps-labels">
          <div class="reg-step-label active" id="slb1">معلومات الوالي</div>
          <div class="reg-step-label" id="slb2">معلومات الطفل</div>
        </div>
      </div>

      <!-- ═══ STEP 1: Parent ═══ -->
      <div class="reg-step-panel active" id="step1">
        <div class="step-heading">
          <div class="step-title"><i class="bi bi-people-fill" style="color:var(--green);font-size:1.1rem"></i> معلومات <em>ولي الأمر</em></div>
          <div class="step-sub">ستستخدم هذه البيانات لتسجيل الدخول ومتابعة أطفالك</div>
        </div>

        <div class="info-banner ib-green">
          <i class="bi bi-person-check-fill"></i>
          <p>الحساب خاص بالوالدين فقط — معلومات الطفل في الخطوة التالية
          </p>
        </div>

        <form id="form1" novalidate onsubmit="goStep2(event)">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="p_fname"><i class="bi bi-person-fill"></i> الاسم <span class="req">*</span></label>
              <div class="input-wrap">
                <input type="text" id="p_fname" class="form-input" placeholder="مثال: أحمد" autocomplete="given-name">
                <i class="bi bi-person-fill input-icon"></i>
              </div>
              <div class="field-err" id="err_p_fname"><i class="bi bi-exclamation-circle-fill"></i> هذا الحقل مطلوب</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="p_lname"><i class="bi bi-person-fill"></i> اللقب <span class="req">*</span></label>
              <div class="input-wrap">
                <input type="text" id="p_lname" class="form-input" placeholder="مثال: بن علي" autocomplete="family-name">
                <i class="bi bi-person-fill input-icon"></i>
              </div>
              <div class="field-err" id="err_p_lname"><i class="bi bi-exclamation-circle-fill"></i> هذا الحقل مطلوب</div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="p_email"><i class="bi bi-envelope-fill"></i> البريد الإلكتروني <span class="req">*</span></label>
            <div class="input-wrap">
              <input type="email" id="p_email" class="form-input" placeholder="exemple@email.com" autocomplete="email" oninput="validateEmail(this)" style="direction:ltr;text-align:right">
              <i class="bi bi-envelope-fill input-icon"></i>
            </div>
            <div class="field-err" id="err_p_email"><i class="bi bi-exclamation-circle-fill"></i> بريد إلكتروني غير صحيح</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="p_pass"><i class="bi bi-lock-fill"></i> كلمة المرور <span class="req">*</span></label>
            <div class="input-wrap">
              <input type="password" id="p_pass" class="form-input" placeholder="8 أحرف على الأقل" autocomplete="new-password" oninput="checkPwStrength(this)">
              <i class="bi bi-lock-fill input-icon"></i>
              <button type="button" class="pw-toggle" id="pt1" onclick="togglePw('p_pass','pt1')"><i class="bi bi-eye-fill"></i></button>
            </div>
            <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwFill"></div></div>
            <div class="field-hint" id="pwHint"><i class="bi bi-info-circle"></i> 8 أحرف فأكثر مع أرقام</div>
            <div class="field-err" id="err_p_pass"><i class="bi bi-exclamation-circle-fill"></i> كلمة المرور ضعيفة (8 أحرف على الأقل)</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="p_pass2"><i class="bi bi-lock-fill"></i> تأكيد كلمة المرور <span class="req">*</span></label>
            <div class="input-wrap">
              <input type="password" id="p_pass2" class="form-input" placeholder="أعد كتابة كلمة المرور" autocomplete="new-password" oninput="checkPwMatch(this)">
              <i class="bi bi-lock-fill input-icon"></i>
              <button type="button" class="pw-toggle" id="pt2" onclick="togglePw('p_pass2','pt2')"><i class="bi bi-eye-fill"></i></button>
            </div>
            <div class="field-err" id="err_p_pass2"><i class="bi bi-exclamation-circle-fill"></i> كلمتا المرور غير متطابقتين</div>
          </div>

          <button type="submit" class="btn-submit bts-green">
            <i class="bi bi-arrow-left-short" style="font-size:1.3rem"></i> التالي — معلومات الطفل
          </button>
        </form>

        <div class="divider"><span>لديك حساب؟</span></div>
        <div class="auth-footer-note"><a href="/login"><i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول</a></div>
      </div>

      <div class="reg-step-panel" id="step2">
        <div class="step-heading">
          <div class="step-title"><i class="bi bi-person-heart" style="color:var(--green);font-size:1.1rem"></i> معلومات <em>الطفل</em></div>
          <div class="step-sub">يمكنك إضافة أطفال آخرين لاحقاً من لوحة التحكم</div>
        </div>

        <div class="info-banner ib-green">
          <i class="bi bi-info-circle-fill"></i>
          <p>التسجيل مخصص للأطفال من 4 إلى 18 سنة</p>
        </div>

        <form id="form2" novalidate onsubmit="submitRegister(event)">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="k_fname"><i class="bi bi-person-fill"></i> اسم الطفل <span class="req">*</span></label>
              <div class="input-wrap">
                <input type="text" id="k_fname" class="form-input" placeholder="الاسم">
                <i class="bi bi-person-fill input-icon"></i>
              </div>
              <div class="field-err" id="err_k_fname"><i class="bi bi-exclamation-circle-fill"></i> هذا الحقل مطلوب</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="k_lname"><i class="bi bi-person-fill"></i> لقب الطفل <span class="req">*</span></label>
              <div class="input-wrap">
                <input type="text" id="k_lname" class="form-input" placeholder="اللقب">
                <i class="bi bi-person-fill input-icon"></i>
              </div>
              <div class="field-err" id="err_k_lname"><i class="bi bi-exclamation-circle-fill"></i> هذا الحقل مطلوب</div>
            </div>
          </div>

          <!-- Gender -->
          <div class="form-group">
            <label class="form-label"><i class="bi bi-person-fill"></i> جنس الطفل <span class="req">*</span></label>
            <div style="display:flex;gap:1rem;margin-top:.4rem">
              <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-weight:700;font-size:.95rem">
                <input type="radio" name="k_gender" id="k_gender_boy" value="boy" checked style="accent-color:var(--green);width:18px;height:18px">
                <img src="/assets/pfp/boy.png" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover"> ولد
              </label>
              <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-weight:700;font-size:.95rem">
                <input type="radio" name="k_gender" id="k_gender_girl" value="girl" style="accent-color:var(--green);width:18px;height:18px">
                <img src="/assets/pfp/girl.png" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover"> بنت
              </label>
            </div>
          </div>

          <!-- Age -->
          <div class="form-group">
            <label class="form-label" for="k_age"><i class="bi bi-calendar-fill"></i> عمر الطفل <span class="req">*</span></label>
            <div class="input-wrap age-input-wrap">
              <input type="number" id="k_age" class="form-input" placeholder="مثال: 10" min="4" max="25" oninput="checkAge(this)" style="direction:ltr;text-align:right;padding-left:5rem">
              <i class="bi bi-calendar-fill input-icon"></i>
              <div class="age-badge" id="ageBadge" style="display:none"></div>
            </div>
            <div class="field-err" id="err_k_age"><i class="bi bi-exclamation-circle-fill"></i> <span id="errAgeMsg">العمر مطلوب</span></div>
          </div>

          <!-- CAPTCHA -->
          <div class="captcha-wrap">
            <div class="captcha-label"><i class="bi bi-robot"></i> تحقق بسيط — أثبت أنك لست روبوتاً</div>
            <div class="captcha-equation">
              <div class="captcha-num" id="capN1">?</div>
              <div class="captcha-op" id="capOp">+</div>
              <div class="captcha-num" id="capN2">?</div>
              <div class="captcha-eq">=</div>
              <input type="number" class="captcha-input" id="capAnswer" placeholder="?" oninput="checkCaptcha(this)" autocomplete="off">
              <button type="button" class="captcha-refresh" onclick="genCaptcha()" title="تجديد السؤال"><i class="bi bi-arrow-clockwise"></i></button>
            </div>
            <div class="field-err" id="err_captcha" style="margin-top:0"><i class="bi bi-x-circle-fill"></i> الإجابة غير صحيحة</div>
          </div>

          <!-- Terms -->
          <label class="terms-check" id="termsCheck">
            <input type="checkbox" id="k_terms" onchange="toggleTerms(this)">
            <div class="terms-box"><i class="bi bi-check-lg"></i></div>
            <div class="terms-text">
              أوافق على <a href="/terms" onclick="event.stopPropagation()">شروط الاستخدام</a>
              و<a href="/privacy" onclick="event.stopPropagation()">سياسة الخصوصية</a>
              الخاصة بمنصة مكام وأؤكد أن المعلومات المدخلة صحيحة.
            </div>
          </label>
          <div class="field-err" id="err_terms"><i class="bi bi-exclamation-circle-fill"></i> يجب الموافقة على الشروط للمتابعة</div>

          <button type="button" class="btn-back" onclick="goBack()">
            <i class="bi bi-arrow-right-short" style="font-size:1.2rem"></i> رجوع — معلومات الوالي
          </button>
          <button type="submit" class="btn-submit bts-orange" id="btnCreate">
            <i class="bi bi-person-plus-fill"></i> إنشاء الحساب الآن
          </button>
        </form>
      </div>

      <!-- ═══ SUCCESS SCREEN ═══ -->
      <div class="success-screen" id="successScreen">
        <div class="success-icon"><i class="bi bi-check-lg"></i></div>
        <h2 class="success-title">تم إنشاء الحساب <em>بنجاح!</em></h2>
        <p class="success-desc">
          مرحباً بك في عائلة مقــــام ! تم إنشاء حسابك وملف طفلك.<br>
          يمكنك الآن تسجيل الدخول والبدء في رحلة التعلم.
        </p>
        <div class="success-details" id="successDetails"></div>
        <a href="/login" class="btn-submit bts-green" style="text-decoration:none">
          <i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول الآن
        </a>
      </div>

    </div><!-- /auth-card -->
  </div><!-- /auth-wrap -->
</div><!-- /auth-page -->

<script>
/* ══════════════════════════════════════
   STATE
══════════════════════════════════════ */
var parentData = {};
var captchaAnswer = 0;
var needsChecked = false;
var termsChecked = false;

/* ══════════════════════════════════════
   STEP NAVIGATION
══════════════════════════════════════ */
function goStep2(e){
  e.preventDefault();
  if(!validateStep1()) return;
  /* save parent data */
  parentData = {
    fname    : document.getElementById('p_fname').value.trim(),
    lname    : document.getElementById('p_lname').value.trim(),
    email    : document.getElementById('p_email').value.trim(),
    password : document.getElementById('p_pass').value,
  };
  /* animate out */
  var s1 = document.getElementById('step1');
  s1.style.animation = 'slideOut .3s ease forwards';
  setTimeout(function(){
    s1.classList.remove('active');
    s1.style.animation = '';
    document.getElementById('step2').classList.add('active');
    /* update progress */
    document.getElementById('sc1').className = 'reg-step-circle done';
    document.getElementById('sc1').innerHTML = '<i class="bi bi-check-lg"></i>';
    document.getElementById('sl1').classList.add('done');
    document.getElementById('sc2').className = 'reg-step-circle active';
    document.getElementById('slb1').className = 'reg-step-label done';
    document.getElementById('slb2').className = 'reg-step-label active';
    genCaptcha();
    window.scrollTo({top:0,behavior:'smooth'});
  }, 280);
}

function goBack(){
  var s2 = document.getElementById('step2');
  s2.style.animation = 'slideOut .3s ease forwards';
  setTimeout(function(){
    s2.classList.remove('active');
    s2.style.animation = '';
    document.getElementById('step1').classList.add('active');
    document.getElementById('sc1').className = 'reg-step-circle active';
    document.getElementById('sc1').innerHTML = '<i class="bi bi-people-fill" style="font-size:.85rem"></i>';
    document.getElementById('sl1').classList.remove('done');
    document.getElementById('sc2').className = 'reg-step-circle';
    document.getElementById('slb1').className = 'reg-step-label active';
    document.getElementById('slb2').className = 'reg-step-label';
    window.scrollTo({top:0,behavior:'smooth'});
  }, 280);
}

/* ══════════════════════════════════════
   VALIDATION — STEP 1
══════════════════════════════════════ */
function validateStep1(){
  var ok = true;
  var fname = document.getElementById('p_fname').value.trim();
  var lname = document.getElementById('p_lname').value.trim();
  var email = document.getElementById('p_email').value.trim();
  var pass  = document.getElementById('p_pass').value;
  var pass2 = document.getElementById('p_pass2').value;

  showErr('p_fname', !fname);
  showErr('p_lname', !lname);

  var emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  showErr('p_email', !emailOk);

  var passOk = pass.length >= 8;
  showErr('p_pass', !passOk);

  var matchOk = pass === pass2 && pass2.length > 0;
  showErr('p_pass2', !matchOk);

  if(!fname || !lname || !emailOk || !passOk || !matchOk) ok = false;
  return ok;
}

/* ══════════════════════════════════════
   VALIDATION — STEP 2
══════════════════════════════════════ */
function validateStep2(){
  var ok = true;
  var kf  = document.getElementById('k_fname').value.trim();
  var kl  = document.getElementById('k_lname').value.trim();
  var age = parseInt(document.getElementById('k_age').value);
  var cap = parseInt(document.getElementById('capAnswer').value);

  showErr('k_fname', !kf);
  showErr('k_lname', !kl);

  if(!age || age < 4){
    document.getElementById('errAgeMsg').textContent = 'العمر يجب أن يكون 4 سنوات فأكثر';
    showErr('k_age', true); ok = false;
  } else if(age > 18){
    document.getElementById('errAgeMsg').textContent = 'لا يمكن تسجيل من هم فوق 18 سنة';
    showErr('k_age', true); ok = false;
  } else { showErr('k_age', false); }

  if(!kf || !kl) ok = false;

  /* captcha */
  var capOk = cap === captchaAnswer;
  var capEl  = document.getElementById('capAnswer');
  capEl.classList.toggle('err', !capOk);
  capEl.classList.toggle('ok',  capOk);
  showErr('captcha', !capOk);
  if(!capOk) ok = false;

  /* terms */
  showErr('terms', !termsChecked);
  if(!termsChecked) ok = false;

  return ok;
}

/* ══════════════════════════════════════
   SUBMIT
══════════════════════════════════════ */
function submitRegister(e){
  e.preventDefault();
  if(!validateStep2()) return;
  var btn = document.getElementById('btnCreate');
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري إنشاء الحساب...';

  var kf      = document.getElementById('k_fname').value.trim();
  var kl      = document.getElementById('k_lname').value.trim();
  var age     = parseInt(document.getElementById('k_age').value);
  var kGender = document.querySelector('input[name="k_gender"]:checked');
  var payload = {
    p_fname   : parentData.fname,
    p_lname   : parentData.lname,
    p_email   : parentData.email,
    p_password: parentData.password,
    k_fname   : kf,
    k_lname   : kl,
    k_age     : age,
    k_gender  : kGender ? kGender.value : 'boy'
  };

  fetch('/api/auth_register', {
    method : 'POST',
    headers: {'Content-Type': 'application/json'},
    body   : JSON.stringify(payload),
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إنشاء الحساب الآن';
    if(res.ok){
      showSuccess(res.data);
    } else {
      showToastReg(res.error || 'حدث خطأ ما، حاول مجدداً', 'red');
    }
  })
  .catch(function(){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إنشاء الحساب الآن';
    showToastReg('تعذّر الاتصال بالخادم، حاول مجدداً', 'red');
  });
}

function showSuccess(data){
  document.getElementById('regProgress').style.display = 'none';
  document.getElementById('step2').classList.remove('active');
  var sc = document.getElementById('successScreen');
  sc.classList.add('show');
  document.getElementById('successDetails').innerHTML =
    row('رقم ولي الأمر',   data.parent_id) +
    row('اسم الوالي',      data.parent_name) +
    row('البريد',          data.email) +
    row('اسم الطفل',       data.child_name) +
    row('رقم الطفل',       data.child_id) +
    row('اسم مستخدم الطفل', data.child_username) +
    row('كلمة سر الطفل',   data.child_id + ' (رقم الطفل)') +
    row('العمر',           data.child_age + ' سنة');
  window.scrollTo({top:0,behavior:'smooth'});
}

function showToastReg(msg, type){
  var old = document.getElementById('regToast');
  if(old) old.remove();
  var t = document.createElement('div');
  t.id = 'regToast';
  t.style.cssText = [
    'position:fixed;bottom:2rem;left:50%;transform:translateX(-50%)',
    'background:' + (type==='red' ? 'var(--red)' : 'var(--green)'),
    'color:#fff;font-family:var(--font);font-weight:800;font-size:.9rem',
    'padding:.85rem 1.8rem;border-radius:50px;box-shadow:0 8px 28px rgba(0,0,0,.2)',
    'z-index:9999;animation:fadeUp .4s ease;max-width:90vw;text-align:center;direction:rtl'
  ].join(';');
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(function(){ t.style.opacity='0'; t.style.transition='opacity .4s'; setTimeout(function(){ t.remove(); }, 400); }, 4000);
}

function row(k, v){
  return '<div class="success-row"><span>'+k+'</span><span>'+v+'</span></div>';
}

/* ══════════════════════════════════════
   HELPERS
══════════════════════════════════════ */
function showErr(id, show){
  var el = document.getElementById('err_' + id);
  if(!el) return;
  el.classList.toggle('show', show);
  var input = document.getElementById(id.startsWith('p_') || id.startsWith('k_') ? id : null);
  /* also add err class to related input */
  var inp = document.getElementById(
    id === 'p_fname' ? 'p_fname' :
    id === 'p_lname' ? 'p_lname' :
    id === 'p_email' ? 'p_email' :
    id === 'p_pass'  ? 'p_pass'  :
    id === 'p_pass2' ? 'p_pass2' :
    id === 'k_fname' ? 'k_fname' :
    id === 'k_lname' ? 'k_lname' :
    id === 'k_age'   ? 'k_age'   : null
  );
  if(inp) inp.classList.toggle('err', show);
}

function togglePw(inputId, btnId){
  var el  = document.getElementById(inputId);
  var btn = document.getElementById(btnId);
  var show = el.type === 'password';
  el.type  = show ? 'text' : 'password';
  btn.querySelector('i').className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
}

function validateEmail(el){
  var ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim());
  el.classList.toggle('ok',  ok && el.value.length > 0);
  el.classList.toggle('err', !ok && el.value.length > 0);
  showErr('p_email', !ok && el.value.length > 0);
}

function checkPwStrength(el){
  var v   = el.value;
  var str = 0;
  if(v.length >= 8)  str++;
  if(/[A-Z]/.test(v)||/[a-z]/.test(v)) str++;
  if(/[0-9]/.test(v)) str++;
  if(/[^A-Za-z0-9]/.test(v)) str++;
  var fill  = document.getElementById('pwFill');
  var hint  = document.getElementById('pwHint');
  var colors = ['#C1392B','#E07824','#E8B830','#2D7A45'];
  var labels = ['ضعيفة جداً','ضعيفة','متوسطة','قوية'];
  fill.style.width  = (str * 25) + '%';
  fill.style.background = colors[str-1] || '#e8e8e8';
  hint.innerHTML = str > 0
    ? '<i class="bi bi-circle-fill" style="color:'+colors[str-1]+';font-size:.5rem"></i> كلمة المرور '+labels[str-1]
    : '<i class="bi bi-info-circle"></i> 8 أحرف فأكثر مع أرقام';
  showErr('p_pass', v.length > 0 && v.length < 8);
}

function checkPwMatch(el){
  var pass = document.getElementById('p_pass').value;
  var ok   = el.value === pass && el.value.length > 0;
  el.classList.toggle('ok',  ok);
  el.classList.toggle('err', !ok && el.value.length > 0);
  showErr('p_pass2', !ok && el.value.length > 0);
}

function checkAge(el){
  var age   = parseInt(el.value);
  var badge = document.getElementById('ageBadge');
  if(!el.value){ badge.style.display='none'; return; }
  badge.style.display = 'block';
  if(age < 6){
    badge.textContent='صغير جداً';badge.className='age-badge danger';
    showErr('k_age',true);document.getElementById('errAgeMsg').textContent='العمر يجب أن يكون 6 سنوات فأكثر';
  } else if(age > 18){
    badge.textContent='أكبر من 18 ❌';badge.className='age-badge danger';
    showErr('k_age',true);document.getElementById('errAgeMsg').textContent='لا يمكن تسجيل من هم فوق 18 سنة';
  } else {
    badge.textContent=age+' سنة ✓';badge.className='age-badge' + (age<=12?' ':' warn');
    if(age>=6&&age<=12) badge.className='age-badge';
    showErr('k_age',false);
    el.classList.remove('err');
  }
}

function toggleNeeds(el){
  needsChecked = el.checked;
  document.getElementById('needsToggle').classList.toggle('checked', needsChecked);
  document.getElementById('needsDetail').classList.toggle('show', needsChecked);
}

/* ── CAPTCHA ── */
function genCaptcha(){
  var ops  = ['+', '-', '×'];
  var op   = ops[Math.floor(Math.random()*2)]; /* + or - only for simplicity */
  var n1   = Math.floor(Math.random()*9)+1;
  var n2   = Math.floor(Math.random()*9)+1;
  if(op === '-' && n2 > n1){ var t=n1;n1=n2;n2=t; } /* keep positive */
  captchaAnswer = op === '+' ? n1+n2 : n1-n2;
  document.getElementById('capN1').textContent = n1;
  document.getElementById('capOp').textContent = op;
  document.getElementById('capN2').textContent = n2;
  document.getElementById('capAnswer').value = '';
  document.getElementById('capAnswer').className = 'captcha-input';
  showErr('captcha', false);
}

function checkCaptcha(el){
  var val = parseInt(el.value);
  var ok  = val === captchaAnswer;
  el.classList.toggle('ok',  ok);
  el.classList.toggle('err', !ok && el.value.length > 0);
  showErr('captcha', !ok && el.value.length > 0);
}

function toggleTerms(el){
  termsChecked = el.checked;
  document.getElementById('termsCheck').classList.toggle('checked', termsChecked);
  showErr('terms', !termsChecked);
}

/* ── INIT ── */
document.addEventListener('DOMContentLoaded', function(){ genCaptcha(); });
</script>

<?php require_once __DIR__ . '/../site/frontend/includes/footer.php'; ?>
