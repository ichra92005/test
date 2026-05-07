  </div><!-- /dash-content -->
</div><!-- /dash-main -->

<!-- ════════════════════════════════════════
   MODAL: الإشعارات
════════════════════════════════════════ -->
<style>
/* ── Notification Modal ── */
.notif-overlay{
  position:fixed;inset:0;background:rgba(10,20,12,.65);
  z-index:1100;display:none;align-items:flex-start;justify-content:flex-end;
  padding:4.5rem 1.5rem 1.5rem;
  backdrop-filter:blur(6px);
  animation:overlayIn .22s ease;
}
.notif-overlay.show{display:flex}

.notif-box{
  background:var(--white);
  border-radius:20px;
  width:100%;max-width:420px;
  max-height:calc(100vh - 6rem);
  display:flex;flex-direction:column;
  box-shadow:0 24px 80px rgba(0,0,0,.28);
  animation:notifSlide .3s cubic-bezier(.34,1.4,.64,1);
  overflow:hidden;
}
@keyframes notifSlide{
  from{opacity:0;transform:translateY(-24px) scale(.96)}
  to{opacity:1;transform:none}
}

/* Notif Header */
.notif-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:1.1rem 1.3rem;
  background:linear-gradient(135deg,#C96B1A 0%,#E07824 60%,#F59E0B 100%);
  flex-shrink:0;position:relative;overflow:hidden;
}
.notif-head::before{
  content:'';position:absolute;
  width:150px;height:150px;border-radius:50%;
  background:rgba(255,255,255,.06);
  top:-60px;right:-40px;pointer-events:none;
}
.notif-head::after{
  content:'';position:absolute;
  width:90px;height:90px;border-radius:50%;
  background:rgba(255,255,255,.05);
  bottom:-30px;left:30px;pointer-events:none;
}
.nh-left{display:flex;align-items:center;gap:.75rem;position:relative;z-index:1}
.nh-icon{
  width:42px;height:42px;border-radius:12px;
  background:rgba(255,255,255,.2);border:1.5px solid rgba(255,255,255,.25);
  display:flex;align-items:center;justify-content:center;
  font-size:1.15rem;color:#fff;flex-shrink:0;
}
.nh-title{font-size:.98rem;font-weight:900;color:#fff;line-height:1.2}
.nh-sub{font-size:.72rem;color:rgba(255,255,255,.75);font-weight:700;margin-top:.1rem}
.nh-count{
  display:inline-flex;align-items:center;gap:.25rem;
  background:rgba(255,255,255,.22);border:1px solid rgba(255,255,255,.3);
  color:#fff;font-size:.72rem;font-weight:900;
  padding:.2rem .65rem;border-radius:50px;margin-top:.3rem;
}
.nh-right{display:flex;align-items:center;gap:.5rem;position:relative;z-index:1}
.nh-close{
  width:32px;height:32px;border-radius:50%;
  background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;color:#fff;font-size:.95rem;
  transition:var(--tr);flex-shrink:0;
}
.nh-close:hover{background:rgba(255,255,255,.28);transform:rotate(90deg)}
.nh-mark-all{
  font-size:.72rem;font-weight:800;color:rgba(255,255,255,.85);
  background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);
  border-radius:50px;padding:.25rem .65rem;cursor:pointer;
  transition:var(--tr);
}
.nh-mark-all:hover{background:rgba(255,255,255,.22);color:#fff}

/* Notif Tabs */
.notif-tabs{
  display:flex;border-bottom:2px solid var(--gray-100);
  flex-shrink:0;background:var(--white);
}
.notif-tab{
  flex:1;padding:.65rem;text-align:center;
  font-size:.8rem;font-weight:800;color:var(--gray-400);
  cursor:pointer;transition:var(--tr);position:relative;border:none;background:none;
  font-family:var(--font);
}
.notif-tab.active{color:var(--orange2)}
.notif-tab.active::after{
  content:'';position:absolute;bottom:-2px;right:0;left:0;
  height:2.5px;background:var(--orange2);border-radius:50px;
}
.notif-tab-badge{
  display:inline-flex;align-items:center;justify-content:center;
  background:var(--red);color:#fff;
  font-size:.58rem;font-weight:900;
  min-width:16px;height:16px;border-radius:50px;
  padding:0 .3rem;margin-right:.25rem;vertical-align:middle;
}

/* Notif Body */
.notif-body{
  flex:1;overflow-y:auto;
  min-height:0;
}
.notif-body::-webkit-scrollbar{width:4px}
.notif-body::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:50px}

