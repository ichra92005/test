<?php
require_once __DIR__ . '/site/frontend/config/config.php';
$page_title  = 'مكام MAKAM — منصة التعليم الجزائرية للأطفال';
$page_desc   = MAKAM_DESCRIPTION;
$active_page = 'home';
$body_class  = 'page-home';
require_once __DIR__ . '/site/frontend/includes/header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* =====================================================
   MAKAM — INDEX PAGE — Algerian Warmth + Bootstrap Icons
   ===================================================== */
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

/* ── Reveal ── */
.reveal{opacity:0;transform:translateY(28px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal.visible{opacity:1;transform:none}
.reveal-left{opacity:0;transform:translateX(36px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal-left.visible{opacity:1;transform:none}
.reveal-right{opacity:0;transform:translateX(-36px);transition:.7s cubic-bezier(.4,0,.2,1)}
.reveal-right.visible{opacity:1;transform:none}

/* ── Buttons ── */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:.55rem;padding:.85rem 2rem;border-radius:var(--r);font-family:var(--font);font-weight:800;font-size:1rem;text-decoration:none;transition:var(--tr);cursor:pointer;border:none;line-height:1}
.btn i{font-size:1.1rem}
.btn-primary{background:linear-gradient(135deg,var(--green),var(--green2));color:var(--white);box-shadow:0 4px 18px rgba(45,122,69,.3)}
.btn-primary:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(45,122,69,.4)}
.btn-orange{background:linear-gradient(135deg,var(--orange),var(--orange2));color:var(--white);box-shadow:0 4px 18px rgba(224,120,36,.3)}
.btn-orange:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(224,120,36,.4)}
.btn-outline{background:var(--white);color:var(--green);border:2.5px solid var(--green)}
.btn-outline:hover{background:var(--green-pale);transform:translateY(-2px)}
.btn-white{background:var(--white);color:var(--green)}
.btn-white:hover{background:var(--green-pale);transform:translateY(-3px)}
.btn-lg{padding:1.05rem 2.6rem;font-size:1.08rem}

/* ── Container ── */
.container{max-width:1340px;margin:0 auto;padding:0 1.5rem}
section{padding:5.5rem 0}

/* ── Section Labels ── */
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
.hero{min-height:100vh;background:linear-gradient(145deg,#FFF8F0 0%,#FFFCF5 40%,#F0FAF4 75%,#E8F5EE 100%);padding-top:7rem;position:relative;overflow:hidden;display:flex;align-items:center}

/* Warm blobs */
.hero-blob{position:absolute;border-radius:50%;pointer-events:none;filter:blur(60px);opacity:.17}
.hb-1{width:520px;height:520px;background:var(--orange);top:-160px;right:-140px;animation:blobFloat 9s ease-in-out infinite}
.hb-2{width:400px;height:400px;background:var(--gold);bottom:-120px;left:-100px;animation:blobFloat 11s ease-in-out 2s infinite}
.hb-3{width:260px;height:260px;background:var(--green);top:45%;right:40%;animation:blobFloat 7s ease-in-out 1s infinite}
@keyframes blobFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-18px) scale(1.04)}}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@keyframes spinR{from{transform:rotate(0deg)}to{transform:rotate(-360deg)}}

/* Star icons deco */
.stars-deco{position:absolute;inset:0;pointer-events:none;overflow:hidden}
.star-deco{position:absolute;color:var(--gold);animation:twinkle 2.8s ease-in-out infinite;opacity:.2;font-size:1.2rem}
@keyframes twinkle{0%,100%{opacity:.1;transform:scale(1) rotate(0deg)}50%{opacity:.4;transform:scale(1.3) rotate(20deg)}}

.hero-inner{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;position:relative;z-index:2}

