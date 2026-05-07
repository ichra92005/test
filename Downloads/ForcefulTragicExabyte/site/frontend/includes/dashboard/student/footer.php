  </div><!-- /dash-content -->
</div><!-- /dash-main -->

<script>
/* ════════════════════════════════════════════════════
   STUDENT DASHBOARD — AUTH GUARD + DYNAMIC DATA LOAD
════════════════════════════════════════════════════ */

var _stu = null; /* بيانات الطالب المحلية */

/* ── تهيئة بيانات الطالب من sessionStorage ── */
function stuInit(){
  var raw = sessionStorage.getItem('makam_user');
  if(!raw){ window.location.href='/login'; return; }

  try { _stu = JSON.parse(raw); } catch(e){ window.location.href='/login'; return; }

  if(!_stu || _stu.type !== 'child'){
    window.location.href = '/login';
    return;
  }

  /* تحقق من قاعدة البيانات في الخلفية */
  fetch('/api/auth_student?id=' + encodeURIComponent(_stu.id))
    .then(function(r){ return r.json(); })
    .then(function(res){
      if(res.ok && res.data){
        /* تحديث sessionStorage بأحدث البيانات */
        _stu.fname  = res.data.fname;
        _stu.lname  = res.data.lname;
        _stu.age    = res.data.age;
        _stu.username = res.data.username;
        sessionStorage.setItem('makam_user', JSON.stringify(_stu));
      }
      stuRender();
    })
    .catch(function(){ stuRender(); }); /* إذا فشل الـ API، نعرض sessionStorage */
}

/* ── رسم بيانات الطالب على الصفحة ── */
function stuRender(){
  if(!_stu) return;

  var fname    = _stu.fname    || '';
  var lname    = _stu.lname    || '';
  var fullname = (fname + ' ' + lname).trim();
  var init     = fname.charAt(0) || '؟';
  var xp       = _stu.xp       || 0;
  var streak   = _stu.streak   || 0;
  var xpPct    = Math.min(100, Math.round(xp / 500 * 100));

  /* ── Sidebar ── */
  _upd('sbAvatar',    init);
  _upd('sbName',      fullname);
  _upd('sbXpVal',     '⚡ ' + xp);
  _upd('sbStreakTxt', streak + ' أيام متتالية');
  var sbFill = document.getElementById('sbXpFill');
  if(sbFill) sbFill.style.width = xpPct + '%';

  /* ── Topbar ── */
  _upd('dtBreadcrumbName', fname);
  _upd('dtChipName',       fname);
  _upd('dtXpVal',          xp);
  _upd('dtStreakNum',       streak);
  var dtFill = document.getElementById('dtXpFill');
  if(dtFill) dtFill.style.width = xpPct + '%';

  /* ── Hero ── */
  var hg = document.getElementById('heroGreeting');
  if(hg){
    hg.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.7)"><path d="M12 3a9 9 0 100 18A9 9 0 0012 3zm-1 13H9V8h2v8zm4 0h-2V8h2v8z"/></svg> مرحباً بك يا ' + fname + '!';
  }

  /* ── XP ring widget ── */
  _upd('xpBigVal',   xp + ' XP');
  _upd('xpBigName',  fullname);
  _upd('xpLvlRem',   (500 - xp) + ' XP');
  var lvlFill = document.getElementById('xpLvlFill');
  if(lvlFill){ lvlFill.setAttribute('data-prog', xpPct+'%'); }
  var ringTrack = document.getElementById('xpRingTrack');
  if(ringTrack){
    var circ = parseFloat(ringTrack.getAttribute('stroke-dasharray') || 364.42);
    ringTrack.setAttribute('data-ring-target', circ - (xpPct/100)*circ);
  }

  /* ── Streak widget ── */
  _upd('streakBigNum', streak);
  _upd('streakChip',   streak + ' يوم!');
}

function _upd(id, val){
  var el = document.getElementById(id);
  if(el) el.textContent = val;
}

/* ════ Kid-friendly toast ════ */
function showKidToast(msg){
  var old = document.getElementById('_kt');
  if(old) old.remove();
  var t = document.createElement('div');
  t.id = '_kt';
  t.style.cssText =
    'position:fixed;bottom:90px;left:50%;transform:translateX(-50%) translateY(14px);'
    +'background:linear-gradient(135deg,#006233,#0A7A3C);color:#fff;'
    +'font-family:var(--font);font-size:.92rem;font-weight:900;'
    +'padding:.7rem 1.6rem;border-radius:50px;z-index:9999;'
    +'box-shadow:0 8px 28px rgba(0,98,51,.35);'
    +'animation:toastUp .3s ease forwards;white-space:nowrap;'
    +'border:2px solid rgba(232,184,48,.3)';
  t.innerHTML = '<span style="margin-left:.4rem">' + msg + '</span>';
  document.body.appendChild(t);
  setTimeout(function(){
    t.style.opacity = '0';
    t.style.transform = 'translateX(-50%) translateY(8px)';
    t.style.transition = 'all .3s ease';
    setTimeout(function(){ if(t.parentNode) t.remove(); }, 300);
  }, 2800);
}

/* ════ Scroll helper ════ */
function scrollTo2(id){
  var el = document.getElementById(id);
  if(el){
    var top = el.getBoundingClientRect().top + window.pageYOffset - 80;
    window.scrollTo({top:top, behavior:'smooth'});
  }
}
function scrollToSection(id){ scrollTo2(id); }

/* ════ Animate progress bars ════ */
function animateProgressBars(){
  document.querySelectorAll('[data-prog]').forEach(function(el){
    var target = el.getAttribute('data-prog');
    el.style.width = '0';
    setTimeout(function(){ el.style.width = target; }, 120);
  });
}

/* ════ Animate XP ring ════ */
function animateRings(){
  document.querySelectorAll('[data-ring-target]').forEach(function(el){
    var target = el.getAttribute('data-ring-target');
    var start  = parseFloat(el.getAttribute('stroke-dasharray') || 364.42);
    el.style.strokeDashoffset = start;
    setTimeout(function(){ el.style.strokeDashoffset = target; }, 200);
  });
}

/* ════ Counter animation ════ */
function animateCounters(){
  document.querySelectorAll('[data-count]').forEach(function(el){
    var target = parseInt(el.getAttribute('data-count'));
    if(isNaN(target) || target === 0) return;
    var dur=1200, step=target/60, cur=0;
    var iv = setInterval(function(){
      cur = Math.min(cur+step, target);
      el.textContent = Math.floor(cur);
      if(cur >= target) clearInterval(iv);
    }, dur/60);
  });
}

/* ════ INIT ════ */
document.addEventListener('DOMContentLoaded', function(){
  stuInit();
  setTimeout(function(){
    animateProgressBars();
    animateRings();
    animateCounters();
  }, 300);
});

/* ════ Patch stuRender to also fire a custom event ════ */
var _origStuRender = stuRender;
stuRender = function(){
  _origStuRender();
  if(_stu){
    document.dispatchEvent(new CustomEvent('_stuRendered', { detail: _stu }));
  }
};
</script>
</body>
</html>