/* Empty state */
.notif-empty{
  padding:2.5rem 1.5rem;text-align:center;
}
.ne-icon{
  width:72px;height:72px;border-radius:20px;
  background:linear-gradient(135deg,var(--orange-pale),#FFF0D6);
  display:flex;align-items:center;justify-content:center;
  font-size:2rem;margin:0 auto 1rem;
  border:2px solid rgba(224,120,36,.12);
}
.ne-title{font-size:.95rem;font-weight:900;color:var(--gray-700);margin-bottom:.35rem}
.ne-sub{font-size:.79rem;color:var(--gray-400);font-weight:700;line-height:1.6}

/* Loading state */
.notif-loading{
  padding:2rem;text-align:center;
  font-size:.83rem;color:var(--gray-400);font-weight:700;
}
.nl-spinner{
  width:38px;height:38px;border-radius:50%;
  border:3px solid var(--gray-200);
  border-top-color:var(--orange);
  margin:0 auto .75rem;
  animation:spin .7s linear infinite;
}

/* Notif Request Item */
.nr-item{
  padding:1rem 1.2rem;
  border-bottom:1.5px solid var(--gray-100);
  animation:slideReq .3s ease;
  transition:background .18s;
}
.nr-item:last-child{border-bottom:none}
.nr-item:hover{background:var(--gray-50)}

.nr-top{display:flex;align-items:center;gap:.75rem;margin-bottom:.7rem}
.nr-avatar{
  width:44px;height:44px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;font-weight:900;color:#fff;
  box-shadow:0 4px 12px rgba(0,0,0,.15);
  position:relative;
}
.nr-avatar-dot{
  position:absolute;bottom:0;left:0;
  width:13px;height:13px;border-radius:50%;
  background:var(--orange);
  border:2.5px solid var(--white);
}
.nr-info{flex:1;min-width:0}
.nr-name{font-size:.9rem;font-weight:900;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.nr-meta{font-size:.72rem;color:var(--gray-400);font-weight:700;margin-top:.12rem;display:flex;align-items:center;gap:.35rem;flex-wrap:wrap}
.nr-meta i{font-size:.68rem}
.nr-time{
  font-size:.68rem;font-weight:800;color:var(--orange2);
  background:var(--orange-pale);padding:.18rem .55rem;
  border-radius:50px;white-space:nowrap;flex-shrink:0;
}

.nr-type-row{
  display:flex;align-items:center;gap:.5rem;
  background:var(--orange-pale);border:1px solid rgba(224,120,36,.15);
  border-radius:9px;padding:.55rem .75rem;margin-bottom:.75rem;
}
.nr-type-icon{
  width:30px;height:30px;border-radius:8px;
  background:var(--orange);
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;color:#fff;flex-shrink:0;
}
.nr-type-text{font-size:.78rem;font-weight:800;color:var(--orange2);line-height:1.3}
.nr-type-sub{font-size:.68rem;color:var(--gray-400);font-weight:700}

.nr-actions{display:flex;gap:.5rem}
.nr-btn{
  flex:1;display:flex;align-items:center;justify-content:center;gap:.35rem;
  padding:.55rem;border-radius:10px;border:none;
  font-family:var(--font);font-size:.82rem;font-weight:900;cursor:pointer;
  transition:var(--tr);
}
.nrb-ok{
  background:linear-gradient(135deg,var(--green),var(--green2));
  color:#fff;box-shadow:0 4px 14px rgba(45,122,69,.25);
}
.nrb-ok:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(45,122,69,.35)}
.nrb-no{
  background:var(--red-pale);color:var(--red);
  border:1.5px solid rgba(193,57,43,.18);
}
.nrb-no:hover{background:var(--red);color:#fff;transform:translateY(-1px)}

/* Notif Footer */
.notif-foot{
  padding:.75rem 1.2rem;
  border-top:1.5px solid var(--gray-100);
  flex-shrink:0;
  display:flex;align-items:center;justify-content:space-between;
  background:var(--gray-50);
}
.nf-info{font-size:.72rem;color:var(--gray-400);font-weight:700;display:flex;align-items:center;gap:.3rem}
.nf-refresh{
  display:flex;align-items:center;gap:.3rem;
  font-size:.76rem;font-weight:800;color:var(--orange2);
  background:var(--orange-pale);border:1px solid rgba(224,120,36,.18);
  border-radius:50px;padding:.28rem .75rem;cursor:pointer;
  transition:var(--tr);
}
.nf-refresh:hover{background:var(--orange);color:#fff}
.nf-refresh i{transition:transform .4s}
.nf-refresh:hover i{transform:rotate(360deg)}

@media(max-width:480px){
  .notif-overlay{padding:3.8rem .75rem .75rem;align-items:flex-start;justify-content:center}
  .notif-box{max-width:100%}
}
</style>

<div class="notif-overlay" id="notifModal" onclick="handleNotifOverlayClick(event)">
  <div class="notif-box">

    <!-- Head -->
    <div class="notif-head">
      <div class="nh-left">
        <div class="nh-icon"><i class="bi bi-bell-fill"></i></div>
        <div>
          <div class="nh-title">الإشعارات</div>
          <div class="nh-sub">طلبات دخول أطفالك تنتظر موافقتك</div>
          <div class="nh-count" id="notifCount"><i class="bi bi-circle-fill" style="font-size:.45rem;color:var(--gold)"></i> <span id="notifCountNum">0</span> طلب معلّق</div>
        </div>
      </div>
      <div class="nh-right">
        <button class="nh-close" onclick="closeNotifModal()" title="إغلاق"><i class="bi bi-x-lg"></i></button>
      </div>
    </div>

    <!-- Tabs -->
    <div class="notif-tabs">
      <button class="notif-tab active" id="ntab-pending" onclick="switchNotifTab('pending')">
        <span class="notif-tab-badge" id="ntab-pending-badge" style="display:none">0</span>
        طلبات الدخول
      </button>
      <button class="notif-tab" id="ntab-activity" onclick="switchNotifTab('activity')">
        آخر النشاطات
      </button>
    </div>

    <!-- Body -->
    <div class="notif-body" id="notifBody">
      <div class="notif-loading">
        <div class="nl-spinner"></div>
        جاري تحميل الإشعارات...
      </div>
    </div>

    <!-- Footer -->
    <div class="notif-foot">
      <div class="nf-info"><i class="bi bi-arrow-repeat"></i> يتجدد تلقائياً كل 5 ثوانٍ</div>
      <div class="nf-refresh" onclick="refreshNotifManual()">
        <i class="bi bi-arrow-clockwise" id="notifRefreshIcon"></i> تحديث
      </div>
    </div>
  </div>
</div>

<script>
/* ════ Notification Modal ════ */
var _notifTab = 'pending';
var _notifOpen = false;

function openNotifModal(){
  document.getElementById('notifModal').classList.add('show');
  document.body.style.overflow = 'hidden';
  _notifOpen = true;
  _notifTab = 'pending';
  document.getElementById('ntab-pending').classList.add('active');
  document.getElementById('ntab-activity').classList.remove('active');
  /* إذا كان loadPendingRequests معرَّفاً، نحمّل البيانات */
  if(typeof loadPendingRequests === 'function'){
    loadPendingRequests();
  }
}

function closeNotifModal(){
  document.getElementById('notifModal').classList.remove('show');
  document.body.style.overflow = '';
  _notifOpen = false;
}

function handleNotifOverlayClick(e){
  if(e.target === document.getElementById('notifModal')) closeNotifModal();
}

function switchNotifTab(tab){
  _notifTab = tab;
  document.querySelectorAll('.notif-tab').forEach(function(t){ t.classList.remove('active'); });
  document.getElementById('ntab-' + tab).classList.add('active');
  updateNotifBody();
}

var _notifReqs = [];
var _notifActs = [
  {icon:'bi-star-fill',color:'var(--green)',bg:'var(--green-pale)',title:'أمين — أكمل درساً جديداً',sub:'وحدة الجزائر · الدرس الأول',time:'منذ 30 دقيقة'},
  {icon:'bi-trophy-fill',color:'var(--orange)',bg:'var(--orange-pale)',title:'سارة — حصلت على شارة',sub:'شارة "النجم الصاعد" ⭐',time:'منذ 3 ساعات'},
  {icon:'bi-lightning-fill',color:'var(--purple)',bg:'#F3F0FF',title:'سارة — أتمت وحدة بشار',sub:'8/8 دروس مكتملة ✓',time:'أمس الساعة 18:30'},
];

function updateNotifBody(){
  var el = document.getElementById('notifBody');
  if(_notifTab === 'pending'){
    el.innerHTML = renderNotifRequests(_notifReqs);
  } else {
    el.innerHTML = renderNotifActivity(_notifActs);
  }
}

var _notifColors = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];

function renderNotifRequests(reqs){
  /* عدّاد الشارة */
  var badge = document.getElementById('ntab-pending-badge');
  if(badge){
    badge.textContent = reqs.length;
    badge.style.display = reqs.length > 0 ? 'inline-flex' : 'none';
  }
  var countEl = document.getElementById('notifCountNum');
  if(countEl) countEl.textContent = reqs.length;

  if(!reqs.length){
    return '<div class="notif-empty">' +
      '<div class="ne-icon"><i class="bi bi-bell-slash-fill" style="color:var(--orange2)"></i></div>' +
      '<div class="ne-title">لا توجد طلبات معلّقة</div>' +
      '<div class="ne-sub">جميع طلبات دخول أطفالك<br>تمت معالجتها بنجاح ✓</div>' +
    '</div>';
  }

  var html = '';
  reqs.forEach(function(r, i){
    var color = _notifColors[i % _notifColors.length];
    html += '<div class="nr-item" id="nreq-' + r.token + '">' +
      '<div class="nr-top">' +
        '<div class="nr-avatar" style="background:linear-gradient(135deg,' + color + ',' + color + 'BB)">' +
          r.child_fname.charAt(0) +
          '<div class="nr-avatar-dot"></div>' +
        '</div>' +
        '<div class="nr-info">' +
          '<div class="nr-name">' + r.child_fname + ' ' + r.child_lname + '</div>' +
          '<div class="nr-meta">' +
            '<i class="bi bi-calendar3-fill"></i>' + r.child_age + ' سنة' +
            ' · <i class="bi bi-person-badge-fill"></i>@' + r.username +
          '</div>' +
        '</div>' +
        '<div class="nr-time">' + (typeof timeAgo==='function' ? timeAgo(r.created_at) : '') + '</div>' +
      '</div>' +
      '<div class="nr-type-row">' +
        '<div class="nr-type-icon"><i class="bi bi-door-open-fill"></i></div>' +
        '<div>' +
          '<div class="nr-type-text">طلب دخول للمنصة</div>' +
          '<div class="nr-type-sub">يريد الدخول إلى حسابه على مقام</div>' +
        '</div>' +
      '</div>' +
      '<div class="nr-actions">' +
        '<button class="nr-btn nrb-ok" onclick="decideAndUpdate(\'' + r.token + '\',\'approved\')">' +
          '<i class="bi bi-check-lg"></i> سماح بالدخول' +
        '</button>' +
        '<button class="nr-btn nrb-no" onclick="decideAndUpdate(\'' + r.token + '\',\'rejected\')">' +
          '<i class="bi bi-x-lg"></i> رفض' +
        '</button>' +
      '</div>' +
    '</div>';
  });
  return html;
}

function renderNotifActivity(acts){
  var html = '<div style="padding:.5rem 0">';
  acts.forEach(function(a){
    html += '<div style="display:flex;align-items:flex-start;gap:.75rem;padding:.85rem 1.2rem;border-bottom:1px solid var(--gray-100)">' +
      '<div style="width:38px;height:38px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.9rem;background:' + a.bg + '">' +
        '<i class="bi ' + a.icon + '" style="color:' + a.color + '"></i>' +
      '</div>' +
      '<div>' +
        '<div style="font-size:.83rem;font-weight:900;color:var(--gray-800);margin-bottom:.1rem">' + a.title + '</div>' +
        '<div style="font-size:.76rem;color:var(--gray-500);font-weight:700;margin-bottom:.2rem">' + a.sub + '</div>' +
        '<div style="font-size:.67rem;color:var(--gray-400);font-weight:600">' + a.time + '</div>' +
      '</div>' +
    '</div>';
  });
  html += '</div>';
  return html;
}

/* يُستدعى من index.php بعد كل تحديث للطلبات */
function updateNotifModalRequests(reqs){
  _notifReqs = reqs;
  if(_notifOpen && _notifTab === 'pending'){
    document.getElementById('notifBody').innerHTML = renderNotifRequests(reqs);
  } else {
    /* فقط حدّث الشارة */
    var badge = document.getElementById('ntab-pending-badge');
    if(badge){
      badge.textContent = reqs.length;
      badge.style.display = reqs.length > 0 ? 'inline-flex' : 'none';
    }
    var countEl = document.getElementById('notifCountNum');
    if(countEl) countEl.textContent = reqs.length;
  }
}

/* wrapper يقرأ من decideRequest الموجود في index.php */
function decideAndUpdate(token, decision){
  var el = document.getElementById('nreq-' + token);
  if(el){ el.style.opacity = '.45'; el.style.pointerEvents = 'none'; }
  if(typeof decideRequest === 'function'){
    decideRequest(token, decision, null);
  }
}

function refreshNotifManual(){
  var icon = document.getElementById('notifRefreshIcon');
  if(icon){ icon.style.animation = 'spin .6s linear'; setTimeout(function(){ icon.style.animation=''; },600); }
  if(typeof loadPendingRequests === 'function') loadPendingRequests();
}

/* ESC يغلق المودل */
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape' && _notifOpen) closeNotifModal();
});
</script>

