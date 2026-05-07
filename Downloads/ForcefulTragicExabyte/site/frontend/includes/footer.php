<?php if (!defined('MAKAM_SITE_NAME')) require_once __DIR__ . '/../config/config.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- ══════ FOOTER ══════ -->
<footer class="footer">
  <div class="footer-wave">
    <svg viewBox="0 0 1440 80" preserveAspectRatio="none" height="55" style="display:block;width:100%">
      <path d="M0,40 C240,80 480,0 720,40 C960,80 1200,0 1440,40 L1440,80 L0,80 Z" fill="#0f2010"/>
    </svg>
  </div>
  <div class="footer-body">
    <div class="footer-grid">

      <!-- Brand -->
      <div>
        <a href="/" class="f-logo">
          <img src="/site/frontend/logo/logo-no.png" alt="مقام" width="40" height="40" style="border-radius:50%;object-fit:cover;border:2px solid rgba(255,215,0,.3)">
          <span><?= MAKAM_SITE_NAME_EN ?></span>
        </a>
        <p class="f-brand-desc"><?= htmlspecialchars(MAKAM_TAGLINE) ?> — منصة تعليمية جزائرية تجمع بين المتعة والتعلم، مصممة خصيصاً للأطفال  مع إشراف كامل لأولياء الأمور.</p>
        <div class="f-social">
          <a href="<?= MAKAM_FACEBOOK ?>" aria-label="فيسبوك" target="_blank" rel="noopener">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="<?= MAKAM_INSTAGRAM ?>" aria-label="إنستغرام" target="_blank" rel="noopener">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="<?= MAKAM_YOUTUBE ?>" aria-label="يوتيوب" target="_blank" rel="noopener">
            <i class="bi bi-youtube"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="f-col">
        <h5>روابط سريعة</h5>
        <ul>
          <li><a href="/"><i class="bi bi-house-fill"></i> الرئيسية</a></li>
          <li><a href="#maqam"><i class="bi bi-building-fill"></i> مقام الشهيد</a></li>
          <li><a href="#how"><i class="bi bi-rocket-fill"></i> كيف تعمل</a></li>
          <li><a href="/register"><i class="bi bi-person-plus-fill"></i> إنشاء حساب</a></li>
          <li><a href="/login"><i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول</a></li>
        </ul>
      </div>

      <!-- Subjects -->
      <div class="f-col">
        <h5>المواد الدراسية</h5>
        <ul>
          <li><a href="#"><i class="bi bi-calculator-fill"></i> الرياضيات</a>
        </ul>
      </div>

      <!-- Contact -->
      <div class="f-col">
        <h5>تواصل معنا</h5>
        <ul>
          <li><a href="mailto:<?= MAKAM_EMAIL ?>"><i class="bi bi-envelope-fill"></i> <?= MAKAM_EMAIL ?></a></li>
          <li><a href="tel:<?= MAKAM_PHONE ?>"><i class="bi bi-telephone-fill"></i> <?= MAKAM_PHONE ?></a></li>
          <li><a href="#"><i class="bi bi-geo-alt-fill"></i> الجزائر العاصمة، الجزائر</a></li>
          <li><a href="#"><i class="bi bi-clock-fill"></i> 8ص — 8م (من الأحد للخميس)</a></li>
        </ul>
      </div>

    </div><!-- /footer-grid -->

    <!-- Bottom bar -->
    <div class="f-bottom">
      <p>© <?= MAKAM_YEAR ?> <strong><?= MAKAM_SITE_NAME_EN ?> — مقـــــام</strong>. جميع الحقوق محفوظة</p>
      <div class="f-badges">
        <span class="f-badge-pill"><i class="bi bi-shield-fill-check"></i> آمن وموثوق</span>
        <span class="f-badge-pill"><i class="bi bi-check-circle-fill"></i> منهج جزائري</span>
        <span class="f-badge-pill"><i class="bi bi-flag-fill"></i> صُنع في الجزائر</span>
        <span class="f-badge-pill"><i class="bi bi-heart-fill"></i> للأطفال</span>
      </div>
    </div>

  </div><!-- /footer-body -->
</footer>

