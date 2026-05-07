<?php
require_once __DIR__ . '/../site/frontend/config/config.php';
$page_title  = 'من نحن — منصة مقام التعليمية الجزائرية';
$page_desc   = 'تعرّف على منصة مكام التعليمية الجزائرية للأطفال — رسالتنا، رؤيتنا، وكيفية استخدام المنصة خطوة بخطوة';
$active_page = 'about';
$body_class  = 'page-about';
require_once __DIR__ . '/../site/frontend/includes/header.php';
?>

<style>
/* ══════════════════════════════════════
   MAKAM — ABOUT PAGE
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
:root{
  --green:#2D7A45;--green2:#3A9159;--green3:#46A866;
  --green-pale:#E8F5EE;--green-xpale:#F2FAF5;
  --orange:#E07824;--orange2:#C96B1A;--orange-pale:#FFF3E8;
  --gold:#E8B830;--gold2:#D4A520;--gold-pale:#FFF9E6;
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
body{font-family:var(--font);color:var(--gray-800);background:var(--white);overflow-x:hidden;direction:rtl}

/* ── Reveal animations ── */
.reveal{opacity:0;transform:translateY(28px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal.visible{opacity:1;transform:none}
.reveal-left{opacity:0;transform:translateX(36px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal-left.visible{opacity:1;transform:none}
.reveal-right{opacity:0;transform:translateX(-36px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal-right.visible{opacity:1;transform:none}

/* ── Buttons ── */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.55rem;padding:.85rem 2rem;border-radius:var(--r);font-family:var(--font);font-weight:800;font-size:1rem;text-decoration:none;transition:var(--tr);cursor:pointer;border:none;line-height:1}
.btn i{font-size:1.1rem}
.btn-orange{background:linear-gradient(135deg,var(--orange),var(--orange2));color:var(--white);box-shadow:0 4px 18px rgba(224,120,36,.3)}
.btn-orange:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.4)}
.btn-outline{background:var(--white);color:var(--green);border:2.5px solid var(--green)}
.btn-outline:hover{background:var(--green-pale);transform:translateY(-2px)}
.btn-white{background:var(--white);color:var(--green)}
.btn-white:hover{background:var(--green-pale);transform:translateY(-3px)}
.btn-lg{padding:1.05rem 2.6rem;font-size:1.08rem}

/* ── Layout ── */
.container{max-width:1340px;margin:0 auto;padding:0 1.5rem}
section{padding:5.5rem 0}

/* ── Section badges/titles ── */
.sec-badge{display:inline-flex;align-items:center;gap:.45rem;background:var(--green-pale);color:var(--green);font-weight:800;font-size:.88rem;padding:.4rem 1.1rem;border-radius:var(--r-full);margin-bottom:1rem;border:1.5px solid rgba(45,122,69,.2)}
.sec-badge i{font-size:1rem}
.sec-title{font-size:2.3rem;font-weight:900;color:var(--gray-800);line-height:1.2;margin-bottom:.85rem}
.sec-title em{color:var(--orange);font-style:normal;position:relative}
.sec-title em::after{content:'';position:absolute;bottom:-3px;left:0;right:0;height:4px;background:var(--gold);border-radius:3px;opacity:.5}
.sec-sub{color:var(--gray-500);font-size:1.05rem;line-height:1.8;max-width:620px}
.text-center{text-align:center}.text-center .sec-sub{margin:0 auto}

/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
.about-hero{
  min-height:78vh;
  background:linear-gradient(145deg,#FFF8F0 0%,#FFFCF5 40%,#F0FAF4 75%,#E8F5EE 100%);
  padding-top:7rem;position:relative;overflow:hidden;
  display:flex;align-items:center;
}
.hero-blob{position:absolute;border-radius:50%;pointer-events:none;filter:blur(60px);opacity:.16}
.hb-1{width:480px;height:480px;background:var(--orange);top:-150px;right:-120px;animation:blobFloat 9s ease-in-out infinite}
.hb-2{width:360px;height:360px;background:var(--gold);bottom:-100px;left:-80px;animation:blobFloat 11s ease-in-out 2s infinite}
.hb-3{width:220px;height:220px;background:var(--green);top:40%;right:38%;animation:blobFloat 7s ease-in-out 1s infinite}
@keyframes blobFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-18px) scale(1.04)}}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes maqFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
@keyframes twinkle{0%,100%{opacity:.1;transform:scale(1)}50%{opacity:.5;transform:scale(1.4)}}

.stars-deco{position:absolute;inset:0;pointer-events:none;overflow:hidden}
.star-deco{position:absolute;color:var(--gold);animation:twinkle 2.8s ease-in-out infinite;opacity:.2;font-size:1.2rem}

.hero-inner{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;position:relative;z-index:2}

/* Hero content */
.hero-flag-tag{display:inline-flex;align-items:center;gap:.6rem;background:linear-gradient(135deg,rgba(224,120,36,.11),rgba(232,184,48,.11));border:1.5px solid rgba(224,120,36,.28);color:var(--orange2);font-weight:800;font-size:.9rem;padding:.5rem 1.3rem;border-radius:var(--r-full);margin-bottom:1.6rem;animation:slideDown .6s ease}
@keyframes slideDown{from{opacity:0;transform:translateY(-14px)}to{opacity:1;transform:none}}
.hero-h1{font-size:2.8rem;font-weight:900;line-height:1.15;color:var(--gray-800);margin-bottom:1.3rem}
.word-brand{display:block;font-size:3.4rem;background:linear-gradient(135deg,var(--green),var(--green3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.word-brand::after{content:'';display:block;height:5px;background:linear-gradient(to left,var(--gold),var(--orange));border-radius:3px;margin-top:4px;width:60%;opacity:.7}
.hero-desc{font-size:1.08rem;color:var(--gray-600);line-height:1.9;margin-bottom:2rem;max-width:500px}
.hero-actions{display:flex;gap:1rem;flex-wrap:wrap}

/* Hero visual */
.hero-visual{display:flex;justify-content:center;align-items:center;position:relative}
.about-visual-card{background:var(--white);border-radius:28px;padding:2.5rem 2rem;box-shadow:0 24px 70px rgba(224,120,36,.14),0 4px 20px rgba(45,122,69,.07);width:100%;max-width:380px;border:2px solid rgba(232,184,48,.2);position:relative;z-index:2}
.avc-header{display:flex;align-items:center;gap:.8rem;margin-bottom:1.8rem;padding-bottom:1rem;border-bottom:2px dashed rgba(232,184,48,.3)}
.avc-logo{width:52px;height:52px;border-radius:50%;overflow:hidden;border:2px solid rgba(45,122,69,.2);flex-shrink:0}
.avc-logo img{width:100%;height:100%;object-fit:cover}
.avc-title{font-size:1.15rem;font-weight:900;color:var(--gray-800)}
.avc-sub{font-size:.78rem;color:var(--gray-400);font-weight:600}
.avc-stats{display:grid;grid-template-columns:1fr 1fr;gap:.9rem;margin-bottom:1.6rem}
.avc-stat{background:var(--green-xpale);border-radius:14px;padding:1rem;text-align:center;border:1.5px solid rgba(45,122,69,.1)}
.avc-stat-num{font-size:1.5rem;font-weight:900;color:var(--green);display:block}
.avc-stat-lbl{font-size:.72rem;color:var(--gray-400);font-weight:700}
.avc-badges{display:flex;gap:.5rem;flex-wrap:wrap}
.avc-badge{display:inline-flex;align-items:center;gap:.35rem;background:var(--orange-pale);color:var(--orange2);font-size:.75rem;font-weight:800;padding:.28rem .75rem;border-radius:50px;border:1px solid rgba(224,120,36,.2)}
.avc-badge i{font-size:.85rem}

/* Floating badges */
.hero-badge-float{position:absolute;background:var(--white);border-radius:14px;padding:.65rem .95rem;box-shadow:0 8px 28px rgba(0,0,0,.11);display:flex;align-items:center;gap:.5rem;font-weight:800;font-size:.82rem;z-index:3;border:1.5px solid rgba(232,184,48,.2);white-space:nowrap}
.hero-badge-float i{font-size:1.05rem}
.hbf-1{top:-20px;left:-30px;color:var(--orange2);animation:floatY 3s ease-in-out infinite}
.hbf-2{bottom:20px;left:-38px;color:var(--green);animation:floatY 3.5s ease-in-out .7s infinite}

/* ══════════════════════════════════════
   VALUES STRIP
══════════════════════════════════════ */
.values-strip{background:linear-gradient(135deg,var(--green),var(--green2));padding:1.1rem 0;overflow:hidden}
.values-track{display:flex;animation:marquee 28s linear infinite;white-space:nowrap;align-items:center}
@keyframes marquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.values-item{display:inline-flex;align-items:center;gap:.6rem;color:rgba(255,255,255,.92);font-weight:700;font-size:.92rem;padding:0 2.5rem;flex-shrink:0}
.values-item i{font-size:1rem;color:var(--gold)}
.values-dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.4);flex-shrink:0}

/* ══════════════════════════════════════
   WHAT IS MAKAM
══════════════════════════════════════ */
.what-sec{background:var(--white);position:relative;overflow:hidden}
.what-inner{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center}
.what-img-wrap{position:relative;display:flex;justify-content:center;align-items:center}
.what-logo-big{width:260px;height:260px;border-radius:50%;overflow:hidden;border:4px solid rgba(45,122,69,.15);box-shadow:0 24px 60px rgba(45,122,69,.18),0 4px 20px rgba(232,184,48,.1);animation:maqFloat 6s ease-in-out infinite;position:relative;z-index:2;background:var(--green-xpale)}
.what-logo-big img{width:100%;height:100%;object-fit:cover}
.what-glow{position:absolute;width:340px;height:340px;border-radius:50%;background:radial-gradient(circle,rgba(45,122,69,.12) 0%,transparent 70%);pointer-events:none}
.what-ring{position:absolute;width:310px;height:310px;border-radius:50%;border:2px dashed rgba(232,184,48,.35);animation:spin 20s linear infinite;pointer-events:none}
.what-spark{position:absolute;border-radius:50%;animation:twinkle 2.5s ease-in-out infinite}

.what-list{display:flex;flex-direction:column;gap:1.1rem;margin-top:2rem}
.what-item{display:flex;align-items:flex-start;gap:1rem;background:var(--white);border-radius:16px;padding:1.1rem 1.3rem;border:1.5px solid rgba(232,184,48,.15);box-shadow:0 3px 16px rgba(45,122,69,.05);transition:var(--tr)}
.what-item:hover{transform:translateX(-4px);box-shadow:0 8px 28px rgba(45,122,69,.1);border-color:rgba(45,122,69,.2)}
.what-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.what-icon i{font-size:1.3rem}
.wi-green{background:linear-gradient(135deg,#E8F5EE,#C8E6D4)}.wi-green i{color:var(--green)}
.wi-orange{background:linear-gradient(135deg,#FFF3E8,#FFE0C5)}.wi-orange i{color:var(--orange)}
.wi-gold{background:linear-gradient(135deg,#FFF9E6,#FFE8A0)}.wi-gold i{color:var(--gold2)}
.wi-red{background:linear-gradient(135deg,#FDECEA,#FBD0CB)}.wi-red i{color:var(--red)}
.what-body{}
.what-label{font-size:.8rem;font-weight:700;color:var(--gray-400);margin-bottom:.15rem;text-transform:uppercase;letter-spacing:.04em}
.what-val{font-size:.98rem;font-weight:800;color:var(--gray-800);line-height:1.5}

/* ══════════════════════════════════════
   HOW TO USE — TABS
══════════════════════════════════════ */
.how-sec{background:linear-gradient(180deg,var(--warm-bg),var(--cream));position:relative;overflow:hidden}
.how-sec::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:radial-gradient(ellipse 70% 50% at 50% 0%,rgba(232,184,48,.06) 0%,transparent 70%);pointer-events:none}

/* Tab switcher */
.tab-switch-wrap{display:flex;justify-content:center;margin-bottom:3rem}
.tab-switch{display:flex;background:var(--white);border-radius:var(--r-full);padding:6px;box-shadow:var(--sh-warm);border:1.5px solid rgba(224,120,36,.12);gap:4px}
.tab-btn{display:flex;align-items:center;gap:.5rem;padding:.6rem 1.8rem;border-radius:var(--r-full);font-family:var(--font);font-size:.92rem;font-weight:800;cursor:pointer;border:none;background:none;color:var(--gray-500);transition:var(--tr)}
.tab-btn i{font-size:1.05rem}
.tab-btn.active{background:linear-gradient(135deg,var(--orange),var(--orange2));color:var(--white);box-shadow:0 4px 16px rgba(224,120,36,.3)}

/* Tab panels */
.tab-panel{display:none}
.tab-panel.active{display:block}

/* Steps grid */
.steps-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;position:relative}
.step-card{background:var(--white);border-radius:22px;padding:2rem 1.8rem;box-shadow:var(--sh-warm);border:1.5px solid rgba(232,184,48,.15);transition:var(--tr);position:relative;overflow:hidden}
.step-card::before{content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:0 22px 0 80px;opacity:.06}
.step-card:hover{transform:translateY(-5px);box-shadow:0 18px 48px rgba(224,120,36,.14)}
.sc-1::before{background:var(--green)}
.sc-2::before{background:var(--orange)}
.sc-3::before{background:var(--gold)}
.sc-4::before{background:var(--red)}
.sc-5::before{background:var(--green)}
.sc-6::before{background:var(--orange)}

.step-num{position:absolute;top:1.2rem;left:1.2rem;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.82rem;font-weight:900;color:var(--white)}
.sn-green{background:var(--green)}.sn-orange{background:var(--orange)}.sn-gold{background:var(--gold2)}.sn-red{background:var(--red)}

.step-icon-wrap{width:68px;height:68px;border-radius:18px;display:flex;align-items:center;justify-content:center;margin-bottom:1.2rem;transition:var(--tr)}
.step-card:hover .step-icon-wrap{transform:scale(1.1) rotate(-5deg)}
.step-icon-wrap i{font-size:2rem;line-height:1}
.si-green{background:linear-gradient(135deg,#E8F5EE,#C8E6D4)}.si-green i{color:var(--green)}
.si-orange{background:linear-gradient(135deg,#FFF3E8,#FFE0C5)}.si-orange i{color:var(--orange)}
.si-gold{background:linear-gradient(135deg,#FFF9E6,#FFE8A0)}.si-gold i{color:var(--gold2)}
.si-red{background:linear-gradient(135deg,#FDECEA,#FBD0CB)}.si-red i{color:var(--red)}
.si-purple{background:linear-gradient(135deg,#EDE7F6,#D9C9F5)}.si-purple i{color:#7B1FA2}
.si-blue{background:linear-gradient(135deg,#E3F2FD,#BBDEFB)}.si-blue i{color:#1565C0}

.step-title{font-size:1.05rem;font-weight:900;color:var(--gray-800);margin-bottom:.5rem}
.step-desc{font-size:.88rem;color:var(--gray-500);line-height:1.75}
.step-tip{display:inline-flex;align-items:center;gap:.35rem;background:var(--orange-pale);color:var(--orange2);font-size:.78rem;font-weight:800;padding:.25rem .8rem;border-radius:50px;margin-top:.9rem;border:1px solid rgba(224,120,36,.18)}
.step-tip i{font-size:.8rem}

/* ══════════════════════════════════════
   FEATURES (dark green bg — like index)
══════════════════════════════════════ */
.feat-sec{background:linear-gradient(150deg,#1A5C30 0%,var(--green) 50%,#1E6635 100%);color:var(--white);position:relative;overflow:hidden}
.feat-sec::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='40' cy='40' r='20'/%3E%3C/g%3E%3C/svg%3E");pointer-events:none}
.feat-sec .sec-badge{background:rgba(255,255,255,.14);color:var(--white);border-color:rgba(255,255,255,.2)}
.feat-sec .sec-badge i{color:var(--gold)}
.feat-sec .sec-title{color:var(--white)}
.feat-sec .sec-title em{color:var(--gold)}
.feat-sec .sec-title em::after{background:var(--gold);opacity:.45}
.feat-sec .sec-sub{color:rgba(255,255,255,.75)}
.feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.feat-card{background:rgba(255,255,255,.09);border:1.5px solid rgba(255,255,255,.18);border-radius:22px;padding:2rem;backdrop-filter:blur(8px);transition:var(--tr)}
.feat-card:hover{background:rgba(255,255,255,.17);transform:translateY(-6px);box-shadow:0 16px 40px rgba(0,0,0,.14)}
.feat-icon-wrap{width:68px;height:68px;border-radius:18px;background:rgba(255,255,255,.14);display:flex;align-items:center;justify-content:center;margin-bottom:1.2rem;transition:var(--tr)}
.feat-card:hover .feat-icon-wrap{transform:scale(1.1) rotate(-5deg);background:rgba(255,255,255,.22)}
.feat-icon-wrap i{font-size:2rem;color:var(--gold)}
.feat-title{font-size:1.05rem;font-weight:900;margin-bottom:.5rem}
.feat-desc{font-size:.9rem;opacity:.82;line-height:1.7}
.feat-check{display:flex;align-items:center;gap:.5rem;margin-top:1rem;font-size:.82rem;opacity:.75;font-weight:700}
.feat-check i{color:var(--gold);font-size:.95rem;flex-shrink:0}

/* ══════════════════════════════════════
   STATS
══════════════════════════════════════ */
.stats-sec{background:var(--white);border-top:3px solid var(--gold-pale);border-bottom:3px solid var(--gold-pale);padding:0}
.stats-inner{display:grid;grid-template-columns:repeat(4,1fr);gap:0}
.stat-box{padding:2.8rem 1.5rem;text-align:center;border-left:2px solid rgba(232,184,48,.18);position:relative;overflow:hidden;transition:var(--tr)}
.stat-box:last-child{border-left:none}
.stat-box::after{content:'';position:absolute;bottom:0;left:0;right:0;height:4px;transform:scaleX(0);transition:var(--tr);transform-origin:right}
.stat-box:nth-child(1)::after{background:var(--green)}
.stat-box:nth-child(2)::after{background:var(--orange)}
.stat-box:nth-child(3)::after{background:var(--gold)}
.stat-box:nth-child(4)::after{background:var(--red)}
.stat-box:hover::after{transform:scaleX(1)}
.stat-box:hover{background:var(--warm-bg)}
.stat-icon{font-size:2.6rem;display:block;margin-bottom:.6rem;line-height:1}
.stat-box:nth-child(1) .stat-icon{color:var(--green)}
.stat-box:nth-child(2) .stat-icon{color:var(--orange)}
.stat-box:nth-child(3) .stat-icon{color:var(--gold2)}
.stat-box:nth-child(4) .stat-icon{color:var(--red)}
.stat-num{font-size:2.7rem;font-weight:900;display:block;line-height:1;margin-bottom:.3rem;background:linear-gradient(135deg,var(--orange),var(--red));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.stat-lbl{font-size:.9rem;font-weight:700;color:var(--gray-500)}

/* ══════════════════════════════════════
   VALUES / STORY
══════════════════════════════════════ */
.story-sec{background:linear-gradient(180deg,var(--green-xpale),var(--warm-bg))}
.story-inner{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center}
.story-quote{background:linear-gradient(135deg,var(--green),var(--green2));border-radius:22px;padding:2rem 2.2rem;color:var(--white);position:relative;overflow:hidden;margin-bottom:2rem}
.story-quote::before{content:'"';position:absolute;top:-24px;right:18px;font-size:9rem;opacity:.08;font-family:Georgia,serif;line-height:1;color:#fff}
.story-quote p{font-size:1.05rem;line-height:1.85;font-weight:600;position:relative;z-index:1}
.story-quote span{display:block;margin-top:.8rem;font-size:.82rem;opacity:.7;font-weight:700}
.story-quote i{color:var(--gold)}
.values-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.val-card{background:var(--white);border-radius:16px;padding:1.2rem;display:flex;align-items:flex-start;gap:.9rem;border:1.5px solid rgba(232,184,48,.15);box-shadow:0 3px 14px rgba(45,122,69,.05);transition:var(--tr)}
.val-card:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(45,122,69,.1);border-color:rgba(45,122,69,.2)}
.val-icon{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.val-icon i{font-size:1.2rem}
.val-name{font-size:.88rem;font-weight:900;color:var(--gray-800);margin-bottom:.15rem}
.val-desc{font-size:.78rem;color:var(--gray-500);line-height:1.5}

/* Story visual */
.story-visual{position:relative;display:flex;justify-content:center;align-items:center}
.story-img-card{background:var(--white);border-radius:28px;padding:2rem;box-shadow:0 24px 60px rgba(45,122,69,.14);border:2px solid rgba(232,184,48,.2);width:100%;max-width:380px}
.sic-header{display:flex;align-items:center;gap:.7rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:2px dashed rgba(232,184,48,.28)}
.sic-avatar{width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--green),var(--green2));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sic-avatar i{font-size:1.6rem;color:#fff}
.sic-name{font-weight:900;font-size:1rem;color:var(--gray-800)}
.sic-role{font-size:.75rem;color:var(--gray-400);font-weight:600}
.sic-timeline{display:flex;flex-direction:column;gap:.85rem}
.sic-event{display:flex;align-items:flex-start;gap:.8rem}
.sic-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;margin-top:5px}
.sic-dot-g{background:var(--green)}.sic-dot-o{background:var(--orange)}.sic-dot-r{background:var(--red)}.sic-dot-gold{background:var(--gold2)}
.sic-event-body{}
.sic-event-title{font-size:.88rem;font-weight:800;color:var(--gray-800)}
.sic-event-year{font-size:.75rem;color:var(--gray-400);font-weight:700}

/* ══════════════════════════════════════
   CTA
══════════════════════════════════════ */
.cta-sec{background:linear-gradient(135deg,var(--orange) 0%,var(--orange2) 50%,#B85A10 100%);position:relative;overflow:hidden}
.cta-sec::before{content:'';position:absolute;top:-50%;right:-10%;width:600px;height:600px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none}
.cta-sec::after{content:'';position:absolute;bottom:-40%;left:-5%;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none}
.cta-inner{text-align:center;position:relative;z-index:1;padding:1rem 0}
.cta-icon{font-size:3.5rem;display:block;margin-bottom:1rem;animation:floatY 3s ease-in-out infinite}
.cta-title{font-size:2.4rem;font-weight:900;color:var(--white);margin-bottom:1rem;line-height:1.2}
.cta-title em{color:var(--gold);font-style:normal}
.cta-desc{font-size:1.05rem;color:rgba(255,255,255,.88);line-height:1.8;margin-bottom:2.5rem;max-width:560px;margin-left:auto;margin-right:auto}
.cta-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-bottom:2rem}
.cta-trust{display:flex;align-items:center;justify-content:center;gap:2rem;flex-wrap:wrap}
.trust-item{display:flex;align-items:center;gap:.45rem;color:rgba(255,255,255,.75);font-size:.88rem;font-weight:700}
.trust-item i{color:var(--gold);font-size:1rem}

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media(max-width:1100px){
  .feat-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:900px){
  .hero-inner{grid-template-columns:1fr;gap:2.5rem}
  .hero-visual{order:-1}
  .hero-h1{font-size:2.2rem}
  .word-brand{font-size:2.6rem}
  .what-inner,.story-inner{grid-template-columns:1fr;gap:2.5rem}
  .what-img-wrap{order:-1}
  .steps-grid{grid-template-columns:1fr}
  .stats-inner{grid-template-columns:repeat(2,1fr)}
  .stat-box{border-bottom:2px solid rgba(232,184,48,.12)}
  .stat-box:nth-child(odd){border-left:none}
  section{padding:4rem 0}
}
@media(max-width:768px){
  .values-grid{grid-template-columns:1fr}
}
@media(max-width:560px){
  .hero-h1{font-size:1.9rem}
  .word-brand{font-size:2.2rem}
  .sec-title{font-size:1.8rem}
  .feat-grid{grid-template-columns:1fr}
  .cta-title{font-size:1.8rem}
  .hero-badge-float{display:none}
  .tab-btn span{display:none}
}
</style>

<!-- ══════ HERO ══════ -->
<section class="about-hero">
  <div class="hero-blob hb-1"></div>
  <div class="hero-blob hb-2"></div>
  <div class="hero-blob hb-3"></div>
  <div class="stars-deco">
    <i class="bi bi-star-fill star-deco" style="top:12%;right:8%;animation-delay:.3s"></i>
    <i class="bi bi-star-fill star-deco" style="top:22%;left:6%;font-size:.8rem;animation-delay:1.1s"></i>
    <i class="bi bi-star-fill star-deco" style="bottom:30%;right:5%;font-size:.9rem;animation-delay:.7s"></i>
    <i class="bi bi-star-fill star-deco" style="bottom:18%;left:12%;font-size:1rem;animation-delay:1.8s"></i>
  </div>
  <div class="container">
    <div class="hero-inner">

      <!-- Content -->
      <div>
        <div class="hero-flag-tag reveal">
          <i class="bi bi-flag-fill"></i> منصة جزائرية أصيلة
        </div>
        <h1 class="hero-h1 reveal">
          تعرّف على
          <span class="word-brand"><?= MAKAM_SITE_NAME_EN ?></span>
          مقــــام !
        </h1>
        <p class="hero-desc reveal">
          منصة تعليمية جزائرية رائدة، مصممة خصيصاً للأطفال 
          نجمع بين المتعة والتعلم الأصيل عبر محتوى يعكس الهوية الجزائرية،
          مع إشراف كامل ولأولياء الأمور ونظام متابعة لحظي.
        </p>
        <div class="hero-actions reveal">
          <a href="/register" class="btn btn-orange btn-lg">
            <i class="bi bi-lightning-fill"></i> ابدأ مجاناً الآن
          </a>
          <a href="#how" class="btn btn-outline btn-lg">
            <i class="bi bi-play-circle-fill"></i> كيفية الاستخدام
          </a>
        </div>
      </div>

      <!-- Visual -->
      <div class="hero-visual reveal-left">
        <div class="hero-badge-float hbf-1">
          <i class="bi bi-award-fill" style="color:var(--gold)"></i> منصة جزائرية №1
        </div>
        <div class="hero-badge-float hbf-2">
          <i class="bi bi-shield-fill-check" style="color:var(--green)"></i> آمن ومحمي
        </div>
        <div class="about-visual-card">
          <div class="avc-header">
            <div class="avc-logo">
              <img src="/site/frontend/logo/logo-no.png" alt="مقام">
            </div>
            <div>
              <div class="avc-title">منصة MAQAM</div>
              <div class="avc-sub">التعليم الجزائري التفاعلي</div>
            </div>
          </div>
          <div class="avc-stats">
            <div class="avc-stat">
              <span class="avc-stat-num">+5,000</span>
              <span class="avc-stat-lbl">طالب نشط</span>
            </div>
            <div class="avc-stat">
              <span class="avc-stat-num">6</span>
              <span class="avc-stat-lbl">مواد أساسية</span>
            </div>
            <div class="avc-stat">
              <span class="avc-stat-num">+200</span>
              <span class="avc-stat-lbl">درس تفاعلي</span>
            </div>
            <div class="avc-stat">
              <span class="avc-stat-num">+50</span>
              <span class="avc-stat-lbl">ولاية</span>
            </div>
          </div>
          <div class="avc-badges">
            <span class="avc-badge"><i class="bi bi-check-circle-fill"></i> منهج وطني</span>
            <span class="avc-badge"><i class="bi bi-star-fill"></i> نظام شارات</span>
            <span class="avc-badge"><i class="bi bi-people-fill"></i> متابعة الأهل</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ VALUES STRIP ══════ -->
<div class="values-strip">
  <div class="values-track">
    <?php
    $vals = [
      ['bi-mortarboard-fill','التعلم بمتعة'],
      ['bi-flag-fill','هوية جزائرية'],
      ['bi-shield-fill-check','بيئة آمنة'],
      ['bi-people-fill','إشراف الأهل'],
      ['bi-trophy-fill','نظام المكافآت'],
      ['bi-book-fill','منهج وطني'],
      ['bi-heart-fill','محبة الوطن'],
      ['bi-star-fill','التميّز الأكاديمي'],
      ['bi-mortarboard-fill','التعلم بمتعة'],
      ['bi-flag-fill','هوية جزائرية'],
      ['bi-shield-fill-check','بيئة آمنة'],
      ['bi-people-fill','إشراف الأهل'],
      ['bi-trophy-fill','نظام المكافآت'],
      ['bi-book-fill','منهج وطني'],
      ['bi-heart-fill','محبة الوطن'],
      ['bi-star-fill','التميّز الأكاديمي'],
    ];
    foreach($vals as $v):?>
      <span class="values-item"><i class="bi <?= $v[0] ?>"></i> <?= $v[1] ?></span>
      <span class="values-dot"></span>
    <?php endforeach;?>
  </div>
</div>

<!-- ══════ WHAT IS MAKAM ══════ -->
<section class="what-sec" id="what">
  <div class="container">
    <div class="what-inner">

      <!-- Visual -->
      <div class="what-img-wrap reveal-right">
        <div class="what-glow"></div>
        <div class="what-ring"></div>
        <div class="what-logo-big">
          <img src="/site/frontend/logo/logo-no.png" alt="شعار مقام">
        </div>
        <!-- Sparkles -->
        <div class="what-spark" style="top:8%;right:15%;width:10px;height:10px;background:var(--gold);opacity:.7;animation-delay:.3s"></div>
        <div class="what-spark" style="top:20%;left:12%;width:7px;height:7px;background:var(--red);opacity:.6;animation-delay:.8s"></div>
        <div class="what-spark" style="bottom:18%;right:12%;width:8px;height:8px;background:var(--orange);opacity:.65;animation-delay:1.2s"></div>
        <div class="what-spark" style="bottom:12%;left:16%;width:6px;height:6px;background:var(--green);opacity:.5;animation-delay:.5s"></div>
      </div>

      <!-- Content -->
      <div class="reveal-left">
        <span class="sec-badge"><i class="bi bi-info-circle-fill"></i> ما هي مقــــام؟</span>
        <h2 class="sec-title">منصة تعليمية <em>جزائرية</em> للجيل القادم</h2>
        <p class="sec-sub">مقــــام هي أول منصة تعليمية تفاعلية جزائرية مصممة خصيصاً لأطفالنا، تجمع بين المناهج الوطنية الرسمية والأسلوب التعليمي التحفيزي.</p>

        <div class="what-list">
          <div class="what-item">
            <div class="what-icon wi-green"><i class="bi bi-flag-fill"></i></div>
            <div class="what-body">
              <div class="what-label">الهوية</div>
              <div class="what-val">محتوى تعليمي يعكس التاريخ والثقافة والهوية الجزائرية بشكل صحيح وعميق</div>
            </div>
          </div>
          <div class="what-item">
            <div class="what-icon wi-orange"><i class="bi bi-controller"></i></div>
            <div class="what-body">
              <div class="what-label">الأسلوب</div>
              <div class="what-val">تعلّم تفاعلي يشبه اللعبة — تحديات، نقاط، شارات وترتيب لإبقاء الطفل متحمساً</div>
            </div>
          </div>
          <div class="what-item">
            <div class="what-icon wi-gold"><i class="bi bi-book-fill"></i></div>
            <div class="what-body">
              <div class="what-label">المنهج</div>
              <div class="what-val"> التاريخ الجــزائري الأصيــــــــل و الرياضيــات
              </div>
            </div>
          </div>
          <div class="what-item">
            <div class="what-icon wi-red"><i class="bi bi-people-fill"></i></div>
            <div class="what-body">
              <div class="what-label">المتابعة</div>
              <div class="what-val">لوحة تحكم كاملة لولي الأمر — تابع تقدم طفلك لحظة بلحظة وراقب نقاطه وشاراته</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ HOW TO USE ══════ -->
<section class="how-sec" id="how">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-map-fill"></i> دليل الاستخدام</span>
      <h2 class="sec-title reveal">كيف تستخدم <em>مقــــام</em>؟</h2>
      <p class="sec-sub reveal">خطوات بسيطة وسريعة للبدء — اختر دليلك المناسب</p>
    </div>

    <div class="tab-switch-wrap reveal">
      <div class="tab-switch">
        <button class="tab-btn active" id="tabParent" onclick="switchTab('parent')">
          <i class="bi bi-people-fill"></i>
          <span>دليل ولي الأمر</span>
        </button>
        <button class="tab-btn" id="tabKid" onclick="switchTab('kid')">
          <i class="bi bi-emoji-smile-fill"></i>
          <span>دليل الطفل</span>
        </button>
      </div>
    </div>

    <!-- Parent steps -->
    <div class="tab-panel active" id="panelParent">
      <div class="steps-grid">

        <div class="step-card sc-1 reveal">
          <div class="step-num sn-green">1</div>
          <div class="step-icon-wrap si-green"><i class="bi bi-person-plus-fill"></i></div>
          <div class="step-title">إنشاء حساب ولي الأمر</div>
          <div class="step-desc">انتقل إلى صفحة التسجيل وأدخل اسمك، بريدك الإلكتروني، رقم هاتفك وكلمة المرور. العملية تستغرق أقل من دقيقتين.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> الحساب مجاني تماماً بدون بطاقة بنكية</span>
        </div>

        <div class="step-card sc-2 reveal">
          <div class="step-num sn-orange">2</div>
          <div class="step-icon-wrap si-orange"><i class="bi bi-person-heart"></i></div>
          <div class="step-title">إضافة ملف طفلك</div>
          <div class="step-desc">بعد التسجيل، أنشئ ملفاً لطفلك: اسمه، سنّه، مستواه الدراسي. يمكنك إضافة أكثر من طفل من نفس الحساب.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> لكل طفل لوحة متابعة مستقلة</span>
        </div>

        <div class="step-card sc-3 reveal">
          <div class="step-num sn-gold">3</div>
          <div class="step-icon-wrap si-gold"><i class="bi bi-book-fill"></i></div>
          <div class="step-title">اختيار المواد الدراسية</div>
          <div class="step-desc">حدّد المواد التي تريد أن يتعلمها طفلك من بين 2 مواد متاحة. يمكنك تفعيل أو تعطيل أي مادة في أي وقت.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> المنهج مطابق لمناهج التربية الوطنية</span>
        </div>

        <div class="step-card sc-4 reveal">
          <div class="step-num sn-red">4</div>
          <div class="step-icon-wrap si-red"><i class="bi bi-graph-up-arrow"></i></div>
          <div class="step-title">متابعة التقدم والإنجازات</div>
          <div class="step-desc">من لوحة التحكم، اطّلع يومياً على الدروس التي أتمّها طفلك، نقاطه المكتسبة، شاراته وترتيبه مقارنة بأقرانه.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> تنبيهات فورية عند كل إنجاز جديد</span>
        </div>

        <div class="step-card sc-5 reveal">
          <div class="step-num sn-green">5</div>
          <div class="step-icon-wrap si-purple"><i class="bi bi-bell-fill"></i></div>
          <div class="step-title">ضبط التنبيهات والجدول</div>
          <div class="step-desc">حدّد أوقات الدراسة المفضلة لطفلك واستقبل تذكيرات وتقارير أسبوعية عبر البريد الإلكتروني.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> أنت من يتحكم في وتيرة التعلم</span>
        </div>

        <div class="step-card sc-6 reveal">
          <div class="step-num sn-orange">6</div>
          <div class="step-icon-wrap si-blue"><i class="bi bi-chat-heart-fill"></i></div>
          <div class="step-title">التشجيع والتحفيز</div>
          <div class="step-desc">شارك طفلك في الاحتفال بإنجازاته وشجّعه على الاستمرار. تستطيع إرسال رسائل تشجيعية عبر المنصة.</div>
          <span class="step-tip"><i class="bi bi-lightbulb-fill"></i> التشجيع يرفع الدافعية بنسبة 80%</span>
        </div>

      </div>
    </div>

    <!-- Kid steps -->
    <div class="tab-panel" id="panelKid">
      <div class="steps-grid">

        <div class="step-card sc-1 reveal">
          <div class="step-num sn-green">1</div>
          <div class="step-icon-wrap si-green"><i class="bi bi-box-arrow-in-right"></i></div>
          <div class="step-title">سجّل دخولك</div>
          <div class="step-desc">اضغط على "تسجيل الدخول" واختر "الطفل"، ثم أدخل اسم المستخدم وكلمة المرور اللذين أعطاك إياهما ولي أمرك.</div>
          <span class="step-tip"><i class="bi bi-emoji-smile-fill"></i> ستجد صفحتك الخاصة بك مباشرة!</span>
        </div>

        <div class="step-card sc-2 reveal">
          <div class="step-num sn-orange">2</div>
          <div class="step-icon-wrap si-orange"><i class="bi bi-grid-fill"></i></div>
          <div class="step-title">اختر المادة التي تريد</div>
          <div class="step-desc">ستظهر لك جميع المواد الدراسية. اختر ما تشاء — رياضيات، عربية، علوم أو أي مادة أخرى وابدأ المغامرة!</div>
          <span class="step-tip"><i class="bi bi-stars"></i> كل مادة فيها ألعاب ودروس مثيرة</span>
        </div>

        <div class="step-card sc-3 reveal">
          <div class="step-num sn-gold">3</div>
          <div class="step-icon-wrap si-gold"><i class="bi bi-play-circle-fill"></i></div>
          <div class="step-title">ابدأ الدرس واستمتع</div>
          <div class="step-desc">كل درس قصير وممتع ويحتوي على فيديو أو نص تفاعلي، ثم تمارين مشوّقة تختبر ما تعلّمته. استعد لتكسب النقاط!</div>
          <span class="step-tip"><i class="bi bi-trophy-fill"></i> أجب صح واكسب نقاطاً ذهبية</span>
        </div>

        <div class="step-card sc-4 reveal">
          <div class="step-num sn-red">4</div>
          <div class="step-icon-wrap si-red"><i class="bi bi-award-fill"></i></div>
          <div class="step-title">اجمع الشارات والجوائز</div>
          <div class="step-desc">كلما أتممت درساً أو حللت تحدياً، تحصل على شارة جديدة! اجمع كلها وتسلّق سلم التفوق وصولاً لـ "بطل الجزائر".</div>
          <span class="step-tip"><i class="bi bi-fire"></i> هل يمكنك جمع كل الشارات؟</span>
        </div>

        <div class="step-card sc-5 reveal">
          <div class="step-num sn-green">5</div>
          <div class="step-icon-wrap si-purple"><i class="bi bi-people-fill"></i></div>
          <div class="step-title">تنافس مع أصدقائك</div>
          <div class="step-desc">تفقّد لوحة الترتيب واعرف مكانتك مقارنة بباقي الطلاب. تحدّ نفسك كل يوم لترتقي أكثر وأكثر!</div>
          <span class="step-tip"><i class="bi bi-lightning-fill"></i> من يصل للمركز الأول اليوم؟</span>
        </div>

        <div class="step-card sc-6 reveal">
          <div class="step-num sn-orange">6</div>
          <div class="step-icon-wrap si-blue"><i class="bi bi-calendar-check-fill"></i></div>
          <div class="step-title">تعلّم كل يوم ولو قليلاً</div>
          <div class="step-desc">العبقري الحقيقي يتعلّم كل يوم! خصّص 15 إلى 30 دقيقة يومياً وستُفاجأ بتطورك الهائل في وقت قصير.</div>
          <span class="step-tip"><i class="bi bi-star-fill"></i> الاستمرار هو سرّ النجاح دائماً</span>
        </div>

      </div>
    </div>

  </div>
</section>

<!-- ══════ FEATURES ══════ -->
<section class="feat-sec">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-gem"></i> مميزاتنا</span>
      <h2 class="sec-title reveal">لماذا تختار <em>مقــــام</em>؟</h2>
      <p class="sec-sub reveal">نقدّم تجربة تعليمية لا مثيل لها في المنطقة — مدروسة، ممتعة، وجزائرية بامتياز</p>
    </div>
    <div class="feat-grid">

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-flag-fill"></i></div>
        <div class="feat-title">محتوى وطني أصيل</div>
        <div class="feat-desc">كل درس يعكس قيمنا وتاريخنا وهويتنا الجزائرية — من الثورة التحريرية إلى جغرافيتنا وتراثنا الغني.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> مطابق للمناهج الرسمية الجزائرية</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-controller"></i></div>
        <div class="feat-title">تعلّم تفاعلي وممتع</div>
        <div class="feat-desc">الدروس ليست كتباً جافة — هي ألعاب تعليمية، تحديات، مسابقات وقصص تشدّ الطفل وتجعله يطلب المزيد.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> مصمم خصيصاً لكل أعمار</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-shield-fill-check"></i></div>
        <div class="feat-title">بيئة آمنة ومحمية</div>
        <div class="feat-desc">لا إعلانات، لا محتوى ضار، لا تواصل مع غرباء. بيئة مغلقة وآمنة 100% تحت إشراف ولي الأمر في كل وقت.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> حماية كاملة لبيانات طفلك</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="feat-title">متابعة ذكية للتقدم</div>
        <div class="feat-desc">تقارير تفصيلية لكل مادة وكل درس — يرى ولي الأمر بدقة أين يتفوق طفله وأين يحتاج مساعدة إضافية.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> تقارير أسبوعية تصل لبريدك</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-trophy-fill"></i></div>
        <div class="feat-title">نظام تحفيزي متطور</div>
        <div class="feat-desc">نقاط، شارات، مستويات وترتيب — نظام مكافآت يجعل الطفل يتسابق مع نفسه وأصدقائه لبلوغ القمة كل يوم.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> 4 مستويات من المبتدئ لبطل الجزائر</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-phone-fill"></i></div>
        <div class="feat-title">متاح على كل الأجهزة</div>
        <div class="feat-desc">سواء على الحاسوب، التابلت أو الهاتف — مكام تعمل بسلاسة على كل الأجهزة في أي مكان وبدون تطبيق إضافي.</div>
        <div class="feat-check"><i class="bi bi-check-circle-fill"></i> لا تحتاج تنزيل أي شيء</div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ STATS ══════ -->
<section class="stats-sec">
  <div class="container">
    <div class="stats-inner">
      <div class="stat-box reveal">
        <i class="bi bi-mortarboard-fill stat-icon"></i>
        <span class="stat-num" data-count="5000" data-suffix="+">0</span>
        <span class="stat-lbl">طالب مسجّل</span>
      </div>
      <div class="stat-box reveal">
        <i class="bi bi-book-fill stat-icon"></i>
        <span class="stat-num" data-count="200" data-suffix="+">0</span>
        <span class="stat-lbl">درس تفاعلي متاح</span>
      </div>
      <div class="stat-box reveal">
        <i class="bi bi-emoji-smile-fill stat-icon"></i>
        <span class="stat-num" data-count="98" data-suffix="%">0</span>
        <span class="stat-lbl">نسبة رضا الأسر</span>
      </div>
      <div class="stat-box reveal">
        <i class="bi bi-map-fill stat-icon"></i>
        <span class="stat-num" data-count="48" data-suffix="">0</span>
        <span class="stat-lbl">ولاية جزائرية</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════ STORY / VALUES ══════ -->
<section class="story-sec" id="story">
  <div class="container">
    <div class="story-inner">

      <!-- Left: story -->
      <div class="reveal-right">
        <span class="sec-badge"><i class="bi bi-heart-fill"></i> قصتنا ورسالتنا</span>
        <h2 class="sec-title">نؤمن بأن كل طفل <em>جزائري</em> يستحق الأفضل</h2>

        <div class="story-quote">
          <p><i class="bi bi-quote"></i> انطلقنا من سؤال بسيط: لماذا لا توجد منصة تعليمية جزائرية حقيقية تجعل أطفالنا فخورين بهويتهم وهم يتعلمون؟ كانت الإجابة هي مكام.</p>
          <span>— فريق مكام التعليمي</span>
        </div>

        <div class="values-grid">
          <div class="val-card">
            <div class="val-icon wi-green"><i class="bi bi-flag-fill"></i></div>
            <div>
              <div class="val-name">الهوية الوطنية</div>
              <div class="val-desc">نفخر بجزائريتنا ونجعلها محور التعلم</div>
            </div>
          </div>
          <div class="val-card">
            <div class="val-icon wi-orange"><i class="bi bi-lightbulb-fill"></i></div>
            <div>
              <div class="val-name">الابتكار التعليمي</div>
              <div class="val-desc">أساليب حديثة تجعل التعلم لا ينسى</div>
            </div>
          </div>
          <div class="val-card">
            <div class="val-icon wi-gold"><i class="bi bi-people-fill"></i></div>
            <div>
              <div class="val-name">شراكة الأسرة</div>
              <div class="val-desc">ولي الأمر شريك أساسي في رحلة التعلم</div>
            </div>
          </div>
          <div class="val-card">
            <div class="val-icon wi-red"><i class="bi bi-shield-fill-check"></i></div>
            <div>
              <div class="val-name">الأمان والثقة</div>
              <div class="val-desc">بيئة محمية وشفافية كاملة مع الأهل</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: timeline card -->
      <div class="story-visual reveal-left">
        <div class="hero-badge-float" style="position:absolute;top:-18px;left:30px;animation:floatY 3.5s ease-in-out infinite">
          <i class="bi bi-stars" style="color:var(--gold)"></i> قصة نجاح
        </div>
        <div class="story-img-card">
          <div class="sic-header">
            <div class="sic-avatar"><i class="bi bi-building-fill"></i></div>
            <div>
              <div class="sic-name">رحلة مقــــام</div>
              <div class="sic-role">من فكرة إلى منصة وطنية</div>
            </div>
          </div>
          <div class="sic-timeline">
            <div class="sic-event">
              <div class="sic-dot sic-dot-g" style="margin-top:6px"></div>
              <div class="sic-event-body">
                <div class="sic-event-title"> الفكرة والانطلاق</div>
                <div class="sic-event-year">ولدت الفكرة من حاجة حقيقية لمحتوى جزائري تعليمي حقيقي للأطفال</div>
              </div>
            </div>
            <div class="sic-event">
              <div class="sic-dot sic-dot-o" style="margin-top:6px"></div>
              <div class="sic-event-body">
                <div class="sic-event-title"> التطوير والبناء</div>
                <div class="sic-event-year">بنينا المنصة بالكامل بعقول وأيدٍ جزائرية متخصصة في التعليم والتقنية</div>
              </div>
            </div>
            <div class="sic-event">
              <div class="sic-dot sic-dot-gold" style="margin-top:6px"></div>
              <div class="sic-event-body">
                <div class="sic-event-title"> الإطلاق والانتشار</div>
                <div class="sic-event-year">انضم آلاف الأطفال من 58 ولاية جزائرية في وقت قياسي</div>
              </div>
            </div>
            <div class="sic-event">
              <div class="sic-dot sic-dot-r" style="margin-top:6px"></div>
              <div class="sic-event-body">
                <div class="sic-event-title"> النمو والتطور المستمر</div>
                <div class="sic-event-year">نضيف دروساً وميزات جديدة كل شهر استجابةً لأهالي الجزائر</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ CTA ══════ -->
<section class="cta-sec">
  <div class="container">
    <div class="cta-inner">
      <i class="bi bi-rocket-takeoff-fill cta-icon"></i>
      <h2 class="cta-title reveal">انضم مقــــام <em>اليوم</em> مجاناً!</h2>
      <p class="cta-desc reveal">آلاف الأسر الجزائرية وثقت بمكام لتعليم أبنائها. التسجيل مجاني تماماً ويستغرق أقل من دقيقتين. ابدأ رحلة التعلم الحقيقية الآن.</p>
      <div class="cta-btns reveal">
        <a href="/register" class="btn btn-white btn-lg">
          <i class="bi bi-person-plus-fill"></i> سجّل كولي أمر الآن
        </a>
        <a href="/login" class="btn btn-lg" style="background:rgba(255,255,255,.15);color:#fff;border:2px solid rgba(255,255,255,.4)">
          <i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول
        </a>
      </div>
      <div class="cta-trust reveal">
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> مجاني للبدء</div>
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> لا بطاقة بنكية</div>
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> آمن ومحمي</div>
        <div class="trust-item"><i class="bi bi-check-circle-fill"></i> مصنوع في الجزائر</div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../site/frontend/includes/footer.php'; ?>

<script>
(function(){
  /* ── Scroll reveal ── */
  var obs=new IntersectionObserver(function(entries){
    entries.forEach(function(en){if(en.isIntersecting)en.target.classList.add('visible');});
  },{threshold:0.08,rootMargin:'0px 0px -30px 0px'});
  document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(function(el){obs.observe(el);});

  /* ── Count-up ── */
  function animateCounter(el){
    var target=parseInt(el.dataset.count)||0;
    var suffix=el.dataset.suffix||'';
    var dur=1800,start=performance.now();
    (function step(now){
      var p=Math.min((now-start)/dur,1);
      var ease=1-Math.pow(1-p,3);
      el.textContent=Math.round(ease*target).toLocaleString('en-US')+suffix;
      if(p<1)requestAnimationFrame(step);
    })(start);
  }
  var cObs=new IntersectionObserver(function(entries){
    entries.forEach(function(en){
      if(en.isIntersecting&&!en.target.dataset.counted){
        en.target.dataset.counted='1';animateCounter(en.target);
      }
    });
  },{threshold:0.4});
  document.querySelectorAll('[data-count]').forEach(function(el){cObs.observe(el);});

  /* ── Stagger feat cards ── */
  document.querySelectorAll('.feat-grid .feat-card').forEach(function(el,i){
    el.style.transitionDelay=(i*0.08)+'s';
  });
  document.querySelectorAll('.steps-grid .step-card').forEach(function(el,i){
    el.style.transitionDelay=(i*0.07)+'s';
  });
})();

/* ── Tab switcher ── */
function switchTab(tab){
  document.getElementById('panelParent').classList.toggle('active', tab==='parent');
  document.getElementById('panelKid').classList.toggle('active', tab==='kid');
  document.getElementById('tabParent').classList.toggle('active', tab==='parent');
  document.getElementById('tabKid').classList.toggle('active', tab==='kid');
  /* re-trigger reveals */
  var obs2=new IntersectionObserver(function(entries){
    entries.forEach(function(en){if(en.isIntersecting)en.target.classList.add('visible');});
  },{threshold:0.08});
  document.querySelectorAll('.tab-panel.active .reveal,.tab-panel.active .reveal-left,.tab-panel.active .reveal-right').forEach(function(el){
    el.classList.remove('visible');obs2.observe(el);
  });
}
</script>