<!-- ════════════════════════════════════════
   MODAL: إضافة طفل
════════════════════════════════════════ -->
<style>
.modal-overlay{
  position:fixed;inset:0;background:rgba(10,20,12,.6);
  z-index:1000;display:none;align-items:center;justify-content:center;
  padding:1.5rem;backdrop-filter:blur(4px);
  animation:overlayIn .25s ease;
}
.modal-overlay.show{display:flex}

.modal-box{
  background:var(--white);border-radius:22px;
  width:100%;max-width:540px;max-height:90vh;
  display:flex;flex-direction:column;
  box-shadow:0 32px 80px rgba(0,0,0,.25);
  animation:modalIn .32s cubic-bezier(.34,1.56,.64,1);
  overflow:hidden;
}

/* Modal Header */
.modal-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:1.3rem 1.5rem;
  background:linear-gradient(135deg,var(--green) 0%,var(--green2) 100%);
  flex-shrink:0;
}
.modal-head-left{display:flex;align-items:center;gap:.8rem}
.modal-head-icon{
  width:44px;height:44px;border-radius:12px;
  background:rgba(255,255,255,.18);
  display:flex;align-items:center;justify-content:center;
  font-size:1.3rem;color:#fff;
}
.modal-head-title{font-size:1rem;font-weight:900;color:#fff;line-height:1.2}
.modal-head-sub{font-size:.74rem;color:rgba(255,255,255,.7);font-weight:700}
.modal-close{
  width:34px;height:34px;border-radius:50%;
  background:rgba(255,255,255,.12);border:none;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;color:#fff;font-size:1rem;
  transition:var(--tr);flex-shrink:0;
}
.modal-close:hover{background:rgba(255,255,255,.25)}

/* Modal Body */
.modal-body{
  padding:1.6rem 1.5rem;overflow-y:auto;flex:1;
}
.modal-body::-webkit-scrollbar{width:4px}
.modal-body::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:50px}