<style>
/* ══════════════════════════════════════
   FOOTER — MAKAM
══════════════════════════════════════ */
.footer{background:#0f2010;color:rgba(255,255,255,.75);font-family:var(--font,'Cairo','Tajawal',sans-serif)}
.footer-wave{line-height:0}
.footer-wave svg{display:block;width:100%}
.footer-body{padding:3.5rem 1.5rem 2rem;max-width:1340px;margin:0 auto}
.footer-grid{display:grid;grid-template-columns:2.2fr 1fr 1fr 1.2fr;gap:3rem;margin-bottom:3rem}

/* Logo */
.f-logo{display:flex;align-items:center;gap:.7rem;font-size:1.5rem;font-weight:900;color:#fff;margin-bottom:1rem;text-decoration:none}
.f-logo:hover{opacity:.85}
.f-brand-desc{font-size:.88rem;line-height:1.85;color:rgba(255,255,255,.48);margin-bottom:1.5rem;max-width:320px}

/* Social */
.f-social{display:flex;gap:.75rem}
.f-social a{width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.08);color:rgba(255,255,255,.6);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;border:1.5px solid rgba(255,255,255,.1)}
.f-social a i{font-size:1.1rem}
.f-social a:hover{background:#E07824;color:#fff;border-color:#E07824;transform:translateY(-3px);box-shadow:0 6px 20px rgba(224,120,36,.35)}

/* Columns */
.f-col h5{font-size:.95rem;font-weight:900;color:#fff;margin-bottom:1.1rem;padding-bottom:.6rem;border-bottom:2px solid rgba(255,255,255,.08)}
.f-col ul{list-style:none;padding:0;margin:0}
.f-col li{margin-bottom:.6rem;font-size:.88rem}
.f-col a{color:rgba(255,255,255,.52);text-decoration:none;transition:color .2s;display:flex;align-items:center;gap:.5rem}
.f-col a i{font-size:.95rem;opacity:.65;transition:opacity .2s}
.f-col a:hover{color:#FFD700}
.f-col a:hover i{opacity:1}

/* Bottom */
.f-bottom{border-top:1px solid rgba(255,255,255,.08);padding-top:1.8rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;font-size:.83rem;color:rgba(255,255,255,.38)}
.f-bottom strong{color:#FFD700}
.f-badges{display:flex;gap:.6rem;flex-wrap:wrap}
.f-badge-pill{background:rgba(255,255,255,.07);border-radius:50px;padding:.3rem .85rem;font-size:.75rem;color:rgba(255,255,255,.5);border:1px solid rgba(255,255,255,.1);display:inline-flex;align-items:center;gap:.35rem;transition:all .2s}
.f-badge-pill:hover{background:rgba(255,215,0,.12);border-color:rgba(255,215,0,.3);color:rgba(255,215,0,.8)}
.f-badge-pill i{font-size:.85rem;color:#FFD700}

/* Responsive */
@media(max-width:1100px){.footer-grid{grid-template-columns:1fr 1fr;gap:2.5rem}}
@media(max-width:560px){.footer-grid{grid-template-columns:1fr;gap:2rem}.f-bottom{flex-direction:column;text-align:center}}
</style>

<script>
(function(){
  /* ── Navbar scroll ── */
  var nav=document.getElementById('navbar');
  var ham=document.getElementById('hamburger');
  var links=document.getElementById('navLinks');
  if(nav) window.addEventListener('scroll',function(){nav.classList.toggle('scrolled',window.scrollY>60);},{passive:true});
  if(ham&&links){
    ham.addEventListener('click',function(){links.classList.toggle('open');ham.classList.toggle('open');});
    document.addEventListener('click',function(e){if(!ham.contains(e.target)&&!links.contains(e.target)){links.classList.remove('open');ham.classList.remove('open');}});
  }

  /* ── Smooth scroll ── */
  document.querySelectorAll('a[href^="#"]').forEach(function(a){
    a.addEventListener('click',function(e){
      var t=document.querySelector(a.getAttribute('href'));
      if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth',block:'start'});if(links)links.classList.remove('open');}
    });
  });

  /* ── Scroll reveal ── */
  var obs=new IntersectionObserver(function(entries){entries.forEach(function(en){if(en.isIntersecting)en.target.classList.add('visible');});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});
  document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(function(el){obs.observe(el);});

  /* ── Count-up (Western numerals) ── */
  function animateCounter(el){
    var target=parseInt(el.dataset.count)||0;
    var suffix=el.dataset.suffix||'';
    var dur=1800;
    var start=performance.now();
    (function step(now){
      var p=Math.min((now-start)/dur,1);
      var ease=1-Math.pow(1-p,3);
      el.textContent=Math.round(ease*target).toLocaleString('en-US')+suffix;
      if(p<1)requestAnimationFrame(step);
    })(start);
  }
  var cObs=new IntersectionObserver(function(entries){entries.forEach(function(en){if(en.isIntersecting&&!en.target.dataset.counted){en.target.dataset.counted='1';animateCounter(en.target);}});},{threshold:0.4});
  document.querySelectorAll('[data-count]').forEach(function(el){cObs.observe(el);});

  /* ── Stagger delays ── */
  document.querySelectorAll('.feat-grid .feat-card').forEach(function(el,i){el.style.transitionDelay=(i*0.08)+'s';});
  document.querySelectorAll('.funfact-grid .ff-card').forEach(function(el,i){el.style.transitionDelay=(i*0.1)+'s';});
  document.querySelectorAll('.testi-grid .testi-card').forEach(function(el,i){el.style.transitionDelay=(i*0.12)+'s';});
})();
</script>
</body>
</html>
