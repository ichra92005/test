<?php
require_once __DIR__ . '/../../../site/frontend/config/config.php';
$dash_title  = 'الإحصائيات';
$dash_icon   = 'bar-chart-fill';
$dash_active = 'statistics';
require_once __DIR__ . '/../../../site/frontend/includes/dashboard/parent/header.php';
?>

<style>
/* ══════════════════════════════════════
   STATISTICS PAGE — STYLES
══════════════════════════════════════ */

/* Page Hero */
.page-hero{
  background:linear-gradient(135deg,var(--sidebar-bg) 0%,#1A2E20 50%,#243B2A 100%);
  border-radius:var(--r);padding:1.6rem 2rem;margin-bottom:1.6rem;
  position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.15);
  animation:fadeUp .4s ease;
}
.ph-decor{position:absolute;border-radius:50%;pointer-events:none}
.ph-decor-1{width:240px;height:240px;background:rgba(255,255,255,.025);top:-80px;left:-80px}
.ph-decor-2{width:150px;height:150px;background:rgba(232,184,48,.06);bottom:-50px;left:120px}
.ph-decor-3{width:80px;height:80px;background:rgba(45,122,69,.15);top:20px;left:60px;border-radius:14px;transform:rotate(20deg)}
.ph-inner{position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem}
.ph-label{font-size:.72rem;font-weight:800;color:rgba(255,255,255,.4);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.3rem;display:flex;align-items:center;gap:.4rem}
.ph-label i{color:var(--gold)}
.ph-title{font-size:1.6rem;font-weight:900;color:#fff;line-height:1.15;margin-bottom:.3rem}
.ph-title em{background:linear-gradient(135deg,var(--gold),#F59E0B);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-style:normal}
.ph-sub{font-size:.82rem;color:rgba(255,255,255,.45);font-weight:700}
.ph-right{display:flex;align-items:center;gap:.75rem;flex-shrink:0}
.ph-period-btn{
  display:flex;align-items:center;gap:.4rem;
  padding:.55rem 1.1rem;border-radius:var(--r-full);
  font-family:var(--font);font-size:.8rem;font-weight:900;
  cursor:pointer;border:none;transition:var(--tr);
}
.phb-active{background:var(--gold);color:#333;box-shadow:0 4px 16px rgba(232,184,48,.35)}
.phb-ghost{background:rgba(255,255,255,.08);color:rgba(255,255,255,.6);border:1.5px solid rgba(255,255,255,.12)}
.phb-ghost:hover{background:rgba(255,255,255,.14)}

/* KPI Cards */
.kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.6rem}
.kpi-card{
  background:var(--white);border-radius:var(--r);border:1.5px solid var(--gray-200);
  padding:1.2rem;box-shadow:var(--sh);position:relative;overflow:hidden;
  animation:fadeUp .45s ease;transition:var(--tr);
}
.kpi-card:hover{transform:translateY(-3px);box-shadow:var(--sh-md)}
.kpi-bg-glow{position:absolute;width:100px;height:100px;border-radius:50%;bottom:-30px;left:-20px;pointer-events:none;opacity:.06}
.kpi-icon-wrap{width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;margin-bottom:.9rem}
.kpi-val{font-size:2rem;font-weight:900;line-height:1;margin-bottom:.2rem}
.kpi-label{font-size:.75rem;font-weight:800;color:var(--gray-500);margin-bottom:.15rem}
.kpi-trend{display:inline-flex;align-items:center;gap:.25rem;font-size:.7rem;font-weight:800;padding:.15rem .5rem;border-radius:50px;margin-top:.4rem}
.kt-up{background:#E8F5EE;color:var(--green)}
.kt-down{background:var(--red-pale);color:var(--red)}
.kt-neu{background:var(--gold-pale);color:var(--gold2)}

/* Skeleton */
.skel{background:linear-gradient(90deg,var(--gray-100) 25%,var(--gray-50) 50%,var(--gray-100) 75%);background-size:200% 100%;animation:shimmer 1.4s infinite;border-radius:8px}
@keyframes shimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
.skel-kpi{height:130px}
.skel-text{height:14px;margin-bottom:6px}

/* Child selector */
.child-select-tabs{display:flex;align-items:center;gap:.6rem;margin-bottom:1.4rem;flex-wrap:wrap}
.cst-tab{
  display:flex;align-items:center;gap:.5rem;
  padding:.5rem 1.15rem;border-radius:var(--r-full);
  border:2px solid var(--gray-200);background:var(--white);
  cursor:pointer;font-size:.85rem;font-weight:800;
  color:var(--gray-500);transition:var(--tr);
}
.cst-tab:hover{border-color:var(--green);color:var(--green);background:var(--green-xpale)}
.cst-tab.active{background:var(--green);border-color:var(--green);color:#fff;box-shadow:var(--sh-green)}
.cst-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}

/* Layout */
.stats-layout{display:grid;grid-template-columns:1fr 320px;gap:1.4rem;align-items:start}
.stat-panel{display:none;animation:fadeUp .3s ease}
.stat-panel.active{display:contents}

/* Card base */
.s-card{
  background:var(--white);border-radius:var(--r);border:1.5px solid var(--gray-200);
  box-shadow:var(--sh);overflow:hidden;margin-bottom:1.2rem;animation:fadeUp .5s ease;
}
.s-card-head{display:flex;align-items:center;justify-content:space-between;padding:.95rem 1.2rem;border-bottom:1.5px solid var(--gray-100)}
.sch-title{font-size:.88rem;font-weight:900;color:var(--gray-700);display:flex;align-items:center;gap:.5rem}
.sch-badge{font-size:.67rem;font-weight:900;padding:.2rem .6rem;border-radius:var(--r-full)}
.schb-green{background:var(--green-pale);color:var(--green)}
.schb-gold{background:var(--gold-pale);color:var(--gold2)}
.schb-blue{background:#EFF6FF;color:#2563EB}
.schb-orange{background:var(--orange-pale);color:var(--orange2)}
.s-card-body{padding:1.2rem}

/* Bar chart */
.bar-chart-wrap{padding:0 1.2rem 1.2rem}
.bar-chart{display:flex;align-items:flex-end;gap:.5rem;height:140px;border-bottom:1.5px solid var(--gray-100);padding-bottom:.4rem}
.bar-col{flex:1;display:flex;flex-direction:column;align-items:center;gap:.3rem}
.bar-fill{
  width:100%;border-radius:6px 6px 0 0;min-height:4px;
  transition:height 1s ease;position:relative;cursor:pointer;
}
.bar-fill:hover::after{
  content:attr(data-val);
  position:absolute;top:-26px;left:50%;transform:translateX(-50%);
  background:var(--gray-800);color:#fff;
  font-size:.67rem;font-weight:900;padding:.18rem .45rem;border-radius:6px;white-space:nowrap;
}
.bar-fill:hover{opacity:.85}
.bar-label{font-size:.65rem;font-weight:800;color:var(--gray-400);white-space:nowrap}
.bar-chart-legend{display:flex;align-items:center;gap:1.2rem;padding:.7rem 0 0;font-size:.72rem;font-weight:800;color:var(--gray-500)}
.bcl-dot{width:10px;height:10px;border-radius:3px;flex-shrink:0}

/* Subject progress */
.subj-progress-list{display:flex;flex-direction:column;gap:.85rem}
.spl-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.4rem}
.spl-name{display:flex;align-items:center;gap:.5rem;font-size:.84rem;font-weight:800;color:var(--gray-700)}
.spl-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.75rem;color:#fff;flex-shrink:0}
.spl-pct{font-size:.78rem;font-weight:900;color:var(--gray-500)}
.spl-done{font-size:.7rem;color:var(--gray-400);font-weight:700}
.spl-bar{height:8px;border-radius:50px;background:var(--gray-100);overflow:hidden}
.spl-fill{height:100%;border-radius:50px;width:0;transition:width 1.2s ease}

/* Activity feed */
.mini-activity{display:flex;flex-direction:column;gap:0}
.ma-item{display:flex;align-items:flex-start;gap:.7rem;padding:.7rem 1.2rem;border-bottom:1px solid var(--gray-100)}
.ma-item:last-child{border-bottom:none}
.ma-dot{width:30px;height:30px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.8rem}
.ma-title{font-size:.8rem;font-weight:800;color:var(--gray-700);margin-bottom:.1rem}
.ma-time{font-size:.67rem;color:var(--gray-400);font-weight:700}

/* Right column */
.stats-right{display:flex;flex-direction:column;gap:1.2rem}

/* Progress Ring */
.ring-card{text-align:center;padding:1.4rem 1.2rem 1rem}
.ring-wrap{position:relative;display:inline-block;margin-bottom:.9rem}
.ring-svg{width:120px;height:120px;transform:rotate(-90deg)}
.ring-bg{fill:none;stroke:var(--gray-100);stroke-width:10}
.ring-fill{fill:none;stroke-width:10;stroke-linecap:round;transition:stroke-dashoffset 1.4s ease}
.ring-center{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}
.ring-pct{font-size:1.5rem;font-weight:900;color:var(--gray-800)}
.ring-pct-sub{font-size:.67rem;color:var(--gray-400);font-weight:700}
.ring-name{font-size:.92rem;font-weight:900;color:var(--gray-800);margin-bottom:.2rem}
.ring-level{font-size:.74rem;font-weight:700;color:var(--gray-400)}
.ring-stats-row{display:flex;justify-content:center;gap:1.2rem;margin-top:.8rem}
.rsr-item{text-align:center}
.rsr-val{font-size:1.05rem;font-weight:900;color:var(--gray-800)}
.rsr-lbl{font-size:.65rem;color:var(--gray-400);font-weight:700}

/* Time card */
.time-display{text-align:center;padding:1.2rem 1rem .6rem}
.td-clock{font-size:2.4rem;font-weight:900;color:var(--green);line-height:1}
.td-label{font-size:.76rem;font-weight:800;color:var(--gray-400);margin-top:.3rem}
.td-compare{display:flex;gap:.6rem;padding:.6rem 1.2rem 1rem}
.tdc-item{flex:1;background:var(--gray-50);border-radius:10px;padding:.7rem .8rem;border:1.5px solid var(--gray-200);text-align:center}
.tdc-val{font-size:1.1rem;font-weight:900;color:var(--gray-800);margin-bottom:.15rem}
.tdc-lbl{font-size:.67rem;font-weight:800;color:var(--gray-400)}

/* Streak calendar */
.streak-header{display:flex;align-items:center;gap:.6rem;padding:1rem 1.2rem .6rem}
.streak-fire{font-size:1.5rem}
.streak-num{font-size:2rem;font-weight:900;color:var(--orange)}
.streak-sub{font-size:.75rem;color:var(--gray-400);font-weight:700;line-height:1.4}
.streak-cal{display:grid;grid-template-columns:repeat(7,1fr);gap:4px;padding:.6rem 1.2rem 1.2rem}
.sc-cell{
  aspect-ratio:1;border-radius:5px;
  display:flex;align-items:center;justify-content:center;
  font-size:.6rem;font-weight:800;color:var(--gray-400);
  background:var(--gray-100);cursor:pointer;transition:var(--tr);
}
.sc-cell:hover{transform:scale(1.12)}
.sc-cell.done{background:var(--green);color:#fff}
.sc-cell.today{background:var(--gold);color:#333;box-shadow:0 2px 8px rgba(232,184,48,.4)}
.sc-cell.missed{background:var(--red-pale)}
.sc-legend{padding:0 1.2rem .9rem;font-size:.72rem;font-weight:700;color:var(--gray-400);display:flex;align-items:center;gap:.4rem;flex-wrap:wrap}

/* Badge showcase */
.badge-showcase{display:flex;flex-direction:column;gap:.65rem;padding:1rem 1.2rem}
.badge-item{display:flex;align-items:center;gap:.75rem;background:var(--gray-50);border-radius:10px;padding:.75rem .9rem;border:1.5px solid var(--gray-200)}
.badge-emoji{font-size:1.6rem;flex-shrink:0;line-height:1}
.badge-info{flex:1}
.badge-name{font-size:.85rem;font-weight:900;color:var(--gray-800);margin-bottom:.12rem}
.badge-desc{font-size:.72rem;color:var(--gray-400);font-weight:700}
.badge-locked{opacity:.38;filter:grayscale(1)}

/* Empty / Error states */
.stat-empty{
  text-align:center;padding:3rem 2rem;
  color:var(--gray-400);
}
.stat-empty i{font-size:3rem;display:block;margin-bottom:.75rem;opacity:.25}
.stat-empty strong{display:block;font-size:1rem;font-weight:900;color:var(--gray-600);margin-bottom:.35rem}
.stat-empty span{font-size:.83rem;font-weight:700;line-height:1.6}

/* Responsive */
@media(max-width:1100px){
  .kpi-grid{grid-template-columns:repeat(2,1fr)}
  .stats-layout{grid-template-columns:1fr}
  .stats-right{display:grid;grid-template-columns:repeat(2,1fr)}
}
@media(max-width:640px){
  .kpi-grid{grid-template-columns:repeat(2,1fr)}
  .ph-right{display:none}
  .stats-right{grid-template-columns:1fr}
}
</style>

<!-- ════ PAGE HERO ════ -->
<div class="page-hero">
  <div class="ph-decor ph-decor-1"></div>
  <div class="ph-decor ph-decor-2"></div>
  <div class="ph-decor ph-decor-3"></div>
  <div class="ph-inner">
    <div class="ph-left">
      <div class="ph-label"><i class="bi bi-bar-chart-fill"></i> مركز المتابعة</div>
      <div class="ph-title">إحصائيات <em>أطفالك</em></div>
      <div class="ph-sub" id="heroSub">جاري تحميل البيانات...</div>
    </div>
    <div class="ph-right">
      <button class="ph-period-btn phb-active"><i class="bi bi-calendar-week"></i> هذا الأسبوع</button>
      <button class="ph-period-btn phb-ghost" onclick="showToast('عرض الشهر قريباً!','green')"><i class="bi bi-calendar-month"></i> هذا الشهر</button>
    </div>
  </div>
</div>

<!-- ════ KPI CARDS ════ -->
<div class="kpi-grid" id="kpiGrid">
  <div class="kpi-card skel-kpi" style="animation-delay:.05s"></div>
  <div class="kpi-card skel-kpi" style="animation-delay:.1s"></div>
  <div class="kpi-card skel-kpi" style="animation-delay:.15s"></div>
  <div class="kpi-card skel-kpi" style="animation-delay:.2s"></div>
</div>

<!-- ════ CHILD TABS ════ -->
<div class="child-select-tabs" id="childSelectTabs">
  <div style="font-size:.8rem;font-weight:800;color:var(--gray-400);padding:.5rem .3rem">
    <i class="bi bi-hourglass-split"></i> جاري التحميل...
  </div>
</div>

<!-- ════ PANELS CONTAINER ════ -->
<div id="statPanelsWrap"></div>

<script>
/* ════════════════════════════════════════
   إعدادات ثابتة
════════════════════════════════════════ */
var DAYS_AR = ['الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت'];

var ALL_BADGES = [
  {emoji:'🌱', name:'المبتدئ',         desc:'أول خطوة في رحلة التعلم'},
  {emoji:'⭐', name:'النجم الصاعد',    desc:'أتممت ١٠ دروس بنجاح'},
  {emoji:'🏅', name:'المتعلم المثابر', desc:'أتممت ٢٠ درساً بامتياز'},
  {emoji:'🏆', name:'بطل الجزائر',     desc:'أتممت ٥٠ درساً — وصلت القمة!'},
];

var _statsData   = null;
var _currentIdx  = 0;

/* ════════════════════════════════════════
   تحميل البيانات
════════════════════════════════════════ */
function getParentId(){
  try { return JSON.parse(sessionStorage.getItem('makam_user')||'{}').id || ''; }
  catch(e){ return ''; }
}

function loadStats(){
  var pid = getParentId();
  if(!pid){
    showStatError('لم يتم تسجيل الدخول — يرجى <a href="/login" style="color:var(--green)">تسجيل الدخول</a> أولاً');
    return;
  }

  fetch('/api/auth_stats?parent_id=' + encodeURIComponent(pid))
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(!res.ok){
      showStatError('تعذّر تحميل البيانات: ' + (res.error||''));
      return;
    }
    _statsData = res.data;
    renderAll(_statsData);
  })
  .catch(function(){
    showStatError('تعذّر الاتصال بالخادم — تحقق من الاتصال');
  });
}

/* ════════════════════════════════════════
   رسم الكل
════════════════════════════════════════ */
function renderAll(data){
  var children = data.children || [];
  var totals   = data.totals   || {};

  /* Hero sub */
  document.getElementById('heroSub').textContent =
    children.length
      ? 'تابع تقدم ' + children.length + ' ' + (children.length===1?'طفل':'أطفال') + ' وراقب نشاطهم التعليمي'
      : 'لا يوجد أطفال مسجلون — أضف طفلك الأول من الصفحة الرئيسية';

  renderKPI(totals, children);
  renderChildTabs(children);
  renderPanels(children);

  /* تشغيل animation للـ panel الأول */
  setTimeout(function(){ animatePanel(0, children); }, 200);
}

/* ════════════════════════════════════════
   KPI Cards
════════════════════════════════════════ */
function renderKPI(totals, children){
  var maxStreak = totals.max_streak || 0;
  /* اسم أعلى streak */
  var streakChild = '';
  if(children.length){
    var top = children.reduce(function(a,b){ return (a.streak||0) > (b.streak||0) ? a : b; });
    streakChild = top.fname;
  }

  document.getElementById('kpiGrid').innerHTML =
    kpiCard('#E8F5EE','var(--green)','bi-check2-circle',totals.done_lessons||0,'دروس مكتملة','kt-up','bi-arrow-up-short','إجمالي جميع الأطفال','0.05') +
    kpiCard('#FFF9E6','var(--gold2)','bi-graph-up-arrow',(totals.avg_progress||0)+'%','متوسط التقدم الإجمالي','kt-up','bi-arrow-up-short','لكل الأطفال','0.1') +
    kpiCard('#FFF3E8','var(--orange)','bi-fire',maxStreak,'أعلى سلسلة أيام','kt-neu','bi-dash',(streakChild?streakChild+' · '+maxStreak+' يوم':'لا يوجد بعد'),'0.15') +
    kpiCard('#F3F0FF','var(--purple)','bi-trophy-fill',totals.total_badges||0,'شارات مكتسبة','kt-up','bi-arrow-up-short','إجمالي جميع الأطفال','0.2');
}

function kpiCard(bg, color, icon, val, label, trendCls, trendIcon, trendText, delay){
  return '<div class="kpi-card" style="animation-delay:'+delay+'s">' +
    '<div class="kpi-bg-glow" style="background:'+color+'"></div>' +
    '<div class="kpi-icon-wrap" style="background:'+bg+'">' +
      '<i class="bi '+icon+'" style="color:'+color+'"></i>' +
    '</div>' +
    '<div class="kpi-val" style="color:'+color+'">'+val+'</div>' +
    '<div class="kpi-label">'+label+'</div>' +
    '<div class="kpi-trend '+trendCls+'"><i class="bi '+trendIcon+'"></i> '+trendText+'</div>' +
  '</div>';
}

/* ════════════════════════════════════════
   Child Tabs
════════════════════════════════════════ */
function renderChildTabs(children){
  var el = document.getElementById('childSelectTabs');
  if(!children.length){
    el.innerHTML = '<div style="font-size:.82rem;color:var(--gray-400);font-weight:700;padding:.5rem"><i class="bi bi-people"></i> لا يوجد أطفال</div>';
    return;
  }
  var html = '<span style="font-size:.8rem;font-weight:800;color:var(--gray-400);padding:.5rem .3rem">عرض:</span>';
  children.forEach(function(c, i){
    var isOnline = c.status === 'online';
    html += '<div class="cst-tab '+(i===0?'active':'')+'" onclick="switchStatChild('+i+')">' +
      '<span class="cst-dot" style="background:'+(isOnline?'#22c55e':c.color)+'"></span>' +
      c.fname + ' ' + c.level_badge +
      (isOnline ? '<span style="font-size:.62rem;opacity:.7">● متصل</span>' : '') +
    '</div>';
  });
  el.innerHTML = html;
}

/* ════════════════════════════════════════
   رسم البانلات
════════════════════════════════════════ */
function renderPanels(children){
  var wrap = document.getElementById('statPanelsWrap');
  if(!children.length){
    wrap.innerHTML =
      '<div class="stat-empty">' +
        '<i class="bi bi-people"></i>' +
        '<strong>لا يوجد أطفال مسجلون</strong>' +
        '<span>أضف طفلك الأول من <a href="/dashboard/parent" style="color:var(--green);font-weight:900">الصفحة الرئيسية</a> لبدء متابعة تقدمه</span>' +
      '</div>';
    return;
  }

  var html = '';
  children.forEach(function(c, i){
    html += buildPanel(c, i);
  });
  wrap.innerHTML = html;
}

function buildPanel(c, i){
  var maxW = Math.max.apply(null, c.weekly_minutes) || 1;
  var totalWeek = c.weekly_minutes.reduce(function(a,b){return a+b;},0);
  var last3 = c.weekly_minutes.slice(-3).reduce(function(a,b){return a+b;},0);

  /* تنسيق الوقت */
  function fmtMin(m){
    m = m || 0;
    if(m <= 0) return '٠ دقيقة';
    if(m < 60) return m + ' دقيقة';
    var h = Math.floor(m/60), mn = m%60;
    return h + ' س' + (mn>0?' و'+mn+' د':'');
  }

  /* حساب SVG ring */
  var r = 50, cx = 60, cy = 60;
  var circ = Math.round(2 * Math.PI * r * 100) / 100;
  var off  = Math.round((circ - (c.progress_pct/100)*circ) * 100) / 100;

  /* ── bar chart HTML ── */
  var barsHtml = '';
  DAYS_AR.forEach(function(day, di){
    var val = c.weekly_minutes[di] || 0;
    var h   = Math.round((val / maxW) * 120);
    barsHtml +=
      '<div class="bar-col">' +
        '<div class="bar-fill" style="height:0;background:linear-gradient(180deg,'+c.color+','+c.color+'88)" ' +
          'data-target="'+h+'px" data-val="'+val+' دقيقة" title="'+day+': '+val+' دقيقة"></div>' +
        '<span class="bar-label">'+day.slice(0,3)+'</span>' +
      '</div>';
  });

  /* ── subjects HTML ── */
  var subjHtml = '';
  if(c.subjects && c.subjects.length){
    c.subjects.forEach(function(s){
      subjHtml +=
        '<div class="spl-item">' +
          '<div class="spl-top">' +
            '<div class="spl-name">' +
              '<div class="spl-icon" style="background:'+s.color+'"><i class="bi '+s.icon+'"></i></div>' +
              s.name +
            '</div>' +
            '<div>' +
              '<span class="spl-pct" style="color:'+s.color+'">'+s.pct+'%</span>' +
              '<span class="spl-done"> · '+s.done+'/'+s.total+'</span>' +
            '</div>' +
          '</div>' +
          '<div class="spl-bar">' +
            '<div class="spl-fill" data-prog="'+s.pct+'%" style="background:'+s.color+'"></div>' +
          '</div>' +
        '</div>';
    });
  } else {
    subjHtml = '<div style="text-align:center;padding:1.5rem;color:var(--gray-400);font-size:.83rem;font-weight:700"><i class="bi bi-book" style="font-size:1.5rem;display:block;opacity:.25;margin-bottom:.4rem"></i>لم يبدأ الدراسة بعد</div>';
  }

  /* ── activities HTML ── */
  var actHtml = '';
  if(c.activities && c.activities.length){
    c.activities.forEach(function(a){
      actHtml +=
        '<div class="ma-item">' +
          '<div class="ma-dot" style="background:'+a.bg+'"><i class="bi '+a.icon+'" style="color:'+a.ic+'"></i></div>' +
          '<div><div class="ma-title">'+a.title+'</div><div class="ma-time">'+a.time+'</div></div>' +
        '</div>';
    });
  } else {
    actHtml = '<div class="ma-item"><div style="color:var(--gray-400);font-size:.82rem;font-weight:700;padding:.5rem"><i class="bi bi-clock" style="opacity:.3"></i> لا توجد نشاطات بعد</div></div>';
  }

  /* ── streak calendar ── */
  var calHtml = '';
  var today = new Date();
  for(var d = 27; d >= 0; d--){
    var dt = new Date(today);
    dt.setDate(today.getDate() - d);
    var dtStr = dt.toISOString().slice(0,10);
    var isToday = (d === 0);
    var inStreak = (d < c.streak);
    var missed   = (!inStreak && d < c.streak + 3 && d >= c.streak);
    var cls = 'sc-cell';
    if(isToday)       cls += ' today';
    else if(inStreak) cls += ' done';
    else if(missed)   cls += ' missed';
    var label = isToday ? 'اليوم' : (d===1 ? 'أمس' : 'منذ '+d+' أيام');
    calHtml += '<div class="'+cls+'" title="'+label+'">'+( isToday ? '●' : '')+'</div>';
  }

  /* ── badges HTML ── */
  var badgesHtml = '';
  ALL_BADGES.forEach(function(b){
    var earned = c.badges && c.badges.indexOf(b.emoji) !== -1;
    badgesHtml +=
      '<div class="badge-item '+ (earned?'':'badge-locked') +'">' +
        '<div class="badge-emoji">'+b.emoji+'</div>' +
        '<div class="badge-info">' +
          '<div class="badge-name">'+b.name+'</div>' +
          '<div class="badge-desc">'+b.desc+'</div>' +
        '</div>' +
        (earned
          ? '<i class="bi bi-check-circle-fill" style="color:var(--green);font-size:.9rem"></i>'
          : '<i class="bi bi-lock-fill" style="color:var(--gray-300);font-size:.85rem"></i>') +
      '</div>';
  });

  return '<div class="stat-panel '+(i===0?'active':'')+'" id="statPanel'+i+'">' +
    '<div class="stats-layout">' +

      /* ══ عمود يسار ══ */
      '<div>' +

        /* النشاط الأسبوعي */
        '<div class="s-card">' +
          '<div class="s-card-head">' +
            '<div class="sch-title"><i class="bi bi-bar-chart-fill" style="color:var(--green)"></i> النشاط الأسبوعي</div>' +
            '<span class="sch-badge schb-green">آخر ٧ أيام</span>' +
          '</div>' +
          '<div class="bar-chart-wrap">' +
            '<div class="bar-chart" id="barChart'+i+'">'+barsHtml+'</div>' +
            '<div class="bar-chart-legend">' +
              '<span class="bcl-dot" style="background:'+c.color+'"></span>' +
              'دقائق التعلم اليومية — '+c.fname +
              '<span style="margin-right:auto;font-size:.7rem;color:var(--gray-400)">المجموع: '+totalWeek+' دقيقة</span>' +
            '</div>' +
          '</div>' +
        '</div>' +

        /* تقدم المواد */
        '<div class="s-card">' +
          '<div class="s-card-head">' +
            '<div class="sch-title"><i class="bi bi-grid-3x2-gap-fill" style="color:var(--purple)"></i> تقدم المواد</div>' +
            '<span class="sch-badge schb-blue">'+c.done_lessons+'/'+c.total_lessons+' درس</span>' +
          '</div>' +
          '<div class="s-card-body"><div class="subj-progress-list" id="subjList'+i+'">'+subjHtml+'</div></div>' +
        '</div>' +

        /* آخر النشاطات */
        '<div class="s-card">' +
          '<div class="s-card-head">' +
            '<div class="sch-title"><i class="bi bi-clock-history" style="color:var(--blue)"></i> آخر الأنشطة</div>' +
            '<span class="sch-badge schb-blue">هذا الأسبوع</span>' +
          '</div>' +
          '<div class="mini-activity">'+actHtml+'</div>' +
        '</div>' +

      '</div>' + /* /left */

      /* ══ عمود يمين ══ */
      '<div class="stats-right">' +

        /* Progress Ring */
        '<div class="s-card">' +
          '<div class="ring-card">' +
            '<div class="ring-wrap">' +
              '<svg class="ring-svg" viewBox="0 0 120 120">' +
                '<circle class="ring-bg" cx="'+cx+'" cy="'+cy+'" r="'+r+'"/>' +
                '<circle class="ring-fill" cx="'+cx+'" cy="'+cy+'" r="'+r+'"' +
                  ' stroke="'+c.color+'"' +
                  ' stroke-dasharray="'+circ+'"' +
                  ' stroke-dashoffset="'+circ+'"' +
                  ' data-target-offset="'+off+'"' +
                  ' id="ring'+i+'"/>' +
              '</svg>' +
              '<div class="ring-center">' +
                '<div class="ring-pct">'+c.progress_pct+'%</div>' +
                '<div class="ring-pct-sub">تقدم</div>' +
              '</div>' +
            '</div>' +
            '<div class="ring-name">'+c.fname+' '+c.lname+' '+c.level_badge+'</div>' +
            '<div class="ring-level">'+c.level+' · '+c.age+' سنوات</div>' +
            '<div class="ring-stats-row">' +
              '<div class="rsr-item"><div class="rsr-val" style="color:var(--green)">'+c.done_lessons+'</div><div class="rsr-lbl">مكتمل</div></div>' +
              '<div class="rsr-item"><div class="rsr-val" style="color:var(--gray-400)">'+(c.total_lessons-c.done_lessons)+'</div><div class="rsr-lbl">متبقي</div></div>' +
              '<div class="rsr-item"><div class="rsr-val" style="color:var(--orange)">'+c.streak+'</div><div class="rsr-lbl">يوم 🔥</div></div>' +
            '</div>' +
          '</div>' +
        '</div>' +

        /* وقت التعلم */
        '<div class="s-card">' +
          '<div class="s-card-head"><div class="sch-title"><i class="bi bi-stopwatch-fill" style="color:var(--orange)"></i> وقت التعلم</div></div>' +
          '<div class="time-display">' +
            '<div class="td-clock">'+ fmtMin(c.time_today_min) +'</div>' +
            '<div class="td-label">وقت التعلم اليوم</div>' +
          '</div>' +
          '<div class="td-compare">' +
            '<div class="tdc-item"><div class="tdc-val" style="color:var(--green)">'+last3+' د</div><div class="tdc-lbl">آخر ٣ أيام</div></div>' +
            '<div class="tdc-item"><div class="tdc-val" style="color:var(--gold2)">'+totalWeek+' د</div><div class="tdc-lbl">هذا الأسبوع</div></div>' +
          '</div>' +
        '</div>' +

        /* سلسلة الأيام */
        '<div class="s-card">' +
          '<div class="s-card-head">' +
            '<div class="sch-title"><i class="bi bi-fire" style="color:var(--orange)"></i> سلسلة الأيام</div>' +
            '<span class="sch-badge schb-orange">'+c.streak+' يوم 🔥</span>' +
          '</div>' +
          '<div class="streak-header">' +
            '<div class="streak-fire">🔥</div>' +
            '<div class="streak-num">'+c.streak+'</div>' +
            '<div class="streak-sub">يوم متواصل<br><span style="color:var(--green)">'+( c.streak>=7?'أداء رائع! 🌟':c.streak>=3?'استمر! 💪':'ابدأ سلسلتك! 🚀')+'</span></div>' +
          '</div>' +
          '<div class="streak-cal">'+calHtml+'</div>' +
          '<div class="sc-legend">' +
            '<span style="width:10px;height:10px;border-radius:3px;background:var(--green);display:inline-block"></span> نشط' +
            '<span style="width:10px;height:10px;border-radius:3px;background:var(--red-pale);display:inline-block;margin-right:.3rem"></span> فائت' +
            '<span style="width:10px;height:10px;border-radius:3px;background:var(--gold);display:inline-block;margin-right:.3rem"></span> اليوم' +
          '</div>' +
        '</div>' +

        /* الشارات */
        '<div class="s-card">' +
          '<div class="s-card-head">' +
            '<div class="sch-title"><i class="bi bi-trophy-fill" style="color:var(--gold2)"></i> الشارات</div>' +
            '<span class="sch-badge schb-gold">'+( c.badges ? c.badges.length : 0)+'/٤ مكتسبة</span>' +
          '</div>' +
          '<div class="badge-showcase">'+badgesHtml+'</div>' +
        '</div>' +

      '</div>' + /* /stats-right */
    '</div>' + /* /stats-layout */
  '</div>'; /* /stat-panel */
}

/* ════════════════════════════════════════
   التبديل بين الأطفال
════════════════════════════════════════ */
function switchStatChild(idx){
  _currentIdx = idx;
  document.querySelectorAll('.cst-tab').forEach(function(t,i){
    t.classList.toggle('active', i===idx);
  });
  document.querySelectorAll('.stat-panel').forEach(function(p,i){
    p.classList.toggle('active', i===idx);
  });
  setTimeout(function(){
    if(_statsData) animatePanel(idx, _statsData.children||[]);
  }, 50);
}

/* ════════════════════════════════════════
   Animations
════════════════════════════════════════ */
function animateBars(idx){
  var panel = document.getElementById('statPanel'+idx);
  if(!panel) return;
  panel.querySelectorAll('.bar-fill').forEach(function(bar){
    var target = bar.getAttribute('data-target');
    bar.style.height = '0px';
    setTimeout(function(){ bar.style.height = target; }, 80);
  });
}

function animateFills(idx){
  var panel = document.getElementById('statPanel'+idx);
  if(!panel) return;
  panel.querySelectorAll('.spl-fill').forEach(function(el){
    var pct = el.getAttribute('data-prog');
    el.style.width = '0';
    setTimeout(function(){ el.style.width = pct; }, 120);
  });
}

function animateRing(idx){
  var ring = document.getElementById('ring'+idx);
  if(!ring) return;
  var target = ring.getAttribute('data-target-offset');
  ring.style.strokeDashoffset = ring.getAttribute('stroke-dasharray');
  setTimeout(function(){ ring.style.strokeDashoffset = target; }, 150);
}

function animatePanel(idx, children){
  animateBars(idx);
  animateFills(idx);
  animateRing(idx);
}

/* ════════════════════════════════════════
   Error state
════════════════════════════════════════ */
function showStatError(msg){
  document.getElementById('heroSub').textContent = 'حدث خطأ في التحميل';
  document.getElementById('kpiGrid').innerHTML =
    '<div style="grid-column:1/-1;text-align:center;padding:2rem;color:var(--red);font-weight:700">' +
    '<i class="bi bi-exclamation-triangle-fill" style="font-size:1.5rem;display:block;margin-bottom:.4rem"></i>' + msg + '</div>';
  document.getElementById('childSelectTabs').innerHTML = '';
  document.getElementById('statPanelsWrap').innerHTML  = '';
}

/* ════════════════════════════════════════
   Toast (نفس الـ footer)
════════════════════════════════════════ */
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
    t.style.opacity='0';t.style.transform='translateX(-50%) translateY(8px)';t.style.transition='all .3s ease';
    setTimeout(function(){t.remove();},300);
  },2800);
}

/* ════════════════════════════════════════
   Init
════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function(){
  loadStats();
});
</script>

<?php require_once __DIR__ . '/../../../site/frontend/includes/dashboard/parent/footer.php'; ?>