/* Form inside modal */
.mf-row{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1rem}
.mf-group{margin-bottom:1rem}
.mf-label{
  display:flex;align-items:center;gap:.35rem;
  font-size:.82rem;font-weight:800;color:var(--gray-600);margin-bottom:.38rem;
}
.mf-label i{font-size:.85rem;color:var(--gray-400)}
.mf-label .req{color:var(--red);margin-right:1px}
.mf-wrap{position:relative}
.mf-input{
  width:100%;padding:.72rem .95rem .72rem 2.6rem;
  border:2px solid var(--gray-200);border-radius:var(--r-sm);
  font-family:var(--font);font-size:.9rem;color:var(--gray-800);
  background:var(--gray-50);transition:var(--tr);outline:none;direction:rtl;
}
.mf-input::placeholder{color:var(--gray-400)}
.mf-input:focus{border-color:var(--green);background:var(--white);box-shadow:0 0 0 3px rgba(45,122,69,.08)}
.mf-input.err{border-color:var(--red);background:var(--red-pale)}
.mf-input.ok{border-color:var(--green2)}
.mf-icon{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:.9rem;pointer-events:none}
.mf-hint{font-size:.72rem;color:var(--gray-400);font-weight:600;margin-top:.28rem;display:flex;align-items:center;gap:.3rem}
.mf-err{font-size:.73rem;color:var(--red);font-weight:700;margin-top:.28rem;display:none;align-items:center;gap:.3rem}
.mf-err.show{display:flex}
.mf-err i,.mf-hint i{font-size:.75rem}

/* Age badge */
.age-inline-badge{
  position:absolute;left:.8rem;top:50%;transform:translateY(-50%);
  font-size:.67rem;font-weight:900;padding:.12rem .45rem;
  border-radius:50px;pointer-events:none;transition:var(--tr);
}
.aib-ok{background:var(--green-pale);color:var(--green)}
.aib-warn{background:var(--gold-pale);color:var(--gold2)}
.aib-danger{background:var(--red-pale);color:var(--red)}

