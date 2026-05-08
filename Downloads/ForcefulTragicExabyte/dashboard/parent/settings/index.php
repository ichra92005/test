<?php
require_once __DIR__ . '/../../../site/frontend/config/config.php';
$dash_title  = 'الإعدادات';
$dash_icon   = 'gear-fill';
$dash_active = 'settings';

$parent_name  = 'أحمد بن علي';
$parent_init  = 'أ';
$parent_email = 'ahmed.benali@email.com';
$parent_phone = '+213 555 123 456';
$parent_city  = 'الجزائر العاصمة';
$parent_plan  = 'مجاني';

require_once __DIR__ . '/../../../site/frontend/includes/dashboard/parent/header.php';
?>

<style>
.sett-hero {
  background: linear-gradient(135deg, var(--sidebar-bg) 0%, #1A2E20 50%, #243B2A 100%);
  border-radius: var(--r); padding: 1.5rem 2rem; margin-bottom: 1.6rem;
  position: relative; overflow: hidden;
  box-shadow: 0 8px 32px rgba(0,0,0,.15); animation: fadeUp .4s ease;
}
.sh-decor { position:absolute; border-radius:50%; pointer-events:none; }
.sh-decor-1 { width:220px;height:220px;background:rgba(255,255,255,.025);top:-70px;left:-70px; }
.sh-decor-2 { width:130px;height:130px;background:rgba(232,184,48,.06);bottom:-40px;left:100px; }
.sh-inner   { position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem; }
.sh-label   { font-size:.72rem;font-weight:800;color:rgba(255,255,255,.4);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.3rem;display:flex;align-items:center;gap:.4rem; }
.sh-label i { color:var(--gold); }
.sh-title   { font-size:1.55rem;font-weight:900;color:#fff;margin-bottom:.25rem; }
.sh-title em{ background:linear-gradient(135deg,var(--gold),#F59E0B);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-style:normal; }
.sh-sub     { font-size:.8rem;color:rgba(255,255,255,.45);font-weight:700; }
.sh-avatar-wrap { display:flex;align-items:center;gap:1rem;flex-shrink:0; }
.sh-avatar  {
  width:64px;height:64px;border-radius:50%;
  background:linear-gradient(135deg,var(--green),var(--green2));
  display:flex;align-items:center;justify-content:center;
  font-size:1.7rem;font-weight:900;color:#fff;
  border:3px solid rgba(255,255,255,.2);
  box-shadow:0 6px 24px rgba(0,0,0,.2);
  cursor:pointer;transition:var(--tr);position:relative;overflow:hidden;
}
.sh-avatar:hover { transform:scale(1.06); }
.sh-avatar-edit {
  position:absolute;bottom:0;left:0;right:0;height:28px;
  background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;
  font-size:.6rem;color:#fff;font-weight:800;opacity:0;transition:var(--tr);
}
.sh-avatar:hover .sh-avatar-edit { opacity:1; }
.sh-info .sh-name { font-size:1rem;font-weight:900;color:#fff;margin-bottom:.15rem; }
.sh-info .sh-role { font-size:.74rem;color:rgba(255,255,255,.5);font-weight:700; }
.sh-plan-badge {
  display:inline-flex;align-items:center;gap:.3rem;margin-top:.4rem;
  background:var(--gold);color:#333;font-size:.67rem;font-weight:900;
  padding:.18rem .65rem;border-radius:50px;cursor:pointer;
}
.sh-plan-badge:hover { background:#F59E0B; }

/* ── Layout ── */
.sett-layout {
  display:grid;grid-template-columns:220px 1fr;
  gap:1.4rem;align-items:start;
}

/* ── Side Nav ── */
.sett-nav {
  background:var(--white);border-radius:var(--r);
  border:1.5px solid var(--gray-200);box-shadow:var(--sh);
  overflow:hidden;animation:fadeUp .45s ease;position:sticky;top:80px;
}
.sn-head {
  padding:.85rem 1rem;background:var(--gray-50);
  border-bottom:1.5px solid var(--gray-100);
  font-size:.72rem;font-weight:900;color:var(--gray-400);
  letter-spacing:.07em;text-transform:uppercase;
}
.sn-item {
  display:flex;align-items:center;gap:.65rem;
  padding:.75rem 1rem;cursor:pointer;transition:var(--tr);
  border-bottom:1px solid var(--gray-100);
  font-size:.85rem;font-weight:800;color:var(--gray-500);
  text-decoration:none;border-right:3px solid transparent;
}
.sn-item:last-child { border-bottom:none; }
.sn-item i { font-size:.95rem;width:18px;text-align:center;flex-shrink:0; }
.sn-item:hover { background:var(--gray-50);color:var(--gray-700); }
.sn-item.active {
  background:var(--green-xpale);color:var(--green);
  border-right-color:var(--green);font-weight:900;
}
.sn-item.active i { color:var(--green); }

/* ── Content area ── */
.sett-content { display:flex;flex-direction:column;gap:1.3rem; }

/* ── Section card ── */
.sett-section {
  background:var(--white);border-radius:var(--r);
  border:1.5px solid var(--gray-200);box-shadow:var(--sh);
  overflow:hidden;animation:fadeUp .5s ease;
  display:none;
}
.sett-section.active { display:block; }

/* Section header */
.ss-head {
  display:flex;align-items:center;justify-content:space-between;
  padding:1.1rem 1.4rem;border-bottom:1.5px solid var(--gray-100);
  background:var(--gray-50);
}
.ss-head-left { display:flex;align-items:center;gap:.7rem; }
.ss-icon {
  width:40px;height:40px;border-radius:11px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;flex-shrink:0;
}
.ss-title { font-size:.95rem;font-weight:900;color:var(--gray-800); }
.ss-sub   { font-size:.74rem;color:var(--gray-400);font-weight:700;margin-top:.1rem; }
.ss-save-btn {
  display:flex;align-items:center;gap:.4rem;
  padding:.55rem 1.15rem;border-radius:var(--r-full);
  background:var(--green);color:#fff;border:none;
  font-family:var(--font);font-size:.82rem;font-weight:900;
  cursor:pointer;transition:var(--tr);
}
.ss-save-btn:hover { background:var(--green2);transform:translateY(-2px);box-shadow:var(--sh-green); }

/* Section body */
.ss-body { padding:1.5rem 1.4rem; }

/* ── Form grid ── */
.form-grid   { display:grid;grid-template-columns:1fr 1fr;gap:1rem 1.3rem; }
.form-grid-3 { display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem 1.3rem; }
.form-full   { grid-column:1/-1; }

.f-group { display:flex;flex-direction:column;gap:.32rem; }
.f-label {
  font-size:.8rem;font-weight:800;color:var(--gray-600);
  display:flex;align-items:center;gap:.35rem;
}
.f-label i { font-size:.82rem;color:var(--gray-400); }
.f-label .req { color:var(--red);margin-right:1px; }
.f-input-wrap { position:relative; }
.f-input {
  width:100%;padding:.72rem 1rem .72rem 2.6rem;
  border:2px solid var(--gray-200);border-radius:var(--r-sm);
  font-family:var(--font);font-size:.88rem;color:var(--gray-800);
  background:var(--gray-50);outline:none;transition:var(--tr);direction:rtl;
}
.f-input::placeholder { color:var(--gray-400); }
.f-input:focus { border-color:var(--green);background:var(--white);box-shadow:0 0 0 3px rgba(45,122,69,.09); }
.f-input:disabled { opacity:.55;cursor:not-allowed;background:var(--gray-100); }
.f-icon { position:absolute;left:.8rem;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:.88rem;pointer-events:none; }
.f-hint { font-size:.71rem;color:var(--gray-400);font-weight:600;display:flex;align-items:center;gap:.3rem; }
.f-hint i { font-size:.73rem; }

/* ── Select ── */
.f-select {
  width:100%;padding:.72rem 1rem .72rem 2.6rem;
  border:2px solid var(--gray-200);border-radius:var(--r-sm);
  font-family:var(--font);font-size:.88rem;color:var(--gray-800);
  background:var(--gray-50);outline:none;transition:var(--tr);
  -webkit-appearance:none;cursor:pointer;
}
.f-select:focus { border-color:var(--green);background:var(--white);box-shadow:0 0 0 3px rgba(45,122,69,.09); }

/* ── Divider ── */
.f-divider { height:1px;background:var(--gray-100);margin:1.2rem 0;grid-column:1/-1; }

/* ── Toggle row ── */
.toggle-list { display:flex;flex-direction:column;gap:.7rem; }
.toggle-row {
  display:flex;align-items:center;justify-content:space-between;
  padding:.9rem 1.1rem;border-radius:var(--r-sm);
  background:var(--gray-50);border:1.5px solid var(--gray-100);
  transition:var(--tr);
}
.toggle-row:hover { border-color:var(--gray-200);background:var(--white); }
.tr-left { display:flex;align-items:center;gap:.7rem; }
.tr-icon {
  width:36px;height:36px;border-radius:9px;
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;flex-shrink:0;
}
.tr-title { font-size:.86rem;font-weight:800;color:var(--gray-700); }
.tr-desc  { font-size:.73rem;color:var(--gray-400);font-weight:700; }

/* Toggle switch */
.tog {
  position:relative;width:44px;height:24px;flex-shrink:0;cursor:pointer;
}
.tog input { display:none; }
.tog-track {
  position:absolute;inset:0;border-radius:50px;
  background:var(--gray-200);transition:var(--tr);
}
.tog input:checked + .tog-track { background:var(--green); }
.tog-thumb {
  position:absolute;top:3px;right:3px;
  width:18px;height:18px;border-radius:50%;
  background:#fff;box-shadow:0 2px 6px rgba(0,0,0,.2);
  transition:var(--tr);
}
.tog input:checked ~ .tog-thumb { right:calc(100% - 21px); }

/* ── Plan card ── */
.plan-cards { display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.2rem; }
.plan-card {
  border:2px solid var(--gray-200);border-radius:var(--r-sm);
  padding:1.2rem;cursor:pointer;transition:var(--tr);position:relative;
  background:var(--white);
}
.plan-card:hover { border-color:var(--gray-300);transform:translateY(-2px);box-shadow:var(--sh); }
.plan-card.selected { border-color:var(--green);background:var(--green-xpale); }
.plan-card.selected::after {
  content:'\F633';font-family:'bootstrap-icons';
  position:absolute;top:.75rem;left:.75rem;
  color:var(--green);font-size:1.1rem;
}
.pc-badge {
  display:inline-flex;align-items:center;gap:.25rem;margin-bottom:.6rem;
  font-size:.67rem;font-weight:900;padding:.18rem .6rem;border-radius:50px;
}
.pcb-free { background:var(--gray-100);color:var(--gray-500); }
.pcb-pro  { background:var(--gold-pale);color:var(--gold2); }
.pc-price { font-size:1.6rem;font-weight:900;color:var(--gray-800);line-height:1;margin-bottom:.15rem; }
.pc-price span { font-size:.8rem;color:var(--gray-400);font-weight:700; }
.pc-name  { font-size:.85rem;font-weight:800;color:var(--gray-600);margin-bottom:.7rem; }
.pc-feat  { display:flex;flex-direction:column;gap:.3rem; }
.pc-feat-item {
  font-size:.76rem;font-weight:700;color:var(--gray-500);
  display:flex;align-items:center;gap:.4rem;
}
.pc-feat-item i { color:var(--green);font-size:.8rem; }
.pc-feat-item.no i { color:var(--gray-300); }
.pc-feat-item.no { color:var(--gray-300); }

/* ── Children list ── */
.children-list { display:flex;flex-direction:column;gap:.8rem; }
.child-row {
  display:flex;align-items:center;gap:1rem;
  padding:1rem 1.1rem;border-radius:var(--r-sm);
  border:1.5px solid var(--gray-200);background:var(--gray-50);
  transition:var(--tr);
}
.child-row:hover { background:var(--white);border-color:var(--gray-300);box-shadow:var(--sh); }
.cr-avatar {
  width:44px;height:44px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;font-weight:900;color:#fff;
  box-shadow:0 4px 12px rgba(0,0,0,.15);
}
.cr-info { flex:1;min-width:0; }
.cr-name  { font-size:.9rem;font-weight:900;color:var(--gray-800); }
.cr-meta  { font-size:.74rem;color:var(--gray-400);font-weight:700;display:flex;align-items:center;gap:.4rem;flex-wrap:wrap; }
.cr-actions { display:flex;gap:.5rem;flex-shrink:0; }
.cr-btn {
  display:flex;align-items:center;gap:.3rem;
  padding:.38rem .8rem;border-radius:8px;border:none;
  font-family:var(--font);font-size:.76rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.crb-edit { background:var(--green-pale);color:var(--green); }
.crb-edit:hover { background:var(--green);color:#fff; }
.crb-del  { background:var(--red-pale);color:var(--red); }
.crb-del:hover  { background:var(--red);color:#fff; }

/* ── Security items ── */
.sec-list { display:flex;flex-direction:column;gap:.8rem; }
.sec-row {
  display:flex;align-items:center;justify-content:space-between;
  padding:.95rem 1.1rem;border-radius:var(--r-sm);
  border:1.5px solid var(--gray-200);background:var(--white);
  flex-wrap:wrap;gap:.6rem;
}
.sr-left { display:flex;align-items:center;gap:.75rem; }
.sr-icon {
  width:40px;height:40px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;flex-shrink:0;
}
.sr-title { font-size:.87rem;font-weight:900;color:var(--gray-800); }
.sr-desc  { font-size:.73rem;color:var(--gray-400);font-weight:700;margin-top:.1rem; }
.sr-badge {
  font-size:.7rem;font-weight:900;padding:.2rem .65rem;border-radius:50px;
}
.srb-ok   { background:var(--green-pale);color:var(--green); }
.srb-warn { background:var(--orange-pale);color:var(--orange); }
.sr-btn {
  display:flex;align-items:center;gap:.35rem;
  padding:.42rem .9rem;border-radius:8px;border:none;
  font-family:var(--font);font-size:.78rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.srb-action { background:var(--gray-100);color:var(--gray-600);border:1.5px solid var(--gray-200); }
.srb-action:hover { background:var(--green-pale);color:var(--green);border-color:rgba(45,122,69,.2); }

/* ── Danger zone ── */
.danger-zone {
  border:2px solid rgba(193,57,43,.2);border-radius:var(--r-sm);
  padding:1.2rem;background:var(--red-pale);margin-top:.5rem;
}
.dz-title { font-size:.86rem;font-weight:900;color:var(--red);margin-bottom:.3rem;display:flex;align-items:center;gap:.4rem; }
.dz-desc  { font-size:.78rem;color:rgba(193,57,43,.75);font-weight:700;line-height:1.6;margin-bottom:.9rem; }
.dz-btn {
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.55rem 1.2rem;border-radius:9px;border:1.5px solid var(--red);
  background:var(--white);color:var(--red);
  font-family:var(--font);font-size:.82rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.dz-btn:hover { background:var(--red);color:#fff;box-shadow:0 6px 20px rgba(193,57,43,.3); }

/* ── Password strength ── */
.pass-strength { margin-top:.4rem; }
.ps-bar { height:4px;border-radius:50px;background:var(--gray-200);overflow:hidden;margin-bottom:.3rem; }
.ps-fill { height:100%;border-radius:50px;width:0;transition:width .4s ease; }
.ps-label { font-size:.69rem;font-weight:800; }

/* ── Save bar (sticky) ── */
.save-bar {
  position:sticky;bottom:1rem;z-index:100;
  background:var(--white);border:1.5px solid var(--gray-200);
  border-radius:var(--r-full);box-shadow:0 8px 32px rgba(0,0,0,.12);
  padding:.7rem 1.2rem;
  display:flex;align-items:center;justify-content:space-between;
  gap:1rem;animation:fadeUp .4s ease;
  margin-top:1rem;
  display:none;
}
.save-bar.show { display:flex; }
.sb-msg { font-size:.83rem;font-weight:800;color:var(--gray-600);display:flex;align-items:center;gap:.4rem; }
.sb-msg i { color:var(--orange); }
.sb-actions { display:flex;gap:.6rem; }
.sba-cancel {
  padding:.5rem 1.1rem;border-radius:var(--r-full);
  background:var(--gray-100);color:var(--gray-500);border:1.5px solid var(--gray-200);
  font-family:var(--font);font-size:.82rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.sba-cancel:hover { background:var(--gray-200); }
.sba-save {
  padding:.5rem 1.3rem;border-radius:var(--r-full);
  background:var(--green);color:#fff;border:none;
  font-family:var(--font);font-size:.82rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.sba-save:hover { background:var(--green2);transform:translateY(-1px);box-shadow:var(--sh-green); }

/* ── Responsive ── */
@media(max-width:960px){
  .sett-layout { grid-template-columns:1fr; }
  .sett-nav { position:static;display:flex;flex-wrap:wrap;gap:.4rem;padding:.8rem; }
  .sn-head { display:none; }
  .sn-item { border-radius:var(--r-full);border-bottom:none;padding:.45rem .9rem;border-right:none!important; }
  .sn-item.active { background:var(--green);color:#fff; }
  .sn-item.active i { color:#fff; }
  .plan-cards { grid-template-columns:1fr; }
  .form-grid-3 { grid-template-columns:1fr 1fr; }
}
@media(max-width:640px){
  .form-grid,.form-grid-3 { grid-template-columns:1fr; }
  .ss-save-btn span { display:none; }
}
</style>

<!-- ════ HERO ════ -->
<div class="sett-hero">
  <div class="sh-decor sh-decor-1"></div>
  <div class="sh-decor sh-decor-2"></div>
  <div class="sh-inner">
    <div>
      <div class="sh-label"><i class="bi bi-gear-fill"></i> إدارة الحساب</div>
      <div class="sh-title">إعدادات <em>حسابك</em></div>
      <div class="sh-sub">تحكم في ملفك الشخصي وأطفالك والخصوصية</div>
    </div>
    <div class="sh-avatar-wrap">
      <div class="sh-avatar" onclick="showToast('تغيير الصورة قريباً!','green')">
        <?= $parent_init ?>
        <div class="sh-avatar-edit"><i class="bi bi-camera-fill"></i> تغيير</div>
      </div>
      <div class="sh-info">
        <div class="sh-name"><?= htmlspecialchars($parent_name) ?></div>
        <div class="sh-role">ولي الأمر · <?= htmlspecialchars($parent_email) ?></div>
        <div class="sh-plan-badge" onclick="switchTab('plan')">
          <i class="bi bi-star-fill"></i> الخطة <?= $parent_plan ?> · الترقية
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ════ LAYOUT ════ -->
<div class="sett-layout">

  <!-- ══ Side Nav ══ -->
  <div class="sett-nav">
    <div class="sn-head">الإعدادات</div>
    <a class="sn-item active" onclick="switchTab('profile')" href="#">
      <i class="bi bi-person-fill" style="color:var(--green)"></i> الملف الشخصي
    </a>
    <a class="sn-item" onclick="switchTab('children')" href="#">
      <i class="bi bi-people-fill" style="color:var(--blue)"></i> أطفالي
    </a>
    <a class="sn-item" onclick="switchTab('notifications')" href="#">
      <i class="bi bi-bell-fill" style="color:var(--orange)"></i> الإشعارات
    </a>
    <a class="sn-item" onclick="switchTab('security')" href="#">
      <i class="bi bi-shield-lock-fill" style="color:var(--red)"></i> الأمان
    </a>
    <a class="sn-item" onclick="switchTab('plan')" href="#">
      <i class="bi bi-star-fill" style="color:var(--gold2)"></i> خطة الاشتراك
    </a>
    <a class="sn-item" onclick="switchTab('appearance')" href="#">
      <i class="bi bi-palette-fill" style="color:var(--purple)"></i> المظهر واللغة
    </a>
  </div>

  <!-- ══ Content ══ -->
  <div class="sett-content">

    <!-- ══════ PROFILE ══════ -->
    <div class="sett-section active" id="sec-profile">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:var(--green-pale)">
            <i class="bi bi-person-fill" style="color:var(--green)"></i>
          </div>
          <div>
            <div class="ss-title">الملف الشخصي</div>
            <div class="ss-sub">معلوماتك الشخصية وبيانات الاتصال</div>
          </div>
        </div>
        <button class="ss-save-btn" onclick="saveSection('profile')">
          <i class="bi bi-check-lg"></i> <span>حفظ التغييرات</span>
        </button>
      </div>
      <div class="ss-body">
        <div class="form-grid">
          <div class="f-group">
            <label class="f-label"><i class="bi bi-person-fill"></i> الاسم <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="text" class="f-input" value="أحمد" oninput="markDirty()" placeholder="الاسم الأول">
              <i class="bi bi-person-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-person-fill"></i> اللقب <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="text" class="f-input" value="بن علي" oninput="markDirty()" placeholder="اللقب">
              <i class="bi bi-person-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-envelope-fill"></i> البريد الإلكتروني <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="email" class="f-input" value="<?= $parent_email ?>" oninput="markDirty()" placeholder="example@email.com" style="direction:ltr;text-align:right">
              <i class="bi bi-envelope-fill f-icon"></i>
            </div>
            <div class="f-hint"><i class="bi bi-info-circle"></i> يُستخدم لتسجيل الدخول</div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-phone-fill"></i> رقم الهاتف</label>
            <div class="f-input-wrap">
              <input type="tel" class="f-input" value="<?= $parent_phone ?>" oninput="markDirty()" placeholder="+213 5XX XXX XXX" style="direction:ltr;text-align:right">
              <i class="bi bi-phone-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-geo-alt-fill"></i> الولاية</label>
            <div class="f-input-wrap">
              <select class="f-select" onchange="markDirty()">
                <option value="">اختر الولاية...</option>
                <option value="1" selected>الجزائر العاصمة</option>
                <option value="2">وهران</option>
                <option value="3">قسنطينة</option>
                <option value="4">عنابة</option>
                <option value="5">بشار</option>
                <option value="6">تيزي وزو</option>
                <option value="7">سطيف</option>
                <option value="8">بجاية</option>
                <option value="9">باتنة</option>
                <option value="10">تلمسان</option>
              </select>
              <i class="bi bi-geo-alt-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-calendar-fill"></i> تاريخ الميلاد</label>
            <div class="f-input-wrap">
              <input type="date" class="f-input" value="1985-06-15" oninput="markDirty()" style="direction:ltr;text-align:right">
              <i class="bi bi-calendar-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group form-full">
            <label class="f-label"><i class="bi bi-chat-left-text-fill"></i> نبذة قصيرة</label>
            <div class="f-input-wrap">
              <textarea class="f-input" rows="2" oninput="markDirty()" placeholder="اكتب نبذة مختصرة عنك..." style="padding-top:.7rem;resize:vertical;min-height:68px;padding-left:1rem">أب مهتم بتعليم أبنائه وتطويرهم.</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ CHILDREN ══════ -->
    <div class="sett-section" id="sec-children">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:#EFF6FF">
            <i class="bi bi-people-fill" style="color:#2563EB"></i>
          </div>
          <div>
            <div class="ss-title">إدارة الأطفال ووقت الشاشة</div>
            <div class="ss-sub">أطفالك المسجلون وحدود الاستخدام اليومي</div>
          </div>
        </div>
        <button class="ss-save-btn" onclick="openAddChildModal()" style="background:#2563EB">
          <i class="bi bi-person-plus-fill"></i> <span>إضافة طفل</span>
        </button>
      </div>
      <div class="ss-body">
        <div class="children-list" id="settChildrenList">
          <div style="text-align:center;padding:2rem;color:var(--gray-400);font-weight:700">
            <i class="bi bi-arrow-clockwise" style="font-size:1.5rem;display:block;margin-bottom:.4rem;opacity:.3"></i>
            جاري تحميل الأطفال...
          </div>
        </div>

        <div class="f-divider" style="margin-top:1.4rem"></div>

        <div style="font-size:.78rem;font-weight:800;color:var(--gray-500);margin-bottom:.8rem;display:flex;align-items:center;gap:.4rem">
          <i class="bi bi-clock-history" style="color:var(--orange)"></i> ضبط وقت الشاشة اليومي
        </div>
        <div id="settScreenTimeList">
          <div style="font-size:.82rem;color:var(--gray-400);font-weight:700;padding:.5rem">
            يرجى الانتظار — جاري تحميل البيانات...
          </div>
        </div>
      </div>
    </div>

    <!-- Add Child Modal (inside settings page) -->
    <div id="addChildModalSett" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);backdrop-filter:blur(4px);z-index:1000;align-items:center;justify-content:center">
      <div style="background:#fff;width:90%;max-width:480px;border-radius:16px;padding:2rem;box-shadow:0 20px 40px rgba(0,0,0,.15)">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
          <h3 style="font-size:1.15rem;font-weight:800">إضافة طفل جديد</h3>
          <button onclick="closeAddChildModal()" style="background:none;border:none;font-size:1.4rem;cursor:pointer;color:#94a3b8">✕</button>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
          <div class="f-group">
            <label class="f-label">الاسم *</label>
            <div class="f-input-wrap">
              <input type="text" id="acFname" class="f-input" placeholder="الاسم الأول" style="padding-left:1rem">
            </div>
          </div>
          <div class="f-group">
            <label class="f-label">اللقب *</label>
            <div class="f-input-wrap">
              <input type="text" id="acLname" class="f-input" placeholder="اللقب" style="padding-left:1rem">
            </div>
          </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
          <div class="f-group">
            <label class="f-label">العمر (6–18) *</label>
            <div class="f-input-wrap">
              <input type="number" id="acAge" class="f-input" min="6" max="18" placeholder="العمر" style="padding-left:1rem">
            </div>
          </div>
          <div class="f-group">
            <label class="f-label">الجنس</label>
            <div class="f-input-wrap">
              <select id="acGender" class="f-input" style="padding-left:1rem">
                <option value="boy">ولد</option>
                <option value="girl">بنت</option>
              </select>
            </div>
          </div>
        </div>
        <div class="f-group">
          <label class="f-label">احتياجات خاصة (اختياري)</label>
          <div class="f-input-wrap">
            <input type="text" id="acDisease" class="f-input" placeholder="مثال: عُسر القراءة" style="padding-left:1rem">
          </div>
        </div>
        <div id="acResult" style="display:none;padding:.85rem 1rem;border-radius:10px;font-size:.85rem;font-weight:700;margin-bottom:1rem"></div>
        <div style="display:flex;gap:10px;margin-top:1rem">
          <button id="acSubmitBtn" class="ss-save-btn" style="flex:1;justify-content:center;padding:.7rem" onclick="submitAddChild()">
            <i class="bi bi-person-plus-fill"></i> إضافة الطفل
          </button>
          <button onclick="closeAddChildModal()" style="flex:1;padding:.7rem;border-radius:var(--r-full);background:var(--gray-100);border:1.5px solid var(--gray-200);font-family:var(--font);font-size:.85rem;font-weight:800;cursor:pointer">
            إلغاء
          </button>
        </div>
      </div>
    </div>

    <!-- ══════ NOTIFICATIONS ══════ -->
    <div class="sett-section" id="sec-notifications">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:var(--orange-pale)">
            <i class="bi bi-bell-fill" style="color:var(--orange)"></i>
          </div>
          <div>
            <div class="ss-title">تفضيلات الإشعارات</div>
            <div class="ss-sub">تحكم في ما تتلقاه من تنبيهات</div>
          </div>
        </div>
        <button class="ss-save-btn" onclick="saveSection('notifications')">
          <i class="bi bi-check-lg"></i> <span>حفظ</span>
        </button>
      </div>
      <div class="ss-body">
        <div style="font-size:.78rem;font-weight:900;color:var(--gray-400);letter-spacing:.07em;text-transform:uppercase;margin-bottom:.8rem">
          📱 إشعارات التطبيق
        </div>
        <div class="toggle-list" style="margin-bottom:1.3rem">
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--green-pale)"><i class="bi bi-check-circle-fill" style="color:var(--green)"></i></div>
              <div>
                <div class="tr-title">إتمام الدروس</div>
                <div class="tr-desc">عند إكمال طفلك لدرس أو وحدة</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:#EFF6FF"><i class="bi bi-bell-fill" style="color:#2563EB"></i></div>
              <div>
                <div class="tr-title">الطلبات الجديدة</div>
                <div class="tr-desc">عند طلب طفلك فتح مستوى جديد</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--gold-pale)"><i class="bi bi-trophy-fill" style="color:var(--gold2)"></i></div>
              <div>
                <div class="tr-title">الشارات والإنجازات</div>
                <div class="tr-desc">عند حصول طفلك على شارة جديدة</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--red-pale)"><i class="bi bi-exclamation-circle-fill" style="color:var(--red)"></i></div>
              <div>
                <div class="tr-title">تحذيرات النشاط</div>
                <div class="tr-desc">عند تجاوز حد الوقت اليومي</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
        </div>
        <div style="font-size:.78rem;font-weight:900;color:var(--gray-400);letter-spacing:.07em;text-transform:uppercase;margin-bottom:.8rem">
          📧 إشعارات البريد الإلكتروني
        </div>
        <div class="toggle-list">
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--green-pale)"><i class="bi bi-envelope-fill" style="color:var(--green)"></i></div>
              <div>
                <div class="tr-title">التقرير الأسبوعي</div>
                <div class="tr-desc">ملخص أسبوعي لأداء أطفالك</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--orange-pale)"><i class="bi bi-megaphone-fill" style="color:var(--orange)"></i></div>
              <div>
                <div class="tr-title">العروض والجديد</div>
                <div class="tr-desc">آخر أخبار المنصة والعروض</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ SECURITY ══════ -->
    <div class="sett-section" id="sec-security">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:var(--red-pale)">
            <i class="bi bi-shield-lock-fill" style="color:var(--red)"></i>
          </div>
          <div>
            <div class="ss-title">الأمان والخصوصية</div>
            <div class="ss-sub">حماية حسابك وإدارة كلمة المرور</div>
          </div>
        </div>
      </div>
      <div class="ss-body">
        <!-- Status items -->
        <div class="sec-list" style="margin-bottom:1.4rem">
          <div class="sec-row">
            <div class="sr-left">
              <div class="sr-icon" style="background:var(--green-pale)"><i class="bi bi-envelope-check-fill" style="color:var(--green)"></i></div>
              <div>
                <div class="sr-title">البريد الإلكتروني</div>
                <div class="sr-desc"><?= $parent_email ?></div>
              </div>
            </div>
            <span class="sr-badge srb-ok"><i class="bi bi-check-circle-fill"></i> موثّق</span>
          </div>
          <div class="sec-row">
            <div class="sr-left">
              <div class="sr-icon" style="background:var(--orange-pale)"><i class="bi bi-phone-fill" style="color:var(--orange)"></i></div>
              <div>
                <div class="sr-title">رقم الهاتف</div>
                <div class="sr-desc"><?= $parent_phone ?></div>
              </div>
            </div>
            <button class="sr-btn srb-action" onclick="showToast('توثيق الهاتف — قريباً!','orange')">
              <i class="bi bi-shield-exclamation"></i> توثيق
            </button>
          </div>
          <div class="sec-row">
            <div class="sr-left">
              <div class="sr-icon" style="background:#EFF6FF"><i class="bi bi-shield-lock-fill" style="color:#2563EB"></i></div>
              <div>
                <div class="sr-title">التحقق الثنائي (2FA)</div>
                <div class="sr-desc">طبقة حماية إضافية لحسابك</div>
              </div>
            </div>
            <button class="sr-btn srb-action" onclick="showToast('التحقق الثنائي — قريباً!','green')">
              <i class="bi bi-toggle-off"></i> تفعيل
            </button>
          </div>
          <div class="sec-row">
            <div class="sr-left">
              <div class="sr-icon" style="background:var(--green-pale)"><i class="bi bi-clock-history" style="color:var(--green)"></i></div>
              <div>
                <div class="sr-title">آخر تسجيل دخول</div>
                <div class="sr-desc">اليوم · ٨:٤٥ ص · الجزائر العاصمة</div>
              </div>
            </div>
            <span class="sr-badge srb-ok">هذا الجهاز</span>
          </div>
        </div>

        <!-- Change password -->
        <div style="font-size:.8rem;font-weight:900;color:var(--gray-600);margin-bottom:.9rem;display:flex;align-items:center;gap:.4rem">
          <i class="bi bi-key-fill" style="color:var(--orange)"></i> تغيير كلمة المرور
        </div>
        <div class="form-grid" style="margin-bottom:1.3rem">
          <div class="f-group form-full">
            <label class="f-label"><i class="bi bi-lock-fill"></i> كلمة المرور الحالية <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="password" id="oldPass" class="f-input" placeholder="••••••••" oninput="markDirty()">
              <i class="bi bi-lock-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-lock-fill"></i> كلمة المرور الجديدة <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="password" id="newPass" class="f-input" placeholder="••••••••" oninput="checkPassStrength(this)">
              <i class="bi bi-lock-fill f-icon"></i>
            </div>
            <div class="pass-strength" id="passStrengthWrap" style="display:none">
              <div class="ps-bar"><div class="ps-fill" id="passFill"></div></div>
              <div class="ps-label" id="passLabel"></div>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-lock-fill"></i> تأكيد كلمة المرور <span class="req">*</span></label>
            <div class="f-input-wrap">
              <input type="password" id="confPass" class="f-input" placeholder="••••••••" oninput="markDirty()">
              <i class="bi bi-lock-fill f-icon"></i>
            </div>
          </div>
          <div class="f-group form-full">
            <button class="ss-save-btn" style="width:fit-content" onclick="saveSection('security')">
              <i class="bi bi-key-fill"></i> تحديث كلمة المرور
            </button>
          </div>
        </div>

        <!-- Danger zone -->
        <div class="danger-zone">
          <div class="dz-title"><i class="bi bi-exclamation-triangle-fill"></i> منطقة الخطر</div>
          <div class="dz-desc">
            حذف الحساب نهائي ولا يمكن التراجع عنه. ستُحذف جميع بيانات أطفالك وتقدمهم بشكل دائم.
          </div>
          <button class="dz-btn" onclick="showToast('حذف الحساب — يتطلب تأكيداً إضافياً','orange')">
            <i class="bi bi-trash-fill"></i> حذف الحساب نهائياً
          </button>
        </div>
      </div>
    </div>

    <!-- ══════ PLAN ══════ -->
    <div class="sett-section" id="sec-plan">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:var(--gold-pale)">
            <i class="bi bi-star-fill" style="color:var(--gold2)"></i>
          </div>
          <div>
            <div class="ss-title">خطة الاشتراك</div>
            <div class="ss-sub">اختر الخطة المناسبة لأسرتك</div>
          </div>
        </div>
        <span style="font-size:.74rem;font-weight:900;background:var(--gray-100);color:var(--gray-500);padding:.3rem .85rem;border-radius:50px">
          حالياً: مجاني
        </span>
      </div>
      <div class="ss-body">
        <div class="plan-cards">
          <!-- Free -->
          <div class="plan-card selected" id="planFree" onclick="selectPlan('free')">
            <div class="pc-badge pcb-free"><i class="bi bi-gift"></i> مجاني</div>
            <div class="pc-price">٠ دج <span>/ شهر</span></div>
            <div class="pc-name">خطة الاستكشاف</div>
            <div class="pc-feat">
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> طفلان كحد أقصى</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> ٤ وحدات أساسية</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> تقارير أسبوعية</div>
              <div class="pc-feat-item no"><i class="bi bi-x-circle-fill"></i> وحدات متقدمة</div>
              <div class="pc-feat-item no"><i class="bi bi-x-circle-fill"></i> دعم أولوية</div>
            </div>
          </div>
          <!-- Pro -->
          <div class="plan-card" id="planPro" onclick="selectPlan('pro')" style="position:relative">
            <div style="position:absolute;top:-1px;left:-1px;right:-1px;height:3px;background:linear-gradient(90deg,var(--gold),#F59E0B);border-radius:var(--r-sm) var(--r-sm) 0 0"></div>
            <div class="pc-badge pcb-pro"><i class="bi bi-star-fill"></i> الأكثر شيوعاً</div>
            <div class="pc-price">٩٩٠ دج <span>/ شهر</span></div>
            <div class="pc-name">خطة العائلة المميزة</div>
            <div class="pc-feat">
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> عدد غير محدود من الأطفال</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> جميع الوحدات والمواد</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> تقارير تفصيلية يومية</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> محتوى تفاعلي متقدم</div>
              <div class="pc-feat-item"><i class="bi bi-check-circle-fill"></i> دعم أولوية ٢٤/٧</div>
            </div>
          </div>
        </div>
        <button class="ss-save-btn" style="width:100%;justify-content:center;padding:.75rem" onclick="showToast('الترقية إلى المميز — قريباً!','green')">
          <i class="bi bi-lightning-fill"></i> الترقية إلى الخطة المميزة
        </button>
        <div style="text-align:center;margin-top:.7rem;font-size:.73rem;color:var(--gray-400);font-weight:700">
          <i class="bi bi-shield-check"></i> دفع آمن · يمكن الإلغاء في أي وقت
        </div>
      </div>
    </div>

    <!-- ══════ APPEARANCE ══════ -->
    <div class="sett-section" id="sec-appearance">
      <div class="ss-head">
        <div class="ss-head-left">
          <div class="ss-icon" style="background:#F3F0FF">
            <i class="bi bi-palette-fill" style="color:var(--purple)"></i>
          </div>
          <div>
            <div class="ss-title">المظهر واللغة</div>
            <div class="ss-sub">تخصيص واجهة المنصة</div>
          </div>
        </div>
        <button class="ss-save-btn" onclick="saveSection('appearance')">
          <i class="bi bi-check-lg"></i> <span>حفظ</span>
        </button>
      </div>
      <div class="ss-body">
        <div style="font-size:.78rem;font-weight:900;color:var(--gray-400);letter-spacing:.07em;text-transform:uppercase;margin-bottom:.85rem">🌐 اللغة</div>
        <div class="form-grid" style="margin-bottom:1.4rem">
          <div class="f-group">
            <label class="f-label"><i class="bi bi-globe2"></i> لغة الواجهة</label>
            <div class="f-input-wrap">
              <select class="f-select" onchange="markDirty()">
                <option value="ar" selected>العربية</option>
                <option value="fr">Français</option>
                <option value="en">English</option>
              </select>
              <i class="bi bi-globe2 f-icon"></i>
            </div>
          </div>
          <div class="f-group">
            <label class="f-label"><i class="bi bi-translate"></i> لغة المحتوى التعليمي</label>
            <div class="f-input-wrap">
              <select class="f-select" onchange="markDirty()">
                <option value="ar" selected>العربية (الفصحى)</option>
                <option value="ar-dz">العربية الجزائرية</option>
                <option value="fr">Français</option>
              </select>
              <i class="bi bi-translate f-icon"></i>
            </div>
          </div>
        </div>
        <div style="font-size:.78rem;font-weight:900;color:var(--gray-400);letter-spacing:.07em;text-transform:uppercase;margin-bottom:.85rem">🎨 المظهر</div>
        <div class="toggle-list">
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:#F3F0FF"><i class="bi bi-moon-fill" style="color:var(--purple)"></i></div>
              <div>
                <div class="tr-title">الوضع الليلي</div>
                <div class="tr-desc">واجهة داكنة لراحة العين</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" onchange="markDirty();showToast('الوضع الليلي قريباً!','green')"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--green-pale)"><i class="bi bi-eye-fill" style="color:var(--green)"></i></div>
              <div>
                <div class="tr-title">وضع إمكانية الوصول</div>
                <div class="tr-desc">خطوط أكبر وتباين أعلى</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
          <div class="toggle-row">
            <div class="tr-left">
              <div class="tr-icon" style="background:var(--gold-pale)"><i class="bi bi-volume-up-fill" style="color:var(--gold2)"></i></div>
              <div>
                <div class="tr-title">أصوات الواجهة</div>
                <div class="tr-desc">تأثيرات صوتية عند التفاعل</div>
              </div>
            </div>
            <label class="tog"><input type="checkbox" checked onchange="markDirty()"><div class="tog-track"></div><div class="tog-thumb"></div></label>
          </div>
        </div>
      </div>
    </div>

    <!-- Save bar -->
    <div class="save-bar" id="saveBar">
      <div class="sb-msg"><i class="bi bi-exclamation-circle-fill"></i> لديك تغييرات غير محفوظة</div>
      <div class="sb-actions">
        <button class="sba-cancel" onclick="cancelChanges()">تجاهل</button>
        <button class="sba-save" onclick="saveAll()"><i class="bi bi-check-lg"></i> حفظ الكل</button>
      </div>
    </div>

  </div><!-- /sett-content -->
</div><!-- /sett-layout -->

<script>
/* ════ Tab switching ════ */
var tabs = ['profile','children','notifications','security','plan','appearance'];

function switchTab(tab){
  event && event.preventDefault && event.preventDefault();
  tabs.forEach(function(t){
    var sec = document.getElementById('sec-'+t);
    if(sec) sec.classList.toggle('active', t===tab);
  });
  document.querySelectorAll('.sn-item').forEach(function(el,i){
    el.classList.toggle('active', tabs[i]===tab);
  });
  window.scrollTo({top:0,behavior:'smooth'});
}

/* ════ Dirty state ════ */
var isDirty = false;
function markDirty(){
  isDirty = true;
  document.getElementById('saveBar').classList.add('show');
}
function cancelChanges(){
  isDirty = false;
  document.getElementById('saveBar').classList.remove('show');
  showToast('تم تجاهل التغييرات','orange');
}
function saveAll(){
  isDirty = false;
  document.getElementById('saveBar').classList.remove('show');
  showToast('تم حفظ جميع التغييرات بنجاح ✓','green');
}

/* ════ Section save ════ */
function saveSection(name){
  var labels = {
    profile:'تم حفظ الملف الشخصي ✓',
    notifications:'تم حفظ الإشعارات ✓',
    appearance:'تم حفظ إعدادات المظهر ✓',
    security:'تم تحديث كلمة المرور ✓',
  };
  isDirty = false;
  document.getElementById('saveBar').classList.remove('show');
  showToast(labels[name] || 'تم الحفظ ✓','green');
}

/* ════ Plan selection ════ */
function selectPlan(plan){
  document.getElementById('planFree').classList.toggle('selected', plan==='free');
  document.getElementById('planPro').classList.toggle('selected',  plan==='pro');
  if(plan==='pro') showToast('الترقية إلى المميز — قريباً!','green');
}

/* ════ Delete confirm ════ */
function confirmDelete(name){
  if(confirm('هل أنت متأكد من حذف ملف '+name+'؟ لا يمكن التراجع.')){
    showToast('تم حذف ملف '+name+' — (تجريبي فقط)','orange');
  }
}

/* ════ Password strength ════ */
function checkPassStrength(el){
  markDirty();
  var val = el.value;
  var wrap = document.getElementById('passStrengthWrap');
  var fill = document.getElementById('passFill');
  var label = document.getElementById('passLabel');
  if(!val){ wrap.style.display='none'; return; }
  wrap.style.display='block';
  var score = 0;
  if(val.length >= 8)   score++;
  if(/[A-Z]/.test(val)) score++;
  if(/[0-9]/.test(val)) score++;
  if(/[^A-Za-z0-9]/.test(val)) score++;
  var configs = [
    {w:'25%', c:'#C1392B', lbl:'ضعيف جداً',   lc:'#C1392B'},
    {w:'50%', c:'#E07824', lbl:'متوسط',        lc:'#E07824'},
    {w:'75%', c:'#E8B830', lbl:'جيد',          lc:'#D4A520'},
    {w:'100%',c:'#2D7A45', lbl:'قوي جداً ✓',  lc:'#2D7A45'},
  ];
  var cfg = configs[Math.max(0,score-1)];
  fill.style.width     = cfg.w;
  fill.style.background= cfg.c;
  label.textContent    = cfg.lbl;
  label.style.color    = cfg.lc;
}

/* ════ Toast (inherited from footer) ════ */
function showToast(msg, type){
  var old = document.getElementById('_st');
  if(old) old.remove();
  var colors = {green:'#2D7A45',orange:'#E07824',red:'#C1392B'};
  var t = document.createElement('div');
  t.id = '_st';
  t.style.cssText = 'position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(12px);background:'+(colors[type]||colors.green)+';color:#fff;font-family:var(--font);font-size:.85rem;font-weight:800;padding:.65rem 1.3rem;border-radius:50px;z-index:9999;box-shadow:0 8px 28px rgba(0,0,0,.2);animation:toastIn .3s ease forwards;white-space:nowrap';
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(function(){
    t.style.opacity='0';t.style.transform='translateX(-50%) translateY(8px)';
    t.style.transition='all .3s ease';
    setTimeout(function(){t.remove()},300);
  },2800);
}

/* ════ Children & Screen Time (real data) ════ */
var _settChildren = [];
var _settColors   = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];

function getParentId(){
  try { return JSON.parse(sessionStorage.getItem('makam_user')||'{}').id || ''; } catch(e){ return ''; }
}

function loadSettChildren(){
  var pid = getParentId();
  var list = document.getElementById('settChildrenList');
  var stList = document.getElementById('settScreenTimeList');
  if(!pid){
    list.innerHTML = '<div style="padding:1.5rem;text-align:center;color:var(--gray-400);font-weight:700">سجّل الدخول لرؤية الأطفال</div>';
    return;
  }

  fetch('/api/auth_children?parent_id=' + encodeURIComponent(pid))
  .then(function(r){ return r.json(); })
  .then(function(res){
    var kids = (res.ok && res.data.children) ? res.data.children : [];
    _settChildren = kids;

    if(!kids.length){
      list.innerHTML = '<div style="text-align:center;padding:1.5rem;color:var(--gray-400);font-weight:700"><i class="bi bi-people" style="font-size:2rem;display:block;margin-bottom:.4rem;opacity:.2"></i>لا يوجد أطفال مسجلون — أضف طفلك الأول!</div>';
    } else {
      list.innerHTML = kids.map(function(kid, i){
        var c = _settColors[i % _settColors.length];
        return '<div class="child-row" id="srow-'+kid.id+'">' +
          '<div class="cr-avatar" style="background:'+c+'">'+kid.fname.charAt(0)+'</div>' +
          '<div class="cr-info">' +
            '<div class="cr-name">'+kid.fname+' '+kid.lname+'</div>' +
            '<div class="cr-meta">' +
              '<span><i class="bi bi-calendar2"></i> '+kid.age+' سنوات</span>' +
              '<span style="opacity:.4">•</span>' +
              '<span>@'+kid.username+'</span>' +
              '<span style="opacity:.4">•</span>' +
              '<span>'+(kid.gender==='girl'?'بنت':'ولد')+'</span>' +
            '</div>' +
          '</div>' +
          '<div class="cr-actions">' +
            '<button class="cr-btn crb-del" onclick="removeChild(\''+kid.id+'\',\''+kid.fname+'\')">' +
              '<i class="bi bi-trash-fill"></i>' +
            '</button>' +
          '</div>' +
        '</div>';
      }).join('') +
      '<div class="child-row" style="border-style:dashed;background:var(--gold-pale);border-color:rgba(232,184,48,.35);cursor:pointer;justify-content:center;gap:.6rem" onclick="openAddChildModal()">' +
        '<i class="bi bi-plus-circle-fill" style="color:var(--gold2);font-size:1.2rem"></i>' +
        '<span style="font-size:.87rem;font-weight:900;color:var(--gold2)">إضافة طفل جديد</span>' +
      '</div>';
    }

    // Load screen time for each child
    return fetch('/api/screen_time?parent_id=' + encodeURIComponent(pid));
  })
  .then(function(r){ return r ? r.json() : {ok:false}; })
  .then(function(res){
    var stMap = {};
    if(res && res.ok && res.data && res.data.limits){
      res.data.limits.forEach(function(l){ stMap[l.child_id] = l; });
    }
    renderScreenTimeList(stMap);
  })
  .catch(function(){
    list.innerHTML = '<div style="padding:1.5rem;text-align:center;color:var(--gray-400);font-weight:700">تعذّر تحميل البيانات</div>';
  });
}

function renderScreenTimeList(stMap){
  var stList = document.getElementById('settScreenTimeList');
  if(!_settChildren.length){
    stList.innerHTML = '<div style="font-size:.82rem;color:var(--gray-400);font-weight:700;padding:.5rem">لا يوجد أطفال لضبط وقت الشاشة.</div>';
    return;
  }
  stList.innerHTML = _settChildren.map(function(kid, i){
    var c = _settColors[i % _settColors.length];
    var lim = stMap[kid.id];
    var mins = lim ? lim.daily_minutes : 0;
    var enabled = mins > 0;
    return '<div class="toggle-row" id="st-row-'+kid.id+'">' +
      '<div class="tr-left">' +
        '<div class="tr-icon" style="background:'+c+'22;color:'+c+'"><i class="bi bi-clock-history"></i></div>' +
        '<div>' +
          '<div class="tr-title">وقت الشاشة — '+kid.fname+'</div>' +
          '<div class="tr-desc" id="st-desc-'+kid.id+'">' +
            (enabled ? 'الحد اليومي: '+mins+' دقيقة' : 'لا يوجد حد (غير محدود)') +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div style="display:flex;align-items:center;gap:8px">' +
        '<input type="number" id="st-inp-'+kid.id+'" min="0" max="480" value="'+mins+'" placeholder="0"' +
          ' style="width:65px;padding:4px 8px;border:1.5px solid var(--gray-200);border-radius:8px;font-family:var(--font);font-size:.82rem;text-align:center">' +
        '<span style="font-size:.73rem;color:var(--gray-400);font-weight:700">د/يوم</span>' +
        '<button onclick="saveChildScreenTime(\''+kid.id+'\',\''+kid.fname+'\')" style="padding:5px 12px;border-radius:8px;background:var(--green);color:#fff;border:none;font-family:var(--font);font-size:.78rem;font-weight:800;cursor:pointer">حفظ</button>' +
      '</div>' +
    '</div>';
  }).join('');
}

function saveChildScreenTime(childId, name){
  var val = parseInt(document.getElementById('st-inp-'+childId).value) || 0;
  fetch('/api/screen_time', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ child_id: childId, daily_minutes: val, enabled: val > 0 })
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(res.ok){
      var desc = document.getElementById('st-desc-'+childId);
      if(desc) desc.textContent = val > 0 ? 'الحد اليومي: '+val+' دقيقة' : 'لا يوجد حد (غير محدود)';
      showToast('تم حفظ وقت الشاشة لـ '+name+' ✓','green');
    } else {
      showToast('خطأ: '+(res.error||'تعذّر الحفظ'),'orange');
    }
  })
  .catch(function(){ showToast('خطأ في الاتصال','orange'); });
}

function removeChild(childId, name){
  if(!confirm('هل أنت متأكد من حذف ملف '+name+'؟ لا يمكن التراجع.')) return;
  fetch('/api/admin_remove_child', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ child_id: childId })
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(res.ok){
      var row = document.getElementById('srow-'+childId);
      if(row){ row.style.opacity='0'; row.style.transition='.3s'; setTimeout(function(){ loadSettChildren(); },350); }
      showToast('تم حذف ملف '+name,'orange');
    } else {
      alert('خطأ: '+(res.error||'تعذّر الحذف'));
    }
  })
  .catch(function(){ alert('حدث خطأ في الاتصال'); });
}

/* ── Add child modal ── */
function openAddChildModal(){
  var m = document.getElementById('addChildModalSett');
  m.style.display = 'flex';
  document.getElementById('acResult').style.display = 'none';
  ['acFname','acLname','acAge','acDisease'].forEach(function(id){ document.getElementById(id).value=''; });
}
function closeAddChildModal(){
  document.getElementById('addChildModalSett').style.display = 'none';
}
function submitAddChild(){
  var pid   = getParentId();
  var fname = document.getElementById('acFname').value.trim();
  var lname = document.getElementById('acLname').value.trim();
  var age   = parseInt(document.getElementById('acAge').value) || 0;
  var gender= document.getElementById('acGender').value;
  var dis   = document.getElementById('acDisease').value.trim();

  if(!fname||!lname||!age){ alert('يرجى ملء جميع الحقول المطلوبة'); return; }

  var btn = document.getElementById('acSubmitBtn');
  btn.textContent = 'جاري الإضافة...'; btn.disabled = true;

  fetch('/api/auth_add_child', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ parent_id: pid, fname: fname, lname: lname, age: age, gender: gender, disease: dis })
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
    btn.disabled = false;
    var el = document.getElementById('acResult');
    el.style.display = 'block';
    if(res.ok){
      var d = res.data;
      el.style.background='#f0fff4'; el.style.border='1.5px solid #bbf7d0'; el.style.color='#166534';
      el.innerHTML = '✅ تمت الإضافة!<br><strong>اسم المستخدم:</strong> '+d.username+'<br><strong>رمز الدخول:</strong> '+d.password.slice(0,4)+' – '+d.password.slice(4);
      // Refresh
      loadSettChildren();
      // Also update sessionStorage children list for the profile picker
      var user = JSON.parse(sessionStorage.getItem('makam_user')||'{}');
      if(user && user.children){
        user.children.push({ id: d.id, fname: fname, lname: lname, age: age, username: d.username, gender: gender });
        sessionStorage.setItem('makam_user', JSON.stringify(user));
      }
    } else {
      el.style.background='#fff1f2'; el.style.border='1.5px solid #fecdd3'; el.style.color='#be123c';
      el.textContent = '❌ خطأ: '+(res.error||'تعذّرت الإضافة');
    }
  })
  .catch(function(){
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
    btn.disabled = false;
    alert('حدث خطأ في الاتصال');
  });
}

/* Load children when tab is opened */
(function(){
  var origSwitch = window.switchTab;
  window.switchTab = function(tab){
    origSwitch && origSwitch(tab);
    if(tab === 'children') loadSettChildren();
  };
  // Also load on DOMContentLoaded if already on children tab
  document.addEventListener('DOMContentLoaded', function(){
    if(document.getElementById('sec-children').classList.contains('active')){
      loadSettChildren();
    }
  });
})();
</script>

<?php require_once __DIR__ . '/../../../site/frontend/includes/dashboard/parent/footer.php'; ?>