/* Hero Content */
.hero-flag-tag{display:inline-flex;align-items:center;gap:.6rem;background:linear-gradient(135deg,rgba(224,120,36,.11),rgba(232,184,48,.11));border:1.5px solid rgba(224,120,36,.28);color:var(--orange2);font-weight:800;font-size:.9rem;padding:.5rem 1.3rem;border-radius:var(--r-full);margin-bottom:1.6rem;box-shadow:0 3px 16px rgba(224,120,36,.1);animation:slideDown .6s ease}
.hero-flag-tag i{font-size:1rem}
@keyframes slideDown{from{opacity:0;transform:translateY(-14px)}to{opacity:1;transform:none}}
.hero-h1{font-size:3.1rem;font-weight:900;line-height:1.12;color:var(--gray-800);margin-bottom:1.3rem}
.word-brand{display:block;font-size:3.9rem;background:linear-gradient(135deg,var(--green),var(--green3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.word-brand::after{content:'';display:block;height:5px;background:linear-gradient(to left,var(--gold),var(--orange));border-radius:3px;margin-top:4px;width:65%;opacity:.7}
.word-arabic{display:block;font-size:2.6rem;color:var(--red)}
.hero-desc{font-size:1.1rem;color:var(--gray-600);line-height:1.9;margin-bottom:2rem;max-width:520px}
.hero-actions{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem}

/* Hero Mini Stats */
.hero-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.8rem}
.hstat{background:var(--white);border-radius:var(--r);padding:1rem .6rem;text-align:center;box-shadow:var(--sh-warm);border:1.5px solid rgba(224,120,36,.1);transition:var(--tr)}
.hstat:hover{transform:translateY(-3px);box-shadow:0 8px 28px rgba(224,120,36,.2)}
.hstat-icon{font-size:1.8rem;display:block;margin-bottom:.35rem;line-height:1;color:var(--orange)}
.hstat-num{font-size:1.25rem;font-weight:900;color:var(--green);display:block;line-height:1}
.hstat-lbl{font-size:.7rem;color:var(--gray-400);font-weight:700;display:block;margin-top:.2rem}

/* Hero Visual Card */
.hero-visual{position:relative;display:flex;justify-content:center;align-items:center}
.hero-main-card{background:var(--white);border-radius:28px;padding:2.2rem 2rem;box-shadow:0 24px 70px rgba(224,120,36,.16),0 4px 20px rgba(45,122,69,.07);position:relative;z-index:2;width:100%;max-width:400px;border:2px solid rgba(232,184,48,.2)}
.card-header-tag{display:flex;align-items:center;gap:.6rem;font-weight:900;font-size:1rem;color:var(--gray-800);margin-bottom:1.4rem;padding-bottom:1rem;border-bottom:2px dashed rgba(232,184,48,.35)}
.card-header-tag i{font-size:1.3rem;color:var(--orange)}

/* Subject mini grid */
.subj-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
.subj-item{border-radius:14px;padding:1.4rem 1rem;text-align:center;transition:var(--tr);cursor:default}
.subj-item:hover{transform:scale(1.06) translateY(-4px)}
.subj-icon{font-size:2.2rem;display:block;margin-bottom:.5rem;line-height:1;transition:var(--tr)}
.subj-item:hover .subj-icon{transform:rotate(-8deg) scale(1.1)}
.subj-name{font-size:.82rem;font-weight:900;display:block;line-height:1.3}
.subj-math{background:linear-gradient(135deg,#EDE7F6,#E8E0F5)}.subj-math .subj-icon{color:#5E35B1}.subj-math .subj-name{color:#5E35B1}
.subj-history{background:linear-gradient(135deg,#FFF3E0,#FFE8C5)}.subj-history .subj-icon{color:var(--orange2)}.subj-history .subj-name{color:var(--orange2)}

/* Floating notification badges */
.hero-badge-float{position:absolute;background:var(--white);border-radius:14px;padding:.7rem 1rem;box-shadow:0 8px 32px rgba(0,0,0,.11);display:flex;align-items:center;gap:.55rem;white-space:nowrap;font-weight:800;font-size:.83rem;z-index:3;border:1.5px solid rgba(232,184,48,.2)}
.hero-badge-float i{font-size:1.1rem}
.hbf-1{top:-26px;left:-36px;color:var(--orange2);animation:floatY 3s ease-in-out infinite}
.hbf-2{bottom:12px;left:-44px;color:var(--green);animation:floatY 3.4s ease-in-out .7s infinite}
.hbf-3{top:40%;right:-50px;color:#7B1FA2;animation:floatY3 2.9s ease-in-out .3s infinite}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes floatY3{0%,100%{transform:translateY(-50%)}50%{transform:translateY(calc(-50% - 10px))}}

/* ══════════════════════════════════════
   MARQUEE FACTS STRIP
══════════════════════════════════════ */
.facts-strip{background:linear-gradient(135deg,var(--orange),var(--orange2));padding:1rem 0;overflow:hidden}
.facts-track{display:flex;animation:marquee 30s linear infinite;white-space:nowrap;align-items:center}
@keyframes marquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.facts-item{display:inline-flex;align-items:center;gap:.6rem;color:rgba(255,255,255,.93);font-weight:700;font-size:.9rem;padding:0 2.5rem;flex-shrink:0}
.facts-item i{font-size:1rem;color:var(--gold)}
.facts-dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.5);flex-shrink:0}

/* ══════════════════════════════════════
   STATS SECTION
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
   HOW IT WORKS
══════════════════════════════════════ */
.how-sec{background:linear-gradient(180deg,var(--warm-bg),var(--cream));position:relative;overflow:hidden}
.steps-row{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:3rem;position:relative}
.steps-connector{position:absolute;top:56px;right:calc(16.67% + 55px);left:calc(16.67% + 55px);height:3px;background:repeating-linear-gradient(to left,var(--orange) 0,var(--orange) 8px,transparent 8px,transparent 18px);z-index:0;opacity:.28}
.step-card{text-align:center;position:relative;z-index:1;background:var(--white);border-radius:24px;padding:2.5rem 1.8rem;box-shadow:var(--sh-warm);border:1.5px solid rgba(232,184,48,.18);transition:var(--tr)}
.step-card:hover{transform:translateY(-7px);box-shadow:0 20px 52px rgba(224,120,36,.17)}
.step-icon-wrap{width:88px;height:88px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.4rem;position:relative;transition:var(--tr)}
.step-card:hover .step-icon-wrap{transform:scale(1.1) rotate(-6deg)}
.step-icon-wrap i{font-size:2.6rem;line-height:1}
.step-icon-1{background:linear-gradient(135deg,#E8F5EE,#C8E6D4);border:3px solid rgba(45,122,69,.18)}
.step-icon-1 i{color:var(--green)}
.step-icon-2{background:linear-gradient(135deg,#FFF3E8,#FFE0C5);border:3px solid rgba(224,120,36,.18)}
.step-icon-2 i{color:var(--orange)}
.step-icon-3{background:linear-gradient(135deg,#FFF9E6,#FFE8A0);border:3px solid rgba(232,184,48,.28)}
.step-icon-3 i{color:var(--gold2)}
.step-num-badge{position:absolute;top:-4px;right:-4px;width:26px;height:26px;border-radius:50%;background:var(--orange);color:var(--white);font-size:.72rem;font-weight:900;display:flex;align-items:center;justify-content:center;border:2px solid var(--white)}
.step-title{font-size:1.15rem;font-weight:900;color:var(--gray-800);margin-bottom:.6rem}
.step-desc{font-size:.9rem;color:var(--gray-500);line-height:1.75}
.step-tip{display:inline-flex;align-items:center;gap:.35rem;background:var(--orange-pale);color:var(--orange2);font-size:.8rem;font-weight:800;padding:.28rem .85rem;border-radius:50px;margin-top:1rem;border:1px solid rgba(224,120,36,.18)}
.step-tip i{font-size:.85rem}

/* ══════════════════════════════════════
   FEATURES
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
   MAQAM ECHAHID SECTION
══════════════════════════════════════ */
.maqam-sec{background:linear-gradient(180deg,#F5FBF7 0%,#FFFCF8 50%,#F0F8FF 100%);position:relative;overflow:hidden;padding:6rem 0}
.maqam-sec::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 100%,rgba(45,122,69,.07) 0%,transparent 70%);pointer-events:none}

/* Decorative stars */
.maqam-stars{position:absolute;inset:0;pointer-events:none;overflow:hidden}
.mq-star{position:absolute;width:6px;height:6px;border-radius:50%;animation:mqs 3s ease-in-out infinite}
@keyframes mqs{0%,100%{opacity:.15;transform:scale(1)}50%{opacity:.5;transform:scale(1.5)}}

.maqam-inner{display:grid;grid-template-columns:1fr 1.1fr;gap:5rem;align-items:center}

/* Left: Info */
.maqam-info{position:relative;z-index:2}
.maqam-year-tag{display:inline-flex;align-items:center;gap:.55rem;background:linear-gradient(135deg,rgba(193,57,43,.1),rgba(193,57,43,.05));border:1.5px solid rgba(193,57,43,.25);color:var(--red2);font-weight:900;font-size:.88rem;padding:.42rem 1.2rem;border-radius:var(--r-full);margin-bottom:1.4rem}
.maqam-year-tag i{font-size:.95rem}
.maqam-title{font-size:2.5rem;font-weight:900;line-height:1.15;color:var(--gray-800);margin-bottom:.5rem}
.maqam-title .mq-hl{background:linear-gradient(135deg,var(--green),var(--green2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.maqam-subtitle{font-size:1rem;color:var(--gray-500);margin-bottom:2rem;line-height:1.8;max-width:460px}
.maqam-facts{display:flex;flex-direction:column;gap:1rem;margin-bottom:2.2rem}
.mq-fact{display:flex;align-items:flex-start;gap:1rem;background:var(--white);border-radius:16px;padding:1rem 1.2rem;border:1.5px solid rgba(232,184,48,.18);box-shadow:0 3px 16px rgba(224,120,36,.06);transition:var(--tr)}
.mq-fact:hover{transform:translateX(-4px);box-shadow:0 8px 28px rgba(45,122,69,.1)}
.mq-fact-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.mq-fact-icon i{font-size:1.3rem}
.mq-fi-green{background:linear-gradient(135deg,#E8F5EE,#C8E6D4)}.mq-fi-green i{color:var(--green)}
.mq-fi-red{background:linear-gradient(135deg,#FDECEA,#FBD0CB)}.mq-fi-red i{color:var(--red)}
.mq-fi-gold{background:linear-gradient(135deg,#FFF9E6,#FFE8A0)}.mq-fi-gold i{color:var(--gold2)}
.mq-fact-body{}
.mq-fact-label{font-size:.78rem;font-weight:700;color:var(--gray-400);margin-bottom:.1rem;text-transform:uppercase;letter-spacing:.04em}
.mq-fact-val{font-size:.95rem;font-weight:900;color:var(--gray-800)}
.maqam-quote{background:linear-gradient(135deg,var(--green),var(--green2));border-radius:18px;padding:1.4rem 1.6rem;color:var(--white);font-size:1rem;font-weight:700;line-height:1.7;position:relative;overflow:hidden}
.maqam-quote::before{content:'"';position:absolute;top:-20px;right:16px;font-size:8rem;opacity:.1;font-family:Georgia,serif;line-height:1}
.maqam-quote i{color:var(--gold);margin-left:.4rem}

/* Right: Monument SVG */
.maqam-visual{display:flex;justify-content:center;align-items:center;position:relative;z-index:2}
.maqam-svg-wrap{position:relative;width:100%;max-width:440px;filter:drop-shadow(0 30px 60px rgba(45,122,69,.18)) drop-shadow(0 8px 24px rgba(193,57,43,.08))}
.maqam-svg-wrap svg{width:100%;height:auto;animation:maqFloat 6s ease-in-out infinite}
@keyframes maqFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}

/* Glow ring behind monument */
.maqam-glow{position:absolute;bottom:-30px;left:50%;transform:translateX(-50%);width:75%;height:60px;background:radial-gradient(ellipse,rgba(45,122,69,.25) 0%,transparent 70%);border-radius:50%;filter:blur(8px)}

/* Bottom ribbon */
.maqam-ribbon{display:flex;align-items:center;justify-content:center;gap:1.5rem;margin-top:3.5rem;flex-wrap:wrap}
.mq-ribbon-item{display:flex;align-items:center;gap:.5rem;background:var(--white);border:1.5px solid rgba(232,184,48,.2);border-radius:var(--r-full);padding:.5rem 1.2rem;font-size:.85rem;font-weight:800;color:var(--gray-700);box-shadow:0 3px 14px rgba(224,120,36,.07);transition:var(--tr)}
.mq-ribbon-item:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(45,122,69,.12);border-color:var(--green)}
.mq-ribbon-item i{font-size:1rem}
.mq-ri-green i{color:var(--green)}.mq-ri-red i{color:var(--red)}.mq-ri-gold i{color:var(--gold2)}.mq-ri-orange i{color:var(--orange)}

/* ── Responsive maqam ── */
@media(max-width:900px){.maqam-inner{grid-template-columns:1fr;gap:2.5rem}.maqam-visual{order:-1}}
@media(max-width:560px){.maqam-title{font-size:2rem}.maqam-ribbon{gap:.8rem}}

/* ══════════════════════════════════════
   LEARNING JOURNEY
══════════════════════════════════════ */
.journey-sec{background:linear-gradient(180deg,var(--green-xpale),var(--warm-bg))}
.journey-row{display:flex;align-items:flex-start;gap:0;margin-top:3.5rem;flex-wrap:wrap;justify-content:center}
.journey-item{text-align:center;flex:1;min-width:160px;position:relative;padding:0 .5rem}
.journey-item:not(:last-child)::after{content:'';position:absolute;top:44px;left:-4px;width:20px;height:3px;background:var(--orange);opacity:.3}
.jn-icon{width:90px;height:90px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;box-shadow:0 8px 28px rgba(0,0,0,.1);transition:var(--tr);border:4px solid var(--white)}
.jn-icon i{font-size:2.5rem;line-height:1}
.journey-item:hover .jn-icon{transform:scale(1.12) rotate(6deg)}
.jn-1 .jn-icon{background:linear-gradient(135deg,#A8D5A2,#6DBF67)}.jn-1 .jn-icon i{color:#fff}
.jn-2 .jn-icon{background:linear-gradient(135deg,#FFD080,#FFC040)}.jn-2 .jn-icon i{color:#fff}
.jn-3 .jn-icon{background:linear-gradient(135deg,#80C8FF,#50A0F0)}.jn-3 .jn-icon i{color:#fff}
.jn-4 .jn-icon{background:linear-gradient(135deg,#FF9A70,#FF6B3D)}.jn-4 .jn-icon i{color:#fff}
.jn-5 .jn-icon{background:linear-gradient(135deg,#E8B830,#C89020)}.jn-5 .jn-icon i{color:#fff}
.jn-title{font-size:1rem;font-weight:900;color:var(--gray-800);margin-bottom:.3rem}
.jn-desc{font-size:.82rem;color:var(--gray-400);line-height:1.5}
.jn-badge{display:inline-block;font-size:.73rem;font-weight:800;padding:.22rem .8rem;border-radius:50px;margin-top:.5rem;border:1.5px solid transparent}
.jn-1 .jn-badge{background:#E8F5E9;color:var(--green);border-color:rgba(45,122,69,.2)}
.jn-2 .jn-badge{background:#FFF8E1;color:var(--gold2);border-color:rgba(232,184,48,.3)}
.jn-3 .jn-badge{background:#E3F2FD;color:#1565C0;border-color:rgba(21,101,192,.2)}
.jn-4 .jn-badge{background:#FBE9E7;color:var(--orange);border-color:rgba(224,120,36,.25)}
.jn-5 .jn-badge{background:#FFF9E6;color:var(--gold2);border-color:rgba(232,184,48,.35)}

/* ══════════════════════════════════════
   FUN FACTS / NUMBERS
══════════════════════════════════════ */
.funfact-sec{background:linear-gradient(135deg,#FFF8E1,#FFF3D5,#FFF8F0);padding:5rem 0;position:relative;overflow:hidden}
.funfact-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:3rem}
.ff-card{border-radius:22px;padding:2.2rem 1.5rem;text-align:center;border:2px solid transparent;transition:var(--tr);cursor:default;box-shadow:0 4px 20px rgba(0,0,0,.05)}
.ff-card:hover{transform:translateY(-6px);box-shadow:0 16px 40px rgba(0,0,0,.1)}
.ff-icon-wrap{width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;transition:var(--tr)}
.ff-card:hover .ff-icon-wrap{transform:scale(1.12) rotate(-8deg)}
.ff-icon-wrap i{font-size:2rem;line-height:1}
.ff-num{font-size:2.3rem;font-weight:900;display:block;margin-bottom:.3rem;line-height:1}
.ff-label{font-size:.88rem;font-weight:700;opacity:.75}
.ff-1{background:linear-gradient(135deg,#E8F5EE,#D4EDD9);color:var(--green)}.ff-1:hover{border-color:var(--green)}.ff-1 .ff-icon-wrap{background:rgba(45,122,69,.15)}.ff-1 .ff-icon-wrap i{color:var(--green)}
.ff-2{background:linear-gradient(135deg,#FFF3E8,#FFDFC0);color:var(--orange)}.ff-2:hover{border-color:var(--orange)}.ff-2 .ff-icon-wrap{background:rgba(224,120,36,.15)}.ff-2 .ff-icon-wrap i{color:var(--orange)}
.ff-3{background:linear-gradient(135deg,#FFF9E6,#FFEDB0);color:var(--gold2)}.ff-3:hover{border-color:var(--gold)}.ff-3 .ff-icon-wrap{background:rgba(232,184,48,.2)}.ff-3 .ff-icon-wrap i{color:var(--gold2)}
.ff-4{background:linear-gradient(135deg,#FDECEA,#FBD0CB);color:var(--red)}.ff-4:hover{border-color:var(--red)}.ff-4 .ff-icon-wrap{background:rgba(193,57,43,.12)}.ff-4 .ff-icon-wrap i{color:var(--red)}

/* ══════════════════════════════════════
   TESTIMONIALS
══════════════════════════════════════ */
.testi-sec{background:var(--cream)}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.testi-card{background:var(--white);border-radius:22px;padding:2rem;border:1.5px solid rgba(232,184,48,.16);transition:var(--tr);position:relative;box-shadow:0 4px 20px rgba(224,120,36,.05)}
.testi-card:hover{transform:translateY(-5px);box-shadow:0 16px 44px rgba(224,120,36,.13)}
.testi-quote-icon{font-size:3rem;color:rgba(232,184,48,.22);line-height:1;margin-bottom:.5rem}
.testi-stars{font-size:1rem;margin-bottom:.9rem;display:flex;gap:.2rem}
.testi-stars i{color:var(--gold)}
.testi-text{font-size:.93rem;color:var(--gray-600);line-height:1.8;margin-bottom:1.4rem;font-style:italic}
.testi-author{display:flex;align-items:center;gap:.8rem}
.ta-avatar{width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:3px solid var(--white);box-shadow:0 3px 12px rgba(0,0,0,.1)}
.ta-avatar i{font-size:1.8rem;color:#fff}
.ta-1{background:linear-gradient(135deg,#A8D5A2,#6DBF67)}
.ta-2{background:linear-gradient(135deg,#80C8FF,#50A0F0)}
.ta-3{background:linear-gradient(135deg,#FFB3C6,#FF80A0)}
.ta-name{font-weight:900;color:var(--gray-800);font-size:.93rem}
.ta-role{font-size:.78rem;color:var(--gray-400);margin-top:.1rem}
.ta-wilaya{display:inline-flex;align-items:center;gap:.3rem;font-size:.75rem;color:var(--orange);font-weight:700;margin-top:.2rem}
.ta-wilaya i{font-size:.8rem}

/* ══════════════════════════════════════
   CTA
══════════════════════════════════════ */
.cta-sec{background:linear-gradient(150deg,#1A5C30,var(--green),#E07824);padding:7rem 0;text-align:center;position:relative;overflow:hidden}
.cta-sec::after{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");pointer-events:none}
.cta-inner{position:relative;z-index:2}
.cta-main-icon{font-size:4.5rem;display:flex;justify-content:center;margin-bottom:1rem;color:var(--gold);animation:bounce2 1.8s ease-in-out infinite}
.cta-main-icon i{line-height:1}
@keyframes bounce2{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-14px) scale(1.07)}}
.cta-title{font-size:2.7rem;font-weight:900;color:var(--white);margin-bottom:1rem;line-height:1.2}
.cta-title em{color:var(--gold);font-style:normal}
.cta-desc{font-size:1.1rem;color:rgba(255,255,255,.82);max-width:560px;margin:0 auto 2.5rem;line-height:1.85}
.cta-btns{display:flex;gap:1.2rem;justify-content:center;flex-wrap:wrap}
.cta-trust{margin-top:2.5rem;display:flex;align-items:center;justify-content:center;gap:2rem;flex-wrap:wrap}
.trust-item{display:flex;align-items:center;gap:.45rem;color:rgba(255,255,255,.72);font-size:.88rem;font-weight:700}
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
  .hero-h1{font-size:2.4rem}
  .word-brand{font-size:2.9rem}
  .hero-stats{grid-template-columns:repeat(2,1fr)}
  .hero-badge-float{display:none}
  .subjects-grid{grid-template-columns:repeat(2,1fr)}
  .steps-row{grid-template-columns:1fr}
  .steps-connector{display:none}
  .testi-grid{grid-template-columns:1fr}
  .funfact-grid{grid-template-columns:repeat(2,1fr)}
  .stats-inner{grid-template-columns:repeat(2,1fr)}
  .stat-box{border-bottom:2px solid rgba(232,184,48,.12)}
  .stat-box:nth-child(odd){border-left:none}
  .cta-title{font-size:2rem}
  section{padding:4rem 0}
}
@media(max-width:768px){
  .nav-links,.nav-actions{display:none}
  .nav-links.open{display:flex;flex-direction:column;position:fixed;top:0;right:0;bottom:0;width:290px;background:var(--white);padding:5.5rem 2rem 2rem;box-shadow:-10px 0 40px rgba(0,0,0,.18);z-index:999;gap:.4rem}
  .hamburger{display:flex}
  .hero{padding-top:6.5rem}
  .journey-row{flex-direction:column;align-items:stretch}
  .journey-item:not(:last-child)::after{display:none}
}
@media(max-width:560px){
  .hero-h1{font-size:1.9rem}
  .word-brand{font-size:2.3rem}
  .word-arabic{font-size:1.7rem}
  .subjects-grid,.funfact-grid{grid-template-columns:1fr}
  .sec-title{font-size:1.8rem}
  .cta-title{font-size:1.6rem}
  .feat-grid{grid-template-columns:1fr}
}
</style>

<!-- ══════ HERO ══════ -->
<section class="hero" id="home">
  <div class="hero-blob hb-1"></div>
  <div class="hero-blob hb-2"></div>
  <div class="hero-blob hb-3"></div>

  <div class="stars-deco" aria-hidden="true">
    <?php
    $positions=[[8,15,0],[20,60,0.5],[85,18,1],[91,68,1.5],[42,8,2],[62,88,2.5],[14,42,3],[74,52,3.5]];
    foreach($positions as $p): ?>
    <i class="bi bi-star-fill star-deco" style="top:<?=$p[1]?>%;right:<?=$p[0]?>%;animation-delay:<?=$p[2]?>s"></i>
    <?php endforeach; ?>
  </div>

  <div class="container">
    <div class="hero-inner">

      <!-- Content -->
      <div class="hero-content">
        <div class="hero-flag-tag reveal">
          <i class="bi bi-flag-fill"></i>
          المنصة التعليمية الجزائرية الأولى للأطفال
        </div>
        <h1 class="hero-h1 reveal">
          تعلّم وابدع مع
          <span class="word-brand">MAQAM</span>
          <span class="word-arabic">مقام !</span>
        </h1>
        <p class="hero-desc reveal">
          منصة تعليمية جزائرية تجمع بين المتعة والتعلم،
          مصممة خصيصاً للأطفال من <strong>6 إلى 15 سنة</strong>،
          مع إشراف كامل لأولياء الأمور وتتبع التقدم لحظة بلحظة.
        </p>
        <div class="hero-actions reveal">
          <a href="/register" class="btn btn-orange btn-lg">
            <i class="bi bi-lightning-fill"></i> ابدأ مجاناً الآن
          </a>
          <a href="#subjects" class="btn btn-outline btn-lg">
            <i class="bi bi-book-half"></i> اكتشف المواد
          </a>
        </div>
        <div class="hero-stats reveal">
          <div class="hstat">
            <i class="bi bi-mortarboard-fill hstat-icon"></i>
            <span class="hstat-num" data-count="5000" data-suffix="+">0</span>
            <span class="hstat-lbl">طالب مسجّل</span>
          </div>
          <div class="hstat">
            <i class="bi bi-book-fill hstat-icon"></i>
            <span class="hstat-num" data-count="200" data-suffix="+">0</span>
            <span class="hstat-lbl">درس تفاعلي</span>
          </div>
          <div class="hstat">
            <i class="bi bi-bullseye hstat-icon"></i>
            <span class="hstat-num" data-count="12" data-suffix="">0</span>
            <span class="hstat-lbl">مادة دراسية</span>
          </div>
          <div class="hstat">
            <i class="bi bi-trophy-fill hstat-icon"></i>
            <span class="hstat-num" data-count="50" data-suffix="+">0</span>
            <span class="hstat-lbl">ولاية مشاركة</span>
          </div>
        </div>
      </div>

      <!-- Visual Card -->
      <div class="hero-visual reveal-left">
        <div class="hero-badge-float hbf-1">
          <i class="bi bi-star-fill"></i> نقطة جديدة مكتسبة!
        </div>
        <div class="hero-badge-float hbf-2">
          <i class="bi bi-check-circle-fill"></i> أتممت الدرس بنجاح!
        </div>
        <div class="hero-badge-float hbf-3">
          <i class="bi bi-lightbulb-fill"></i> سؤال جديد يستحق!
        </div>

        <!-- Blended Maqam Visual -->
        <div style="position:relative;display:flex;justify-content:center;align-items:center;padding:1rem 0">

          <!-- Outer glow halo -->
          <div style="
            position:absolute;
            width:380px;height:380px;
            border-radius:50%;
            background:radial-gradient(circle, rgba(45,122,69,.18) 0%, rgba(232,184,48,.08) 50%, transparent 70%);
            animation:maqFloat 7s ease-in-out infinite;
            pointer-events:none;
          "></div>

          <!-- Spinning dashed ring -->
          <div style="
            position:absolute;
            width:350px;height:350px;
            border-radius:50%;
            border:2px dashed rgba(232,184,48,.35);
            animation:spin 18s linear infinite;
            pointer-events:none;
          "></div>

          <!-- Inner solid ring -->
          <div style="
            position:absolute;
            width:310px;height:310px;
            border-radius:50%;
            border:1.5px solid rgba(45,122,69,.2);
            pointer-events:none;
          "></div>

          <!-- Logo blended with background -->
          <img src="/site/frontend/logo/logo-no.png"
            alt="مقام الشهيد الجزائري"
            style="
              width:320px;height:320px;
              object-fit:cover;
              border-radius:50%;
              display:block;
              mix-blend-mode:multiply;
              filter:
                drop-shadow(0 0 40px rgba(45,122,69,.5))
                drop-shadow(0 0 16px rgba(45,122,69,.3))
                saturate(1.4)
                brightness(0.9);
              animation:maqFloat 6s ease-in-out infinite;
              position:relative;z-index:2;
            ">

          <!-- Decorative sparkle dots -->
          <div style="position:absolute;top:8%;right:12%;width:10px;height:10px;border-radius:50%;background:#E8B830;opacity:.7;animation:twinkle 2.1s ease-in-out infinite"></div>
          <div style="position:absolute;top:18%;left:10%;width:7px;height:7px;border-radius:50%;background:#D21034;opacity:.6;animation:twinkle 1.7s ease-in-out .4s infinite"></div>
          <div style="position:absolute;bottom:20%;right:10%;width:8px;height:8px;border-radius:50%;background:#E8B830;opacity:.65;animation:twinkle 2.4s ease-in-out .8s infinite"></div>
          <div style="position:absolute;bottom:14%;left:14%;width:6px;height:6px;border-radius:50%;background:#2D7A45;opacity:.5;animation:twinkle 2.8s ease-in-out 1.2s infinite"></div>
          <div style="position:absolute;top:50%;right:3%;width:9px;height:9px;border-radius:50%;background:#E8B830;opacity:.5;animation:twinkle 3s ease-in-out .6s infinite"></div>
          <div style="position:absolute;top:44%;left:4%;width:8px;height:8px;border-radius:50%;background:#D21034;opacity:.45;animation:twinkle 2.2s ease-in-out 1s infinite"></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ MARQUEE FACTS ══════ -->
<div class="facts-strip" aria-label="حقائق ممتعة">
  <div class="facts-track" id="factsTrack">
    <?php
    $facts = [
      ['bi-calculator','الرياضيات موجودة في كل مكان حولنا!'],
      ['bi-geo-alt-fill','الجزائر أكبر دولة في أفريقيا بمساحة ٢.٣ مليون كم²'],
      ['bi-book-fill','القراءة تُوسّع خيالك وتقوّي تفكيرك'],
      ['bi-eyedropper','العلم هو مفتاح المستقبل — ابدأ اليوم'],
      ['bi-palette-fill','الفن يساعد الدماغ على التعلم بشكل أسرع'],
      ['bi-bank','الجزائر لها أكثر من ٣٠٠٠ سنة من التاريخ العريق'],
      ['bi-trophy-fill','كل درس تُكمله يجعلك أذكى وأقوى!'],
      ['bi-star-fill','الأطفال الذين يتعلمون يومياً يتقدمون بسرعة'],
    ];
    $all=array_merge($facts,$facts);
    foreach($all as $f): ?>
    <span class="facts-item"><span class="facts-dot"></span><i class="bi <?=$f[0]?>"></i>&nbsp;<?=htmlspecialchars($f[1])?></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- ══════ STATS ══════ -->
<section class="stats-sec">
  <div class="stats-inner">
    <div class="stat-box reveal">
      <i class="bi bi-mortarboard-fill stat-icon"></i>
      <span class="stat-num" data-count="5000" data-suffix="+">0</span>
      <span class="stat-lbl">طالب وطالبة مسجّل</span>
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
      <span class="stat-lbl">ولاية جزائرية مشاركة</span>
    </div>
  </div>
</section>

<section class="how-sec" id="how">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-rocket-fill"></i> كيف تعمل المنصة؟</span>
      <h2 class="sec-title reveal">ثلاث خطوات <em>بسيطة</em> للبدء</h2>
      <p class="sec-sub reveal">ابدأ رحلة التعلم مع طفلك في أقل من 3 دقائق</p>
    </div>
    <div class="steps-row">
      <div class="steps-connector" aria-hidden="true"></div>

      <div class="step-card reveal">
        <div class="step-icon-wrap step-icon-1">
          <i class="bi bi-people-fill"></i>
          <div class="step-num-badge">1</div>
        </div>
        <div class="step-title">سجّل كولي أمر</div>
        <div class="step-desc">أنشئ حسابك كولي أمر ببريدك الإلكتروني، ثم أضف ملف طفلك مع اسمه وسنته الدراسية.</div>
        <span class="step-tip"><i class="bi bi-check-circle-fill"></i> مجاني تماماً</span>
      </div>

      <div class="step-card reveal">
        <div class="step-icon-wrap step-icon-2">
          <i class="bi bi-journals"></i>
          <div class="step-num-badge">2</div>
        </div>
        <div class="step-title">اختر المواد</div>
        <div class="step-desc">اختر المواد التي تريد لطفلك تعلّمها من بين المواد الموافقة للمنهج الجزائري.</div>
        <span class="step-tip"><i class="bi bi-book-half"></i> تاريخ جزائري ام الرياضيــات </span>
      </div>

      <div class="step-card reveal">
        <div class="step-icon-wrap step-icon-3">
          <i class="bi bi-controller"></i>
          <div class="step-num-badge">3</div>
        </div>
        <div class="step-title">تعلّم واستمتع</div>
        <div class="step-desc">يبدأ طفلك الدروس والألعاب التعليمية ويجمع النقاط والشارات، وأنت تتابع تقدمه.</div>
        <span class="step-tip"><i class="bi bi-trophy-fill"></i> نقاط وجوائز</span>
      </div>

    </div>
  </div>
</section>

<section class="feat-sec" id="features">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-stars"></i> مميزات المنصة</span>
      <h2 class="sec-title reveal">لماذا تختار <em>مكام</em>؟</h2>
      <p class="sec-sub reveal">منصة شاملة تضمن تجربة تعليمية آمنة ومتعة حقيقية لطفلك</p>
    </div>
    <div class="feat-grid">

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-shield-fill-check"></i></div>
        <div class="feat-title">بيئة آمنة ١٠٠٪</div>
        <div class="feat-desc">محتوى مراجَع ومناسب للأطفال تماماً. لا إعلانات خارجية، لا تواصل مع مجهولين. راحة بالك أولاً.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> مُراجَع من خبراء التربية</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-bar-chart-fill"></i></div>
        <div class="feat-title">متابعة ذكية لولي الأمر</div>
        <div class="feat-desc">لوحة تحكم خاصة بك تُريك وقت الدراسة، الدرجات، الدروس المكتملة، والمواد التي تحتاج تحسيناً.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> تقارير يومية وأسبوعية</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-flag-fill"></i></div>
        <div class="feat-title">منهج جزائري أصيل</div>
        <div class="feat-desc">محتوى تعليمي موافق لمناهج التعليم الجزائري من الطور الابتدائي إلى المتوسط بلغة عربية سليمة.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> معتمَد على المنهج الوطني</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-trophy-fill"></i></div>
        <div class="feat-title">نظام مكافآت وشارات</div>
        <div class="feat-desc">يجمع الطفل نقاط وشارات مع كل درس يُتمّه، مما يحفّزه على الاستمرار والتميز والوصول للقمة.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> ٥٠+ شارة للكسب</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-phone-fill"></i></div>
        <div class="feat-title">يعمل على كل الأجهزة</div>
        <div class="feat-desc">هاتف ذكي، تابلت، حاسوب — المنصة متجاوبة بالكامل وتعمل بشكل مثالي على أي شاشة بأي حجم.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> بدون تحميل أي تطبيق</div>
      </div>

      <div class="feat-card reveal">
        <div class="feat-icon-wrap"><i class="bi bi-gift-fill"></i></div>
        <div class="feat-title">ابدأ مجاناً الآن</div>
        <div class="feat-desc">سجّل مجاناً وابدأ فوراً. دروس مجانية كافية تُتيح لك اكتشاف قيمة المنصة الحقيقية قبل أي التزام.</div>
        <div class="feat-check"><i class="bi bi-check-lg"></i> لا بطاقة بنكية مطلوبة</div>
      </div>

    </div>
  </div>
</section>

<!-- ══════ MAQAM ECHAHID ══════ -->
<section class="maqam-sec" id="maqam">
  <!-- Decorative floating dots -->
  <div class="maqam-stars" aria-hidden="true">
    <?php
    $dots=[
      ['8%','12%','#E8B830','1.2s'],['92%','8%','#2D7A45','2s'],['15%','78%','#D21034','0.8s'],
      ['88%','72%','#E8B830','1.8s'],['50%','5%','#2D7A45','2.5s'],['3%','50%','#E8B830','1s'],
      ['97%','40%','#D21034','2.2s'],['45%','95%','#2D7A45','1.5s'],
    ];
    foreach($dots as $d): ?>
    <div class="mq-star" style="right:<?=$d[0]?>;top:<?=$d[1]?>;background:<?=$d[2]?>;animation-delay:<?=$d[3]?>"></div>
    <?php endforeach; ?>
  </div>

  <div class="container">
    <div class="maqam-inner">

      <!-- Info side -->
      <div class="maqam-info">
        <span class="maqam-year-tag reveal">
          <i class="bi bi-geo-alt-fill"></i>
          الجزائر العاصمة — 1962
        </span>
        <h2 class="maqam-title reveal">
          شامخٌ كـ<span class="mq-hl">مقـــــــام الشهيد</span><br>نتعلّم لنبني الجزائر
        </h2>
        <p class="maqam-subtitle reveal">
          مقام الشهيد رمز كفاح الجزائر وشموخها — تماماً كما نُشيّد مستقبل أطفالنا بالعلم والمعرفة، درساً درساً.
        </p>

        <div class="maqam-facts reveal">
          <div class="mq-fact">
            <div class="mq-fact-icon mq-fi-gold"><i class="bi bi-rulers"></i></div>
            <div class="mq-fact-body">
              <div class="mq-fact-label">الارتفاع</div>
              <div class="mq-fact-val">92 متراً — شامخٌ فوق الجزائر العاصمة</div>
            </div>
          </div>
          <div class="mq-fact">
            <div class="mq-fact-icon mq-fi-red"><i class="bi bi-calendar-event-fill"></i></div>
            <div class="mq-fact-body">
              <div class="mq-fact-label">يوم التدشين</div>
              <div class="mq-fact-val">1 نوفمبر 1962 — الذكرى الثامنة والعشرون للثورة</div>
            </div>
          </div>
          <div class="mq-fact">
            <div class="mq-fact-icon mq-fi-green"><i class="bi bi-heart-fill"></i></div>
            <div class="mq-fact-body">
              <div class="mq-fact-label">الرمز</div>
              <div class="mq-fact-val">تخليد ذكرى شهداء ثورة التحرير المجيدة 1954</div>
            </div>
          </div>
        </div>

        <div class="maqam-quote reveal">
          <i class="bi bi-quote"></i>
          بالعلم نحافظ على وطن سقاه الشهداء بدمائهم الزكية —
          <strong>منصة مقــام، تعليم جزائري أصيل.</strong>
        </div>
      </div>

      <!-- Monument visual side -->
      <div class="maqam-visual reveal-right">
        <div class="maqam-glow"></div>
        <div class="maqam-svg-wrap" style="text-align:center;position:relative">

          <!-- Decorative ring glow -->
          <div style="position:absolute;inset:0;border-radius:50%;background:radial-gradient(circle at center,rgba(45,122,69,.12) 0%,transparent 68%);pointer-events:none"></div>

          <!-- Orbiting sparkle dots -->
          <div style="position:absolute;top:6%;left:10%;width:14px;height:14px;border-radius:50%;background:#E8B830;opacity:.75;animation:twinkle 2.2s ease-in-out infinite"></div>
          <div style="position:absolute;top:12%;right:8%;width:10px;height:10px;border-radius:50%;background:#D21034;opacity:.65;animation:twinkle 1.8s ease-in-out .5s infinite"></div>
          <div style="position:absolute;bottom:18%;left:5%;width:12px;height:12px;border-radius:50%;background:#2D7A45;opacity:.6;animation:twinkle 2.6s ease-in-out 1s infinite"></div>
          <div style="position:absolute;bottom:22%;right:6%;width:8px;height:8px;border-radius:50%;background:#E8B830;opacity:.7;animation:twinkle 2s ease-in-out .3s infinite"></div>
          <div style="position:absolute;top:50%;left:2%;width:9px;height:9px;border-radius:50%;background:#D21034;opacity:.5;animation:twinkle 3s ease-in-out .7s infinite"></div>
          <div style="position:absolute;top:45%;right:3%;width:11px;height:11px;border-radius:50%;background:#E8B830;opacity:.6;animation:twinkle 2.4s ease-in-out 1.2s infinite"></div>

          <!-- Actual logo image — large, floating -->
          <img src="/site/frontend/logo/logo-no.png"
            alt="شعار مقام الشهيد — الجزائر"
            style="width:100%;max-width:380px;height:auto;display:block;margin:0 auto;
                   filter:drop-shadow(0 20px 50px rgba(45,122,69,.3)) drop-shadow(0 4px 16px rgba(45,122,69,.15));
                   animation:maqFloat 6s ease-in-out infinite;
                   position:relative;z-index:2">

          <!-- Flag stripe under logo -->
          <div style="display:flex;justify-content:center;gap:0;margin:1.4rem auto 0;width:200px;border-radius:6px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,.1)">
            <div style="flex:1;height:8px;background:#006233"></div>
            <div style="flex:1;height:8px;background:#fff;border-top:1px solid #eee;border-bottom:1px solid #eee"></div>
            <div style="flex:1;height:8px;background:#D21034"></div>
          </div>
          <div style="font-size:.8rem;font-weight:900;color:var(--green);margin-top:.7rem;letter-spacing:.05em">
            1 نوفمبر 1962 • الجزائر العاصمة
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom ribbon -->
    <div class="maqam-ribbon">
      <div class="mq-ribbon-item mq-ri-green reveal">
        <i class="bi bi-flag-fill"></i> رمز وطني خالد
      </div>
      <div class="mq-ribbon-item mq-ri-red reveal">
        <i class="bi bi-heart-fill"></i> تكريم 1,5 مليون شهيد
      </div>
      <div class="mq-ribbon-item mq-ri-gold reveal">
        <i class="bi bi-geo-alt-fill"></i> الجزائر العاصمة
      </div>
      <div class="mq-ribbon-item mq-ri-orange reveal">
        <i class="bi bi-mortarboard-fill"></i> نتعلم لنبني الجزائر
      </div>
    </div>
  </div>
</section>

<!-- ══════ LEARNING JOURNEY ══════ -->
<section class="journey-sec" id="badges">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-award-fill"></i> رحلة التعلم</span>
      <h2 class="sec-title reveal">من المبتدئ إلى <em>بطل الجزائر</em></h2>
      <p class="sec-sub reveal">كل درس تُكمله يرفعك مستوى أعلى! هل أنت جاهز للقمة؟</p>
    </div>
    <div class="journey-row">
      <div class="journey-item jn-1 reveal">
        <div class="jn-icon"><i class="bi bi-person-fill"></i></div>
        <div class="jn-title">المبتدئ</div>
        <div class="jn-desc">أول خطوة في رحلة التعلم</div>
        <span class="jn-badge">0 — 100 نقطة</span>
      </div>
      <div class="journey-item jn-2 reveal">
        <div class="jn-icon"><i class="bi bi-star-fill"></i></div>
        <div class="jn-title">النجم الصاعد</div>
        <div class="jn-desc">أتممت دروساً بامتياز</div>
        <span class="jn-badge">100 — 300 نقطة</span>
      </div>
      <div class="journey-item jn-3 reveal">
        <div class="jn-icon"><i class="bi bi-stars"></i></div>
        <div class="jn-title">المتعلم المتميز</div>
        <div class="jn-desc">علامات ممتازة ومتواصلة</div>
        <span class="jn-badge">300 — 600 نقطة</span>
      </div>
      <div class="journey-item jn-4 reveal">
        <div class="jn-icon"><i class="bi bi-award-fill"></i></div>
        <div class="jn-title">المتعلم المثابر</div>
        <div class="jn-desc">اجتياز مستويات عديدة بنجاح</div>
        <span class="jn-badge">600 — 1000 نقطة</span>
      </div>
      <div class="journey-item jn-5 reveal">
        <div class="jn-icon"><i class="bi bi-trophy-fill"></i></div>
        <div class="jn-title">بطل الجزائر!</div>
        <div class="jn-desc">القمة — أنت الأفضل!</div>
        <span class="jn-badge">+1000 نقطة</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════ FUN FACTS / NUMBERS ══════ -->
<section class="funfact-sec">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-graph-up-arrow"></i> أرقام مُلهِمة</span>
      <h2 class="sec-title reveal">مكام <em>بالأرقام</em></h2>
      <p class="sec-sub reveal">أرقام تُثبت ثقة الأسر الجزائرية في منصة مكام</p>
    </div>
    <div class="funfact-grid">
      <div class="ff-card ff-1 reveal">
        <div class="ff-icon-wrap"><i class="bi bi-pencil-fill"></i></div>
        <span class="ff-num" data-count="300" data-suffix="+">0</span>
        <span class="ff-label">تمرين تفاعلي</span>
      </div>
      <div class="ff-card ff-2 reveal">
        <div class="ff-icon-wrap"><i class="bi bi-controller"></i></div>
        <span class="ff-num" data-count="50" data-suffix="+">0</span>
        <span class="ff-label">لعبة تعليمية</span>
      </div>
      <div class="ff-card ff-3 reveal">
        <div class="ff-icon-wrap"><i class="bi bi-award-fill"></i></div>
        <span class="ff-num" data-count="50" data-suffix="+">0</span>
        <span class="ff-label">شارة للكسب</span>
      </div>
      <div class="ff-card ff-4 reveal">
        <div class="ff-icon-wrap"><i class="bi bi-people-fill"></i></div>
        <span class="ff-num" data-count="2000" data-suffix="+">0</span>
        <span class="ff-label">أسرة جزائرية</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════ TESTIMONIALS ══════ -->
<section class="testi-sec" id="about">
  <div class="container">
    <div class="text-center">
      <span class="sec-badge reveal"><i class="bi bi-chat-quote-fill"></i> آراء الأسر</span>
      <h2 class="sec-title reveal">ماذا يقول <em>أولياء الأمور</em>؟</h2>
      <p class="sec-sub reveal">آلاف العائلات الجزائرية تثق في مكام لتعليم أبنائها</p>
    </div>
    <div class="testi-grid">

      <div class="testi-card reveal">
        <div class="testi-quote-icon"><i class="bi bi-quote"></i></div>
        <div class="testi-stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
        <p class="testi-text">منذ انضم ابني لمكام وهو أكثر حباً للمدرسة. الدروس ممتعة جداً والشارات تحفّزه كل يوم على التعلم والتقدم!</p>
        <div class="testi-author">
          <div class="ta-avatar ta-1"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="ta-name">فاطمة بن عمر</div>
            <div class="ta-role">أم لطفل في السنة الثالثة ابتدائي</div>
            <div class="ta-wilaya"><i class="bi bi-geo-alt-fill"></i> وهران</div>
          </div>
        </div>
      </div>

      <div class="testi-card reveal">
        <div class="testi-quote-icon"><i class="bi bi-quote"></i></div>
        <div class="testi-stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
        <p class="testi-text">لوحة المتابعة رائعة! أرى كل يوم ما تعلّمته ابنتي وأين تحتاج للمساعدة. شيء لم أجده في أي منصة أخرى.</p>
        <div class="testi-author">
          <div class="ta-avatar ta-2"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="ta-name">يوسف حمداني</div>
            <div class="ta-role">مهندس وولي أمر</div>
            <div class="ta-wilaya"><i class="bi bi-geo-alt-fill"></i> قسنطينة</div>
          </div>
        </div>
      </div>

      <div class="testi-card reveal">
        <div class="testi-quote-icon"><i class="bi bi-quote"></i></div>
        <div class="testi-stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
        <p class="testi-text">أخيراً منصة جزائرية بمحتوى يناسب منهجنا! أطفالي يتعلمون التاريخ والجغرافيا وهم يلعبون. شكراً مكام!</p>
        <div class="testi-author">
          <div class="ta-avatar ta-3"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="ta-name">نادية مزراق</div>
            <div class="ta-role">معلمة وولية أمر</div>
            <div class="ta-wilaya"><i class="bi bi-geo-alt-fill"></i> البليدة</div>
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
      <div class="cta-main-icon"><i class="bi bi-rocket-takeoff-fill"></i></div>
      <h2 class="cta-title reveal">ابدأ رحلة التعلم <em>اليوم</em> مجاناً!</h2>
      <p class="cta-desc reveal">انضم لآلاف الأسر الجزائرية التي اختارت مكام لمستقبل أبنائها. التسجيل مجاني وسريع في أقل من دقيقتين.</p>
      <div class="cta-btns reveal">
        <a href="/register" class="btn btn-white btn-lg">
          <i class="bi bi-person-plus-fill"></i> سجّل كولي أمر الآن
        </a>
        <a href="/login" class="btn btn-orange btn-lg">
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

<?php require_once __DIR__ . '/site/frontend/includes/footer.php'; ?>