/* Needs toggle */
.mf-toggle{
  display:flex;align-items:center;gap:.75rem;
  background:var(--green-xpale);border:1.5px solid rgba(45,122,69,.14);
  border-radius:var(--r-sm);padding:.75rem .9rem;
  cursor:pointer;transition:var(--tr);margin-bottom:.85rem;user-select:none;
}
.mf-toggle:hover{background:var(--green-pale)}
.mf-toggle input{display:none}
.mf-check-box{
  width:20px;height:20px;border-radius:6px;
  border:2.5px solid var(--gray-300);background:var(--white);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:var(--tr);
}
.mf-toggle.checked .mf-check-box{background:var(--green);border-color:var(--green);box-shadow:0 2px 8px rgba(45,122,69,.3)}
.mf-check-box i{font-size:.7rem;color:#fff;opacity:0;transition:var(--tr)}
.mf-toggle.checked .mf-check-box i{opacity:1}
.mf-toggle-text{font-size:.83rem;font-weight:800;color:var(--gray-600);line-height:1.3}
.mf-toggle-sub{font-size:.72rem;color:var(--gray-400);font-weight:600}
.mf-detail{display:none;animation:fadeUp .25s ease}
.mf-detail.show{display:block}

/* CAPTCHA */
.mf-captcha{
  background:var(--gold-pale);border:1.5px solid rgba(232,184,48,.25);
  border-radius:var(--r-sm);padding:.9rem 1rem;margin-bottom:1rem;
}
.mf-captcha-label{font-size:.78rem;font-weight:800;color:var(--gray-500);margin-bottom:.55rem;display:flex;align-items:center;gap:.4rem}
.mf-captcha-label i{color:var(--gold2)}
.captcha-row{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
.cap-num{
  background:linear-gradient(135deg,var(--green),var(--green2));
  color:#fff;font-size:1.2rem;font-weight:900;
  padding:.3rem .75rem;border-radius:9px;min-width:40px;text-align:center;
  box-shadow:0 3px 10px rgba(45,122,69,.25);
}
.cap-op{font-size:1.3rem;font-weight:900;color:var(--orange2)}
.cap-eq{font-size:1.1rem;color:var(--gray-400);font-weight:900}
.cap-input{
  width:72px;padding:.5rem .6rem;border:2.5px solid var(--gray-200);
  border-radius:9px;font-family:var(--font);font-size:1rem;font-weight:900;
  text-align:center;color:var(--green);background:var(--white);
  outline:none;transition:var(--tr);direction:ltr;
}
.cap-input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(45,122,69,.09)}
.cap-input.err{border-color:var(--red);background:var(--red-pale)}
.cap-input.ok{border-color:var(--green2);background:var(--green-xpale)}
.cap-refresh{
  background:none;border:none;cursor:pointer;
  color:var(--gray-400);font-size:.85rem;padding:.2rem;transition:var(--tr);
}
.cap-refresh:hover{color:var(--orange2);transform:rotate(180deg)}

/* Terms */
.mf-terms{
  display:flex;align-items:flex-start;gap:.65rem;
  background:var(--orange-pale);border:1.5px solid rgba(224,120,36,.18);
  border-radius:var(--r-sm);padding:.75rem .9rem;
  cursor:pointer;user-select:none;transition:var(--tr);margin-bottom:1.2rem;
}
.mf-terms:hover{border-color:rgba(224,120,36,.3)}
.mf-terms input{display:none}
.mf-terms-box{
  width:20px;height:20px;border-radius:6px;
  border:2.5px solid var(--gray-300);background:var(--white);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:var(--tr);margin-top:2px;
}
.mf-terms.checked .mf-terms-box{background:linear-gradient(135deg,var(--orange),var(--orange2));border-color:var(--orange2)}
.mf-terms-box i{font-size:.7rem;color:#fff;opacity:0;transition:var(--tr)}
.mf-terms.checked .mf-terms-box i{opacity:1}
.mf-terms-text{font-size:.79rem;color:var(--gray-600);font-weight:700;line-height:1.55}
.mf-terms-text a{color:var(--orange2);font-weight:900;text-decoration:none}
.mf-terms-text a:hover{text-decoration:underline}

/* Modal Footer */
.modal-foot{
  display:flex;gap:.7rem;padding:1rem 1.5rem;
  border-top:1.5px solid var(--gray-100);flex-shrink:0;background:var(--white);
}
.mf-btn{
  flex:1;display:flex;align-items:center;justify-content:center;gap:.45rem;
  padding:.78rem;border-radius:var(--r-sm);border:none;
  font-family:var(--font);font-size:.9rem;font-weight:900;cursor:pointer;transition:var(--tr);
}
.mf-btn i{font-size:.95rem}
.mfb-cancel{background:var(--gray-100);color:var(--gray-500);border:1.5px solid var(--gray-200)}
.mfb-cancel:hover{background:var(--gray-200);color:var(--gray-700)}
.mfb-submit{background:linear-gradient(135deg,var(--green),var(--green2));color:#fff;box-shadow:var(--sh-green)}
.mfb-submit:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(45,122,69,.35)}

/* Modal Success */
.modal-success{
  display:none;text-align:center;padding:2rem 1.5rem;
  animation:fadeUp .4s ease;
}
.modal-success.show{display:block}
.ms-icon{
  width:80px;height:80px;border-radius:50%;margin:0 auto 1rem;
  background:linear-gradient(135deg,var(--green),var(--green2));
  display:flex;align-items:center;justify-content:center;
  box-shadow:var(--sh-green);
  animation:successBounce .5s cubic-bezier(.34,1.56,.64,1);
}
.ms-icon i{font-size:2.2rem;color:#fff}
.ms-title{font-size:1.2rem;font-weight:900;color:var(--gray-800);margin-bottom:.4rem}
.ms-title em{color:var(--green);font-style:normal}
.ms-desc{font-size:.85rem;color:var(--gray-500);line-height:1.7;margin-bottom:1.2rem}
.ms-card{
  background:var(--green-xpale);border:1.5px solid rgba(45,122,69,.12);
  border-radius:var(--r-sm);padding:.85rem 1rem;text-align:right;margin-bottom:1.2rem;
}
.ms-row{display:flex;justify-content:space-between;align-items:center;font-size:.83rem;padding:.25rem 0;border-bottom:1px solid rgba(45,122,69,.07)}
.ms-row:last-child{border-bottom:none}
.ms-row span:first-child{color:var(--gray-400);font-weight:700}
.ms-row span:last-child{color:var(--green);font-weight:900}

/* Toast */
@keyframes toastIn{from{opacity:0;transform:translateX(-50%) translateY(12px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}
</style>

<div class="modal-overlay" id="addChildModal" onclick="handleModalClick(event)">
  <div class="modal-box" id="modalBox">

    <!-- Head -->
    <div class="modal-head">
      <div class="modal-head-left">
        <div class="modal-head-icon"><i class="bi bi-person-plus-fill"></i></div>
        <div>
          <div class="modal-head-title">إضافة طفل جديد</div>
          <div class="modal-head-sub">أدخل معلومات طفلك للانضمام لمكام</div>
        </div>
      </div>
      <button class="modal-close" onclick="closeAddChildModal()"><i class="bi bi-x-lg"></i></button>
    </div>

    <!-- Form -->
    <div class="modal-body" id="modalFormWrap">
      <form id="addChildForm" novalidate onsubmit="submitAddChild(event)">

        <div class="mf-row">
          <div class="mf-group">
            <label class="mf-label"><i class="bi bi-person-fill"></i> اسم الطفل <span class="req">*</span></label>
            <div class="mf-wrap">
              <input type="text" id="ac_fname" class="mf-input" placeholder="الاسم">
              <i class="bi bi-person-fill mf-icon"></i>
            </div>
            <div class="mf-err" id="merr_ac_fname"><i class="bi bi-exclamation-circle-fill"></i> مطلوب</div>
          </div>
          <div class="mf-group">
            <label class="mf-label"><i class="bi bi-person-fill"></i> لقب الطفل <span class="req">*</span></label>
            <div class="mf-wrap">
              <input type="text" id="ac_lname" class="mf-input" placeholder="اللقب">
              <i class="bi bi-person-fill mf-icon"></i>
            </div>
            <div class="mf-err" id="merr_ac_lname"><i class="bi bi-exclamation-circle-fill"></i> مطلوب</div>
          </div>
        </div>

        <div class="mf-group">
          <label class="mf-label"><i class="bi bi-calendar-fill"></i> عمر الطفل <span class="req">*</span></label>
          <div class="mf-wrap">
            <input type="number" id="ac_age" class="mf-input" placeholder="مثال: 10" min="1" max="25"
              oninput="checkModalAge(this)" style="direction:ltr;text-align:right;padding-left:5.5rem">
            <i class="bi bi-calendar-fill mf-icon"></i>
            <div class="age-inline-badge" id="modalAgeBadge" style="display:none"></div>
          </div>
          <div class="mf-err" id="merr_ac_age"><i class="bi bi-exclamation-circle-fill"></i> <span id="mAgeMsg">العمر مطلوب (6–18 سنة)</span></div>
          <div class="mf-hint"><i class="bi bi-info-circle"></i> مخصص للأطفال من 6 إلى 18 سنة فقط</div>
        </div>

        <!-- Special needs -->
        <label class="mf-toggle" id="acNeedsToggle">
          <input type="checkbox" id="ac_needs" onchange="toggleAcNeeds(this)">
          <div class="mf-check-box"><i class="bi bi-check-lg"></i></div>
          <div>
            <div class="mf-toggle-text">ذوي الاحتياجات الخاصة؟</div>
            <div class="mf-toggle-sub">اختياري — يساعدنا في تخصيص التجربة</div>
          </div>
        </label>
        <div class="mf-detail" id="acNeedsDetail">
          <div class="mf-group">
            <label class="mf-label"><i class="bi bi-heart-pulse-fill" style="color:var(--red)"></i> نوع الاحتياج</label>
            <div class="mf-wrap">
              <input type="text" id="ac_disease" class="mf-input" placeholder="مثال: صعوبات التعلم...">
              <i class="bi bi-heart-pulse-fill mf-icon" style="color:var(--red)"></i>
            </div>
            <div class="mf-hint"><i class="bi bi-shield-check"></i> معلومة سرية لن تُشارَك</div>
          </div>
        </div>

        <!-- CAPTCHA -->
        <div class="mf-captcha">
          <div class="mf-captcha-label"><i class="bi bi-robot"></i> تحقق بسيط</div>
          <div class="captcha-row">
            <div class="cap-num" id="mcapN1">?</div>
            <div class="cap-op" id="mcapOp">+</div>
            <div class="cap-num" id="mcapN2">?</div>
            <div class="cap-eq">=</div>
            <input type="number" class="cap-input" id="mcapAnswer" placeholder="?" oninput="checkModalCap(this)" autocomplete="off">
            <button type="button" class="cap-refresh" onclick="genModalCaptcha()"><i class="bi bi-arrow-clockwise"></i></button>
          </div>
          <div class="mf-err" id="merr_captcha" style="margin-top:.4rem"><i class="bi bi-x-circle-fill"></i> إجابة غير صحيحة</div>
        </div>

        <!-- Terms -->
        <label class="mf-terms" id="acTermsCheck">
          <input type="checkbox" id="ac_terms" onchange="toggleAcTerms(this)">
          <div class="mf-terms-box"><i class="bi bi-check-lg"></i></div>
          <div class="mf-terms-text">
            أوافق على <a href="/terms" onclick="event.stopPropagation()">شروط الاستخدام</a>
            و<a href="/privacy" onclick="event.stopPropagation()">سياسة الخصوصية</a> الخاصة بمنصة مقام.
          </div>
        </label>
        <div class="mf-err" id="merr_terms"><i class="bi bi-exclamation-circle-fill"></i> يجب الموافقة على الشروط</div>

      </form>
    </div>

    <!-- Success -->
    <div class="modal-success" id="modalSuccess">
      <div class="ms-icon"><i class="bi bi-check-lg"></i></div>
      <div class="ms-title">تمت الإضافة <em>بنجاح!</em></div>
      <div class="ms-desc">تم إضافة ملف الطفل بنجاح إلى حسابك.<br>يمكنك الآن تتبع تقدمه من لوحة التحكم.</div>
      <div class="ms-card" id="mSuccessDetails"></div>
    </div>

    <!-- Footer -->
    <div class="modal-foot" id="modalFooter">
      <button class="mf-btn mfb-cancel" onclick="closeAddChildModal()">
        <i class="bi bi-x-lg"></i> إلغاء
      </button>
      <button class="mf-btn mfb-submit" id="acSubmitBtn" onclick="submitAddChild(event)">
        <i class="bi bi-person-plus-fill"></i> إضافة الطفل
      </button>
    </div>
  </div>
</div>

<script>
/* ════════════════════════════════════════
   MODAL STATE
════════════════════════════════════════ */
var acTermsChecked = false;
var acNeedsChecked = false;
var acCaptchaAnswer = 0;

/* ── Open / Close ── */
function openAddChildModal(){
  document.getElementById('addChildModal').classList.add('show');
  document.body.style.overflow = 'hidden';
  genModalCaptcha();
  /* reset */
  document.getElementById('addChildForm').reset();
  document.getElementById('modalSuccess').classList.remove('show');
  document.getElementById('modalFormWrap').style.display = '';
  document.getElementById('modalFooter').style.display = '';
  var btn = document.getElementById('acSubmitBtn');
  btn.disabled = false;
  btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
  /* reset toggles */
  acTermsChecked = false; acNeedsChecked = false;
  document.getElementById('acTermsCheck').classList.remove('checked');
  document.getElementById('acNeedsToggle').classList.remove('checked');
  document.getElementById('acNeedsDetail').classList.remove('show');
  document.getElementById('modalAgeBadge').style.display = 'none';
  document.querySelectorAll('.mf-err').forEach(function(e){e.classList.remove('show')});
  document.querySelectorAll('.mf-input,.cap-input').forEach(function(i){i.classList.remove('err','ok')});
}

function closeAddChildModal(){
  document.getElementById('addChildModal').classList.remove('show');
  document.body.style.overflow = '';
}

function handleModalClick(e){
  if(e.target === document.getElementById('addChildModal')) closeAddChildModal();
}

/* ── Age ── */
function checkModalAge(el){
  var age   = parseInt(el.value);
  var badge = document.getElementById('modalAgeBadge');
  if(!el.value){ badge.style.display='none'; return; }
  badge.style.display = 'block';
  if(age < 6){
    badge.textContent='صغير جداً';badge.className='age-inline-badge aib-danger';
    mShowErr('ac_age',true,'العمر يجب أن يكون 6 سنوات فأكثر');
  } else if(age > 18){
    badge.textContent='فوق 18 ❌';badge.className='age-inline-badge aib-danger';
    mShowErr('ac_age',true,'لا يمكن تسجيل من هم فوق 18 سنة');
  } else {
    badge.textContent=age+' سنة ✓';badge.className='age-inline-badge aib-ok';
    mShowErr('ac_age',false);
    el.classList.remove('err'); el.classList.add('ok');
  }
}

/* ── Needs ── */
function toggleAcNeeds(el){
  acNeedsChecked = el.checked;
  document.getElementById('acNeedsToggle').classList.toggle('checked', acNeedsChecked);
  document.getElementById('acNeedsDetail').classList.toggle('show', acNeedsChecked);
}

/* ── Terms ── */
function toggleAcTerms(el){
  acTermsChecked = el.checked;
  document.getElementById('acTermsCheck').classList.toggle('checked', acTermsChecked);
  mShowErr('terms', !acTermsChecked && acTermsChecked !== false ? false : false);
}

/* ── CAPTCHA ── */
function genModalCaptcha(){
  var n1 = Math.floor(Math.random()*9)+1;
  var n2 = Math.floor(Math.random()*9)+1;
  var op = Math.random() > .5 ? '+' : '-';
  if(op==='-' && n2>n1){var t=n1;n1=n2;n2=t;}
  acCaptchaAnswer = op==='+' ? n1+n2 : n1-n2;
  document.getElementById('mcapN1').textContent = n1;
  document.getElementById('mcapOp').textContent = op;
  document.getElementById('mcapN2').textContent = n2;
  document.getElementById('mcapAnswer').value = '';
  document.getElementById('mcapAnswer').className = 'cap-input';
  mShowErr('captcha', false);
}

function checkModalCap(el){
  var val = parseInt(el.value);
  var ok  = val === acCaptchaAnswer;
  el.classList.toggle('ok',  ok);
  el.classList.toggle('err', !ok && el.value.length > 0);
  mShowErr('captcha', !ok && el.value.length > 0);
}

/* ── Helpers ── */
function mShowErr(field, show, msg){
  var el = document.getElementById('merr_' + field);
  if(!el) return;
  el.classList.toggle('show', show);
  if(msg && field === 'ac_age'){
    var sp = document.getElementById('mAgeMsg');
    if(sp) sp.textContent = msg;
  }
  var input = document.getElementById('ac_' + field) || document.getElementById(field === 'captcha' ? 'mcapAnswer' : null);
  if(input) input.classList.toggle('err', show);
}

/* ── Submit ── */
function submitAddChild(e){
  e.preventDefault();
  var ok = true;

  var fname = document.getElementById('ac_fname').value.trim();
  var lname = document.getElementById('ac_lname').value.trim();
  var age   = parseInt(document.getElementById('ac_age').value);
  var cap   = parseInt(document.getElementById('mcapAnswer').value);

  if(!fname){ mShowErr('ac_fname',true); ok=false; }
  else { mShowErr('ac_fname',false); document.getElementById('ac_fname').classList.add('ok'); }

  if(!lname){ mShowErr('ac_lname',true); ok=false; }
  else { mShowErr('ac_lname',false); document.getElementById('ac_lname').classList.add('ok'); }

  if(!age || age < 6){
    mShowErr('ac_age',true,'العمر يجب أن يكون 6 سنوات فأكثر'); ok=false;
  } else if(age > 18){
    mShowErr('ac_age',true,'لا يمكن تسجيل من هم فوق 18 سنة'); ok=false;
  } else {
    mShowErr('ac_age',false);
  }

  var capOk = cap === acCaptchaAnswer;
  document.getElementById('mcapAnswer').classList.toggle('err', !capOk);
  document.getElementById('mcapAnswer').classList.toggle('ok',  capOk);
  mShowErr('captcha', !capOk);
  if(!capOk) ok=false;

  if(!acTermsChecked){ mShowErr('terms',true); ok=false; }
  else mShowErr('terms',false);

  if(!ok) return;

  var btn = document.getElementById('acSubmitBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري الإضافة...';

  var pid = '';
  try { var u = JSON.parse(sessionStorage.getItem('makam_user')||'{}'); pid = u.id||''; } catch(e){}

  if(!pid){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
    showToast('يجب تسجيل الدخول أولاً', 'orange');
    return;
  }

  var disease = '';
  if(acNeedsChecked){
    disease = (document.getElementById('ac_disease')||{}).value || '';
    disease = disease.trim();
  }

  fetch('/api/auth_add_child', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ parent_id: pid, fname: fname, lname: lname, age: age, disease: disease }),
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
    if(!res.ok){
      showToast(res.error || 'حدث خطأ، حاول مجدداً', 'orange');
      return;
    }
    var child = res.data;

    /* عرض شاشة النجاح */
    document.getElementById('modalFormWrap').style.display = 'none';
    document.getElementById('modalFooter').style.display = 'none';
    var sc = document.getElementById('modalSuccess');
    sc.classList.add('show');

    var det = document.getElementById('mSuccessDetails');
    det.innerHTML =
      msRow('الاسم', fname + ' ' + lname) +
      msRow('العمر', age + ' سنة') +
      msRow('اسم المستخدم', child.username) +
      msRow('كلمة السر', child.password) +
      msRow('الاحتياجات الخاصة', acNeedsChecked ? '✓ نعم' : 'لا');

    /* إضافة الطفل في الواجهة */
    addChildToUI(fname, lname, age);

    /* تحديث الداشبورد */
    if(typeof loadDashboard === 'function') loadDashboard();

    setTimeout(closeAddChildModal, 4000);
  })
  .catch(function(){
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
    showToast('تعذّر الاتصال بالخادم، حاول مجدداً', 'orange');
  });
}

function msRow(k,v){
  return '<div class="ms-row"><span>'+k+'</span><span>'+v+'</span></div>';
}

/* ── Dynamic child add to tabs ── */
var dynamicChildCount = 0;
function addChildToUI(fname, lname, age){
  dynamicChildCount++;
  var colors = ['#7C3AED','#2563EB','#E07824','#C1392B'];
  var color  = colors[dynamicChildCount % colors.length];
  var init   = fname.charAt(0);

  var tabsEl  = document.getElementById('childTabs');
  var mainEl  = document.getElementById('childPanelsWrap');
  if(!tabsEl || !mainEl) return;

  var idx = document.querySelectorAll('.child-tab:not(.child-tab-add)').length;

  /* Tab */
  var tab = document.createElement('div');
  tab.className = 'child-tab';
  tab.setAttribute('onclick','switchChild('+idx+')');
  tab.innerHTML = '<span style="width:8px;height:8px;border-radius:50%;background:'+color+';display:inline-block"></span> '+fname;
  tabsEl.insertBefore(tab, document.querySelector('.child-tab-add'));

  /* Panel */
  var panel = document.createElement('div');
  panel.className = 'child-panel';
  panel.id = 'childPanel'+idx;
  panel.innerHTML = newChildPanelHTML(fname, lname, age, color, init);
  mainEl.appendChild(panel);

  switchChild(idx);
  showToast('تم إضافة '+fname+' بنجاح! 🎉','green');
}

function newChildPanelHTML(fname, lname, age, color, init){
  return '<div class="child-hero-card" style="animation:fadeUp .4s ease">'
    +'<div class="chc-header" style="background:linear-gradient(135deg,'+color+','+color+'99)">'
    +'<div class="chc-avatar" style="background:rgba(255,255,255,.2)">'+init+'</div>'
    +'<div class="chc-info"><div class="chc-name">'+fname+' '+lname+'</div>'
    +'<div class="chc-meta">'+age+' سنوات • مستوى: مبتدئ</div></div>'
    +'<div class="chc-badge new-badge"><i class="bi bi-stars"></i> جديد</div></div>'
    +'<div class="chc-body"><div class="chc-prog-wrap">'
    +'<div class="chc-prog-label"><span>التقدم الإجمالي</span><span class="chc-pct">0%</span></div>'
    +'<div class="chc-prog-bar"><div class="chc-prog-fill" style="width:0%;background:'+color+'"></div></div>'
    +'<div class="chc-tasks">تم إكمال 0 من 48 مهمة</div></div>'
    +'<div class="chc-subj-empty"><i class="bi bi-hourglass" style="font-size:2rem;opacity:.25;display:block;margin-bottom:.5rem"></i>'
    +'ستظهر الوحدات التعليمية بعد أول دخول للطفل</div></div></div>';
}

/* ════════════════════════════════════════
   REQUESTS
════════════════════════════════════════ */
function approveRequest(btn, name){
  var card = btn.closest('.req-item');
  card.style.transition='all .3s ease';card.style.opacity='0';card.style.transform='translateX(16px)';
  setTimeout(function(){
    card.remove(); updateReqBadge(-1);
    showToast('تمت الموافقة على طلب '+name+' ✓','green');
    checkEmptyReqs();
  }, 300);
}

function rejectRequest(btn, name){
  var card = btn.closest('.req-item');
  card.style.transition='all .3s ease';card.style.opacity='0';card.style.transform='translateX(-16px)';
  setTimeout(function(){
    card.remove(); updateReqBadge(-1);
    showToast('تم رفض طلب '+name,'red');
    checkEmptyReqs();
  }, 300);
}

function updateReqBadge(delta){
  ['reqBadge','sbBadge'].forEach(function(id){
    var el = document.getElementById(id);
    if(el){ var n=parseInt(el.textContent||'0')+delta; el.textContent=Math.max(0,n); if(n<=0)el.style.display='none'; }
  });
  var dtb = document.querySelector('.dib-badge');
  if(dtb){ var n=parseInt(dtb.textContent||'0')+delta; dtb.textContent=Math.max(0,n); if(n<=0)dtb.style.display='none'; }
}

function checkEmptyReqs(){
  var list = document.getElementById('reqList');
  if(list && list.children.length === 0){
    list.innerHTML='<div class="req-empty"><i class="bi bi-check-circle-fill"></i><br>لا توجد طلبات جديدة</div>';
  }
}

/* ── Toast ── */
function showToast(msg, type){
  var old=document.getElementById('dToast');if(old)old.remove();
  var t=document.createElement('div');t.id='dToast';
  var bg=type==='green'?'var(--green)':type==='red'?'var(--red)':'var(--orange)';
  t.style.cssText='position:fixed;bottom:1.8rem;left:50%;transform:translateX(-50%);'
    +'background:'+bg+';color:#fff;font-family:var(--font);font-weight:800;font-size:.87rem;'
    +'padding:.72rem 1.6rem;border-radius:50px;box-shadow:0 8px 28px rgba(0,0,0,.18);'
    +'z-index:9999;animation:toastIn .32s ease;max-width:90vw;text-align:center;direction:rtl;white-space:nowrap';
  t.textContent=msg;
  document.body.appendChild(t);
  setTimeout(function(){t.style.opacity='0';t.style.transition='opacity .3s';setTimeout(function(){t.remove();},300);},3000);
}

/* ── Progress bars ── */
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('[data-prog]').forEach(function(el){
    setTimeout(function(){el.style.width=el.dataset.prog;},300);
  });
});
</script>

</body>
</html>
