<?php
require_once __DIR__ . '/../../site/frontend/config/config.php';
$dash_title  = 'نظرة عامة';
$dash_icon   = 'house-fill';
$dash_active = 'home';

require_once __DIR__ . '/../../site/frontend/includes/dashboard/parent/header.php';
?>

<style>
/* ══════════════════════════════════════════
   PARENT DASHBOARD — Beautiful Redesign
   Inspired by index.php warm Algerian style
══════════════════════════════════════════ */

/* ── Page background ── */
.dash-content {
  background: linear-gradient(160deg, #FFF8F0 0%, #FFFCF5 35%, #F2FAF5 70%, #F5F8FF 100%);
  min-height: 100vh;
  padding: 2rem 2rem 3rem;
}

/* ── Blob decorations ── */
.page-blobs { position: fixed; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
.pg-blob {
  position: absolute; border-radius: 50%;
  filter: blur(80px); opacity: .08;
}
.pg-blob-1 { width: 500px; height: 500px; background: var(--orange); top: -150px; right: -100px; animation: blobDrift 12s ease-in-out infinite; }
.pg-blob-2 { width: 380px; height: 380px; background: var(--green); bottom: 100px; left: -80px; animation: blobDrift 15s ease-in-out 3s infinite reverse; }
.pg-blob-3 { width: 260px; height: 260px; background: var(--gold); top: 40%; right: 30%; animation: blobDrift 9s ease-in-out 1.5s infinite; }
@keyframes blobDrift { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-20px) scale(1.05)} }

/* ── Content wrapper (above blobs) ── */
.dash-content > * { position: relative; z-index: 1; }

/* ══ WELCOME HERO BANNER ══ */
.wb-hero {
  background: linear-gradient(135deg, #111C15 0%, #1E3A28 45%, #0F2218 100%);
  border-radius: 24px;
  padding: 0;
  margin-bottom: 2rem;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(17,28,21,.35), 0 4px 16px rgba(0,0,0,.12);
  position: relative;
  animation: slideDown .6s cubic-bezier(.4,0,.2,1);
}
@keyframes slideDown { from{opacity:0;transform:translateY(-20px)} to{opacity:1;transform:none} }

/* Hero blobs inside banner */
.wb-blob { position: absolute; border-radius: 50%; pointer-events: none; filter: blur(50px); }
.wbb-1 { width: 280px; height: 280px; background: rgba(45,122,69,.3); top: -80px; left: -60px; }
.wbb-2 { width: 200px; height: 200px; background: rgba(232,184,48,.2); bottom: -60px; right: 80px; }
.wbb-3 { width: 140px; height: 140px; background: rgba(224,120,36,.18); top: 20px; right: -30px; }

/* Pattern overlay */
.wb-pattern {
  position: absolute; inset: 0; opacity: .04;
  background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-rule='evenodd'%3E%3Ccircle cx='20' cy='20' r='3'/%3E%3C/g%3E%3C/svg%3E");
}

.wb-inner {
  display: grid; grid-template-columns: 1fr auto;
  gap: 2rem; align-items: center;
  padding: 2rem 2.5rem;
  position: relative; z-index: 2;
}
.wb-left {}
.wb-flag-tag {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(232,184,48,.18); border: 1.5px solid rgba(232,184,48,.3);
  color: var(--gold); font-weight: 800; font-size: .8rem;
  padding: .3rem 1rem; border-radius: 50px;
  margin-bottom: 1rem;
}
.wb-flag-tag i { font-size: .9rem; }
.wb-greeting-sub { font-size: .82rem; color: rgba(255,255,255,.45); font-weight: 700; margin-bottom: .3rem; display: flex; align-items: center; gap: .4rem; }
.wb-greeting-sub i { color: var(--gold); }
.wb-name {
  font-size: 2rem; font-weight: 900; color: #fff; line-height: 1.15; margin-bottom: .5rem;
}
.wb-name em {
  background: linear-gradient(135deg, var(--gold), #F59E0B);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  font-style: normal;
}
.wb-tagline { font-size: .88rem; color: rgba(255,255,255,.5); font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: .5rem; }
.wb-tagline i { color: var(--green3); }

.wb-quick-stats {
  display: flex; gap: 1rem; flex-wrap: wrap;
}
.wqs-item {
  background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
  border-radius: 14px; padding: .7rem 1.1rem;
  display: flex; align-items: center; gap: .65rem;
  transition: all .25s ease; cursor: default;
}
.wqs-item:hover { background: rgba(255,255,255,.12); transform: translateY(-2px); }
.wqs-icon { font-size: 1.2rem; }
.wqs-val { font-size: 1.1rem; font-weight: 900; color: #fff; line-height: 1; }
.wqs-lbl { font-size: .7rem; font-weight: 700; color: rgba(255,255,255,.45); margin-top: .1rem; }

.wb-right {
  display: flex; flex-direction: column; align-items: flex-end; gap: 1rem;
}
.wb-actions { display: flex; gap: .75rem; }
.wb-btn {
  display: flex; align-items: center; gap: .5rem;
  padding: .7rem 1.4rem; border-radius: 50px;
  font-family: var(--font); font-size: .86rem; font-weight: 900;
  cursor: pointer; transition: all .25s ease; border: none;
  white-space: nowrap;
}
.wbb-gold { background: linear-gradient(135deg, var(--gold), #F59E0B); color: #333; box-shadow: 0 4px 18px rgba(232,184,48,.35); }
.wbb-gold:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(232,184,48,.45); }
.wbb-ghost { background: rgba(255,255,255,.1); color: rgba(255,255,255,.8); border: 1.5px solid rgba(255,255,255,.18); }
.wbb-ghost:hover { background: rgba(255,255,255,.18); }

/* Welcome banner bottom strip */
.wb-strip {
  background: rgba(255,255,255,.04); border-top: 1px solid rgba(255,255,255,.07);
  padding: .75rem 2.5rem;
  display: flex; align-items: center; gap: 2rem;
  position: relative; z-index: 2; flex-wrap: wrap;
}
.wbs-item {
  display: flex; align-items: center; gap: .45rem;
  font-size: .78rem; font-weight: 700; color: rgba(255,255,255,.5);
}
.wbs-item i { font-size: .85rem; }
.wbs-item.green i { color: var(--green3); }
.wbs-item.gold i { color: var(--gold); }
.wbs-item.orange i { color: var(--orange); }

/* ══ STATS BAND ══ */
.stats-band {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 1.2rem; margin-bottom: 2rem;
}
.sband-card {
  background: rgba(255, 255, 255, 0.6);
  border-radius: 20px;
  padding: 1.5rem 1.4rem;
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 4px 24px rgba(224,120,36,.08), 0 1px 4px rgba(0,0,0,.04);
  display: flex; flex-direction: column; gap: .8rem;
  transition: all .3s cubic-bezier(.4,0,.2,1);
  animation: riseUp .5s ease both;
  position: relative; overflow: hidden;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.sband-card::before {
  content: ''; position: absolute;
  bottom: 0; left: 0; right: 0; height: 3px;
  border-radius: 0 0 20px 20px;
  transform: scaleX(0); transition: transform .3s ease; transform-origin: right;
}
.sband-card:hover::before { transform: scaleX(1); }
.sband-card:hover { transform: translateY(-5px); box-shadow: 0 16px 48px rgba(0,0,0,.1); background: rgba(255, 255, 255, 0.8); }
.sband-card:nth-child(1)::before { background: var(--green); }
.sband-card:nth-child(2)::before { background: var(--orange); }
.sband-card:nth-child(3)::before { background: var(--gold2); }
.sband-card:nth-child(4)::before { background: #7C3AED; }
@keyframes riseUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:none} }

.sbc-top { display: flex; align-items: flex-start; justify-content: space-between; }
.sbc-icon {
  width: 52px; height: 52px; border-radius: 16px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem; flex-shrink: 0;
  transition: transform .3s ease;
}
.sband-card:hover .sbc-icon { transform: scale(1.12) rotate(-6deg); }
.sbc-trend {
  font-size: .7rem; font-weight: 900; padding: .2rem .55rem;
  border-radius: 50px; display: flex; align-items: center; gap: .2rem;
}
.sbc-num {
  font-size: 2.4rem; font-weight: 900; line-height: 1; margin-bottom: .15rem;
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.sbc-label { font-size: .78rem; font-weight: 700; color: var(--gray-500); }
.sbc-sub { font-size: .7rem; color: var(--gray-400); font-weight: 600; display: flex; align-items: center; gap: .3rem; }

/* ══ SECTION HEADER ══ */
.sec-band {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.3rem;
}
.sec-badge-new {
  display: inline-flex; align-items: center; gap: .4rem;
  background: var(--green-pale); color: var(--green);
  font-weight: 800; font-size: .8rem; padding: .3rem .9rem;
  border-radius: 50px; border: 1.5px solid rgba(45,122,69,.18);
}
.sec-badge-new i { font-size: .9rem; }
.sec-h2 { font-size: 1.05rem; font-weight: 900; color: var(--gray-800); display: flex; align-items: center; gap: .5rem; margin-bottom: .15rem; }
.sec-h2 i { font-size: 1.1rem; }
.sec-hint { font-size: .78rem; color: var(--gray-400); font-weight: 600; }
.sec-add-btn {
  display: flex; align-items: center; gap: .45rem;
  padding: .55rem 1.2rem; border-radius: 50px;
  font-size: .82rem; font-weight: 900; font-family: var(--font);
  background: linear-gradient(135deg, var(--green), var(--green2));
  color: #fff; border: none; cursor: pointer;
  box-shadow: 0 4px 16px rgba(45,122,69,.25);
  transition: all .25s ease;
}
.sec-add-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(45,122,69,.35); }

/* ══ CHILD TABS ══ */
.child-tabs {
  display: flex; align-items: center; gap: .6rem;
  margin-bottom: 1.2rem; flex-wrap: wrap;
}
.child-tab {
  display: flex; align-items: center; gap: .45rem;
  padding: .45rem 1.1rem; border-radius: 50px;
  border: 2px solid var(--gray-200); background: var(--white);
  cursor: pointer; font-size: .84rem; font-weight: 800;
  color: var(--gray-500); transition: all .25s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,.04);
}
.child-tab:hover { border-color: var(--green); color: var(--green); background: var(--green-xpale); transform: translateY(-2px); }
.child-tab.active {
  background: linear-gradient(135deg, var(--green), var(--green2));
  border-color: transparent; color: #fff;
  box-shadow: 0 6px 20px rgba(45,122,69,.3);
}
.child-tab-dot { width: 8px; height: 8px; border-radius: 50%; }
.child-tab.active .child-tab-dot { background: rgba(255,255,255,.6); }
.child-tab-add {
  border-style: dashed !important; color: var(--gray-400) !important;
}
.child-tab-add:hover {
  border-color: var(--gold) !important; color: var(--gold2) !important;
  background: var(--gold-pale) !important;
}

/* ══ CHILD PANELS ══ */
.child-panel { display: none; animation: fadeUp .35s ease; }
.child-panel.active { display: flex; flex-direction: column; gap: 1.2rem; }

/* ══ CHILD HERO CARD ══ */
.child-hero-card {
  background: rgba(255, 255, 255, 0.6); border-radius: 22px;
  overflow: hidden;
  box-shadow: 0 8px 36px rgba(0,0,0,.08), 0 2px 8px rgba(0,0,0,.04);
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  transition: box-shadow .3s ease;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.child-hero-card:hover { box-shadow: 0 16px 52px rgba(0,0,0,.12); background: rgba(255, 255, 255, 0.8); }

.chc-header {
  padding: 1.8rem 2rem;
  display: flex; align-items: center; gap: 1.3rem;
  flex-wrap: wrap; position: relative; overflow: hidden;
}
.chc-header::after {
  content: ''; position: absolute; top: -40px; left: -40px;
  width: 200px; height: 200px; border-radius: 50%;
  background: rgba(255,255,255,.06); pointer-events: none;
}
.chc-avatar {
  width: 68px; height: 68px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.8rem; font-weight: 900; color: #fff;
  border: 3px solid rgba(255,255,255,.35);
  box-shadow: 0 8px 24px rgba(0,0,0,.2);
}
.chc-info { flex: 1; min-width: 140px; position: relative; z-index: 1; }
.chc-name { font-size: 1.35rem; font-weight: 900; color: #fff; margin-bottom: .3rem; }
.chc-meta {
  font-size: .82rem; color: rgba(255,255,255,.72);
  font-weight: 700; display: flex; align-items: center; gap: .5rem; flex-wrap: wrap;
}
.chc-meta-sep { opacity: .5; }
.chc-perks { display: flex; align-items: center; gap: .8rem; margin-top: .6rem; flex-wrap: wrap; }
.chc-perk {
  display: flex; align-items: center; gap: .3rem;
  font-size: .76rem; font-weight: 800; color: rgba(255,255,255,.65);
  background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
  padding: .2rem .65rem; border-radius: 50px;
}
.chc-perk i { font-size: .8rem; }
.chc-right { display: flex; flex-direction: column; align-items: flex-end; gap: .8rem; flex-shrink: 0; position: relative; z-index: 1; }
.chc-badge {
  display: flex; align-items: center; gap: .35rem;
  padding: .3rem .9rem; border-radius: 50px; font-size: .76rem; font-weight: 900;
}
.chcb-online { background: rgba(255,255,255,.2); color: #fff; border: 1px solid rgba(255,255,255,.3); }
.chcb-offline { background: rgba(0,0,0,.15); color: rgba(255,255,255,.55); }
.chc-prog-wrap { min-width: 160px; }
.chc-prog-label {
  display: flex; justify-content: space-between;
  font-size: .73rem; font-weight: 800; color: rgba(255,255,255,.65); margin-bottom: .35rem;
}
.chc-pct { color: #fff; font-weight: 900; }
.chc-prog-bar { height: 7px; border-radius: 50px; background: rgba(255,255,255,.18); overflow: hidden; }
.chc-prog-fill { height: 100%; border-radius: 50px; background: rgba(255,255,255,.85); width: 0; transition: width 1.2s ease; }
.chc-tasks { font-size: .7rem; color: rgba(255,255,255,.5); font-weight: 700; text-align: center; margin-top: .25rem; }

/* Body subjects */
.chc-body { padding: 1.5rem 2rem; }
.chc-subj-label {
  font-size: .72rem; font-weight: 900; letter-spacing: .1em;
  color: var(--gray-400); text-transform: uppercase;
  margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem;
}
.chc-subj-label::after { content: ''; flex: 1; height: 1.5px; background: var(--gray-100); }

.subj-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.subj-card {
  background: var(--gray-50); border: 1.5px solid var(--gray-200);
  border-radius: 16px; padding: 1.1rem;
  cursor: pointer; transition: all .28s ease;
  display: flex; flex-direction: column; gap: .55rem;
}
.subj-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 36px rgba(0,0,0,.1);
  border-color: rgba(0,0,0,.1); background: var(--white);
}
.subj-top { display: flex; align-items: flex-start; justify-content: space-between; }
.subj-icon {
  width: 44px; height: 44px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.15rem; color: #fff; flex-shrink: 0;
}
.subj-cnt {
  font-size: .68rem; font-weight: 900; background: var(--gray-200);
  color: var(--gray-500); padding: .18rem .55rem; border-radius: 50px;
}
.subj-name { font-size: .96rem; font-weight: 900; color: var(--gray-800); }
.subj-en { font-size: .7rem; color: var(--gray-400); font-weight: 600; direction: ltr; text-align: right; line-height: 1.35; }
.subj-prog-bar { height: 4px; border-radius: 50px; background: var(--gray-200); overflow: hidden; }
.subj-prog-fill { height: 100%; border-radius: 50px; width: 0; transition: width 1.2s ease; }
.subj-pct { font-size: .69rem; color: var(--gray-400); font-weight: 800; }
.chc-subj-empty { text-align: center; padding: 2rem; color: var(--gray-400); font-size: .84rem; font-weight: 700; }

/* ══ ADD CHILD CTA ══ */
.add-child-cta {
  background: linear-gradient(135deg, var(--gold-pale), #FFFBEC);
  border: 2px dashed rgba(232,184,48,.4); border-radius: 20px;
  padding: 1.3rem 1.5rem;
  display: flex; align-items: center; gap: 1rem;
  cursor: pointer; transition: all .3s ease;
  margin-top: .5rem;
}
.add-child-cta:hover {
  border-color: var(--gold); background: #FFF5CC;
  transform: translateY(-3px); box-shadow: 0 12px 36px rgba(232,184,48,.2);
}
.acc-circle {
  width: 50px; height: 50px; border-radius: 50%; flex-shrink: 0;
  background: linear-gradient(135deg, var(--gold), #F59E0B);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.4rem; color: #333;
  box-shadow: 0 6px 18px rgba(232,184,48,.4);
}
.acc-title { font-size: .94rem; font-weight: 900; color: var(--gray-700); margin-bottom: .15rem; }
.acc-sub { font-size: .77rem; color: var(--gray-500); font-weight: 700; }
.acc-arrow { margin-right: auto; font-size: 1.5rem; color: var(--gold2); transition: transform .25s ease; }
.add-child-cta:hover .acc-arrow { transform: translateX(-4px); }

/* ══ MAIN GRID ══ */
.dash-grid { display: grid; grid-template-columns: 1fr 350px; gap: 1.8rem; align-items: start; }

/* ══ SIDEBAR WIDGETS ══ */
.dash-right { display: flex; flex-direction: column; gap: 1.4rem; }

.widget {
  background: rgba(255, 255, 255, 0.6); border-radius: 20px;
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 4px 24px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.03);
  overflow: hidden;
  animation: riseUp .5s ease both;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.widget-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 1.3rem; border-bottom: 1.5px solid var(--gray-100);
}
.wh-title { font-size: .9rem; font-weight: 900; color: var(--gray-700); display: flex; align-items: center; gap: .5rem; }
.wh-title i { font-size: 1rem; }
.wh-badge {
  font-size: .68rem; font-weight: 900; padding: .2rem .65rem;
  border-radius: 50px;
}
.wh-red { background: var(--red-pale); color: var(--red); }
.wh-green { background: var(--green-pale); color: var(--green); }
.wh-gold { background: var(--gold-pale); color: var(--gold2); }

/* Empty state */
.req-empty {
  padding: 1.8rem; text-align: center;
  font-size: .83rem; color: var(--gray-400); font-weight: 700;
}
.req-empty i { font-size: 2rem; display: block; margin-bottom: .5rem; opacity: .25; }

/* Session items */
.sess-item {
  display: flex; align-items: center; gap: .8rem;
  padding: .85rem 1.3rem; border-bottom: 1.5px solid var(--gray-100);
  transition: background .2s;
}
.sess-item:last-child { border-bottom: none; }
.sess-item:hover { background: var(--green-xpale); }
.sess-avatar {
  width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-size: 1rem; font-weight: 900;
}
.sess-info { flex: 1; min-width: 0; }
.sess-name { font-size: .88rem; font-weight: 900; color: var(--gray-800); margin-bottom: .15rem; }
.sess-time { display: flex; align-items: center; gap: .3rem; font-size: .73rem; font-weight: 700; color: var(--gray-400); }
.sess-online-dot {
  width: 8px; height: 8px; border-radius: 50%; background: var(--green);
  display: inline-block; animation: pulseGreen 1.6s ease-in-out infinite; flex-shrink: 0;
}
@keyframes pulseGreen { 0%,100%{box-shadow:0 0 0 0 rgba(45,122,69,.5)} 70%{box-shadow:0 0 0 5px rgba(45,122,69,0)} }
.sess-pin {
  display: flex; align-items: center; gap: .3rem;
  background: var(--gold-pale); border: 1.5px solid rgba(232,184,48,.3);
  border-radius: 10px; padding: .3rem .6rem;
  font-size: .73rem; font-weight: 800; color: var(--gold2); flex-shrink: 0;
}
.sess-pin i { font-size: .82rem; }
.sess-pin-val, .sess-pin-real { letter-spacing: .08em; }
.sess-eye {
  background: none; border: none; cursor: pointer; padding: 0;
  color: var(--gold2); display: flex; align-items: center; font-size: .82rem;
  transition: color .2s;
}
.sess-eye:hover { color: var(--orange2); }

/* Activity feed */
.activity-list { padding: .4rem 0; }
.act-item {
  display: flex; align-items: flex-start; gap: .75rem;
  padding: .8rem 1.3rem; border-bottom: 1px solid var(--gray-100);
}
.act-item:last-child { border-bottom: none; }
.act-dot {
  width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center; font-size: .88rem;
}
.act-text { font-size: .8rem; color: var(--gray-600); font-weight: 700; line-height: 1.5; }
.act-text strong { color: var(--gray-800); display: block; font-size: .83rem; margin-bottom: .1rem; }
.act-time { font-size: .67rem; color: var(--gray-400); font-weight: 600; margin-top: .2rem; }

/* ══ CREDENTIALS WIDGET ══ */
.cred-loading { padding: 1.5rem; text-align: center; font-size: .82rem; color: var(--gray-400); font-weight: 700; }
.cred-loading i { font-size: 1.6rem; display: block; margin-bottom: .4rem; opacity: .3; }
.cred-child-card { padding: 1rem 1.3rem; border-bottom: 1.5px solid var(--gray-100); animation: fadeUp .3s ease; }
.cred-child-card:last-child { border-bottom: none; }
.cred-child-header { display: flex; align-items: center; gap: .65rem; margin-bottom: .85rem; }
.cred-avatar {
  width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; font-weight: 900; color: #fff;
  background: linear-gradient(135deg, var(--green), var(--green2));
  box-shadow: 0 3px 12px rgba(45,122,69,.25);
}
.cred-child-name { font-size: .9rem; font-weight: 900; color: var(--gray-800); }
.cred-child-age { font-size: .72rem; color: var(--gray-400); font-weight: 700; margin-top: .05rem; }
.cred-fields { display: flex; flex-direction: column; gap: .55rem; }
.cred-field {
  background: var(--gray-50); border: 1.5px solid var(--gray-200);
  border-radius: 12px; padding: .65rem .9rem;
  display: flex; align-items: center; justify-content: space-between; gap: .5rem;
}
.cred-field-label { font-size: .67rem; font-weight: 900; letter-spacing: .05em; text-transform: uppercase; margin-bottom: .18rem; }
.cred-field-label.lbl-user { color: var(--green); }
.cred-field-label.lbl-pass { color: var(--orange2); }
.cred-field-val {
  font-size: .85rem; font-weight: 800; color: var(--gray-800);
  direction: ltr; text-align: right; letter-spacing: .03em; user-select: all;
}
.cred-field-val.pass-hidden { letter-spacing: .12em; color: var(--gray-400); font-size: .7rem; }
.cred-field-actions { display: flex; align-items: center; gap: .35rem; flex-shrink: 0; }
.cred-btn {
  width: 30px; height: 30px; border-radius: 9px; border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center; font-size: .82rem;
  transition: all .22s ease;
}
.cred-btn-copy { background: var(--green-pale); color: var(--green); }
.cred-btn-copy:hover { background: var(--green); color: #fff; transform: scale(1.1); }
.cred-btn-eye { background: var(--orange-pale); color: var(--orange2); }
.cred-btn-eye:hover { background: var(--orange); color: #fff; transform: scale(1.1); }
.cred-tip {
  margin: .5rem 1.3rem .75rem;
  background: linear-gradient(135deg, #F0FFF6, #E8F9EF);
  border: 1px solid rgba(45,122,69,.15); border-radius: 10px;
  padding: .55rem .8rem; font-size: .72rem; font-weight: 700;
  color: var(--green); display: flex; align-items: center; gap: .4rem;
}

/* ══ PROMO WIDGET ══ */
.promo-widget {
  background: linear-gradient(145deg, #111C15 0%, #1E3A28 60%, #243B2A 100%);
  border-radius: 20px; padding: 1.5rem 1.4rem;
  position: relative; overflow: hidden;
  box-shadow: 0 12px 36px rgba(0,0,0,.18);
  border: 1.5px solid rgba(255,255,255,.06);
}
.pw-deco { position: absolute; border-radius: 50%; pointer-events: none; }
.pw-deco1 { width: 120px; height: 120px; background: rgba(255,255,255,.04); top: -35px; left: -35px; }
.pw-deco2 { width: 80px; height: 80px; background: rgba(232,184,48,.08); bottom: -25px; right: -15px; }
.pw-badge {
  display: inline-flex; align-items: center; gap: .35rem;
  background: var(--gold); color: #333; font-size: .7rem; font-weight: 900;
  padding: .22rem .7rem; border-radius: 50px; margin-bottom: .8rem;
}
.pw-title { font-size: 1rem; font-weight: 900; color: #fff; margin-bottom: .5rem; line-height: 1.3; position: relative; z-index: 1; }
.pw-desc { font-size: .78rem; color: rgba(255,255,255,.58); line-height: 1.65; margin-bottom: .9rem; position: relative; z-index: 1; }
.pw-quote {
  background: rgba(255,255,255,.07); border-radius: 10px;
  padding: .6rem .85rem; font-size: .75rem; font-style: italic;
  color: rgba(255,255,255,.72); border-right: 3px solid var(--gold);
  margin-bottom: .9rem; line-height: 1.6; position: relative; z-index: 1;
}
.pw-btn {
  display: flex; align-items: center; justify-content: center; gap: .45rem;
  background: linear-gradient(135deg, var(--gold), #F59E0B);
  color: #333; border: none; border-radius: 12px;
  padding: .65rem; font-family: var(--font); font-size: .84rem; font-weight: 900;
  cursor: pointer; width: 100%; transition: all .25s ease; position: relative; z-index: 1;
}
.pw-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(232,184,48,.4); }

/* ══ TOAST ══ */
.toast-wrap { position: fixed; bottom: 1.5rem; left: 50%; transform: translateX(-50%); z-index: 9999; display: flex; flex-direction: column; gap: .5rem; pointer-events: none; }
.toast {
  background: var(--gray-800); color: #fff; font-family: var(--font);
  font-size: .85rem; font-weight: 700; padding: .75rem 1.4rem;
  border-radius: 50px; box-shadow: 0 8px 28px rgba(0,0,0,.2);
  display: flex; align-items: center; gap: .55rem;
  animation: toastIn .3s ease; white-space: nowrap;
}
.toast.green { background: linear-gradient(135deg, var(--green), var(--green2)); }
.toast.orange { background: linear-gradient(135deg, var(--orange2), var(--orange)); }
.toast.gold { background: linear-gradient(135deg, var(--gold2), var(--gold)); color: #333; }
@keyframes toastIn { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:none} }

/* ══ RESPONSIVE ══ */
@media(max-width:1100px) {
  .dash-grid { grid-template-columns: 1fr; }
  .stats-band { grid-template-columns: repeat(2, 1fr); }
  .wb-inner { grid-template-columns: 1fr; }
  .wb-right { align-items: flex-start; }
}
@media(max-width:640px) {
  .dash-content { padding: 1rem; }
  .subj-grid { grid-template-columns: 1fr; }
  .stats-band { grid-template-columns: repeat(2, 1fr); }
  .wb-actions { flex-wrap: wrap; }
}

@keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:none} }
</style>

<!-- ════════ BLOB DECORATIONS ════════ -->
<div class="page-blobs">
  <div class="pg-blob pg-blob-1"></div>
  <div class="pg-blob pg-blob-2"></div>
  <div class="pg-blob pg-blob-3"></div>
</div>

<!-- ════════ WELCOME HERO ════════ -->
<div class="wb-hero">
  <div class="wb-blob wbb-1"></div>
  <div class="wb-blob wbb-2"></div>
  <div class="wb-blob wbb-3"></div>
  <div class="wb-pattern"></div>

  <div class="wb-inner">
    <div class="wb-left">
      <div class="wb-flag-tag">
        <i class="bi bi-flag-fill"></i>
        منصة مقام الجزائرية
      </div>
      <div class="wb-greeting-sub"><i class="bi bi-sun-fill"></i> مرحباً بك في لوحة التحكم</div>
      <div class="wb-name" id="wbParentName">
        ولي الأمر
      </div>
      <div class="wb-tagline" id="wbSub">
        <i class="bi bi-info-circle-fill"></i>
        جاري تحميل البيانات...
      </div>
      <div class="wb-quick-stats">
        <div class="wqs-item">
          <span class="wqs-icon" style="color:var(--green3)"><i class="bi bi-people-fill"></i></span>
          <div>
            <div class="wqs-val" id="statChildren">—</div>
            <div class="wqs-lbl">طفل مسجّل</div>
          </div>
        </div>
        <div class="wqs-item">
          <span class="wqs-icon" style="color:var(--gold)"><i class="bi bi-trophy-fill"></i></span>
          <div>
            <div class="wqs-val" id="statBadges">0</div>
            <div class="wqs-lbl">شارات مكتسبة</div>
          </div>
        </div>
        <div class="wqs-item">
          <span class="wqs-icon" style="color:var(--orange)"><i class="bi bi-graph-up-arrow"></i></span>
          <div>
            <div class="wqs-val" id="statProgress">0%</div>
            <div class="wqs-lbl">متوسط التقدم</div>
          </div>
        </div>
      </div>
    </div>
    <div class="wb-right">
      <div class="wb-actions">
        <button class="wb-btn wbb-gold" onclick="openAddChildModal()">
          <i class="bi bi-person-plus-fill"></i> إضافة طفل
        </button>
        <button class="wb-btn wbb-ghost" onclick="showToast('التقارير قريباً!','green')">
          <i class="bi bi-file-earmark-text-fill"></i> التقارير
        </button>
      </div>
    </div>
  </div>

  <div class="wb-strip">
    <div class="wbs-item green"><i class="bi bi-shield-fill-check"></i> حماية الأطفال نشطة</div>
    <div class="wbs-item gold"><i class="bi bi-bell-fill"></i> <span id="statReqs">0</span> طلبات معلّقة</div>
    <div class="wbs-item orange"><i class="bi bi-lightning-fill"></i> منصة مقام — تعليم جزائري ١٠٠٪</div>
  </div>
</div>

<!-- ════════ MAIN GRID ════════ -->
<div class="dash-grid">

  <!-- ══ LEFT: Children ══ -->
  <div>
    <div class="sec-band" id="childrenSection">
      <div>
        <div class="sec-h2">
          <i class="bi bi-people-fill" style="color:var(--green)"></i> ملفات أطفالي
        </div>
        <div class="sec-hint">إدارة ومتابعة تعلّم أطفالك</div>
      </div>
      <button class="sec-add-btn" onclick="openAddChildModal()">
        <i class="bi bi-plus-lg"></i> إضافة طفل
      </button>
    </div>

    <!-- Child Tabs -->
    <div class="child-tabs" id="childTabs">
      <div class="child-tab" style="color:var(--gray-400);pointer-events:none">
        <i class="bi bi-hourglass-split"></i> جاري التحميل...
      </div>
    </div>

    <!-- Child Panels -->
    <div id="childPanelsWrap">
      <div style="padding:3rem 1rem;text-align:center;color:var(--gray-400);font-weight:700">
        <i class="bi bi-hourglass-split" style="font-size:2.5rem;display:block;margin-bottom:.6rem;opacity:.2"></i>
        جاري تحميل ملفات الأطفال...
      </div>
    </div>

    <!-- Add child CTA -->
    <div class="add-child-cta" onclick="openAddChildModal()">
      <div class="acc-circle"><i class="bi bi-person-plus-fill"></i></div>
      <div>
        <div class="acc-title">إضافة طفل جديد</div>
        <div class="acc-sub">يمكنك إدارة عدة أطفال من نفس الحساب</div>
      </div>
      <i class="bi bi-arrow-left-short acc-arrow"></i>
    </div>
  </div>

  <!-- ══ RIGHT: Sidebar Widgets ══ -->
  <div class="dash-right">

    <!-- Child Login Activity -->
    <div class="widget">
      <div class="widget-head">
        <div class="wh-title" style="color:var(--green)">
          <i class="bi bi-activity"></i> نشاط دخول الأطفال
        </div>
        <span class="wh-badge wh-green" id="onlineBadge" style="display:none">متصل</span>
      </div>
      <div id="sessionList">
        <div class="req-empty"><i class="bi bi-arrow-clockwise"></i> جاري التحميل...</div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="widget">
      <div class="widget-head">
        <div class="wh-title"><i class="bi bi-clock-history" style="color:var(--blue)"></i> آخر النشاطات</div>
        <span class="wh-badge wh-green">اليوم</span>
      </div>
      <div class="activity-list">
        <div class="act-item">
          <div class="act-dot" style="background:var(--green-pale)"><i class="bi bi-star-fill" style="color:var(--green)"></i></div>
          <div>
            <div class="act-text"><strong>أمين — أكمل درساً جديداً</strong> وحدة الجزائر · الدرس الأول</div>
            <div class="act-time">منذ 30 دقيقة</div>
          </div>
        </div>
        <div class="act-item">
          <div class="act-dot" style="background:var(--orange-pale)"><i class="bi bi-trophy-fill" style="color:var(--orange)"></i></div>
          <div>
            <div class="act-text"><strong>سارة — حصلت على شارة جديدة</strong> شارة "النجم الصاعد"</div>
            <div class="act-time">منذ 3 ساعات</div>
          </div>
        </div>
        <div class="act-item">
          <div class="act-dot" style="background:#F3F0FF"><i class="bi bi-lightning-fill" style="color:#7C3AED"></i></div>
          <div>
            <div class="act-text"><strong>سارة — أتمت وحدة بشار</strong> 8/8 دروس مكتملة ✓</div>
            <div class="act-time">أمس الساعة 18:30</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Credentials widget -->
    <div class="widget">
      <div class="widget-head">
        <div class="wh-title" style="color:var(--orange2)">
          <i class="bi bi-key-fill"></i> بيانات دخول الأطفال
        </div>
        <span class="wh-badge wh-gold" id="credBadge">0</span>
      </div>
      <div id="credList">
        <div class="cred-loading"><i class="bi bi-arrow-clockwise"></i> جاري التحميل...</div>
      </div>
    </div>

    <!-- Promo -->
    <div class="promo-widget">
      <div class="pw-deco pw-deco1"></div>
      <div class="pw-deco pw-deco2"></div>
      <div class="pw-badge"><i class="bi bi-gift-fill"></i> عرض خاص</div>
      <div class="pw-title">حزمة المكتشف الصغير</div>
      <div class="pw-desc">احصل على خصم 50% على كتب التلوين التفاعلية للهقار</div>
      <div class="pw-quote">"تعلّم تاريخ الجزائر من خلال اللعب والقصص المصورة الممتعة"</div>
      <button class="pw-btn" onclick="showToast('المتجر سيكون متاحاً قريباً!','green')">
        <i class="bi bi-bag-fill"></i> اكتشف العرض
      </button>
    </div>

  </div>
</div>

<!-- Toast container -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ══ Toast system ══ */
function showToast(msg, type){
  type = type || 'default';
  var wrap = document.getElementById('toastWrap');
  var t = document.createElement('div');
  t.className = 'toast ' + type;
  var icons = {green:'bi-check-circle-fill', orange:'bi-exclamation-circle-fill', gold:'bi-star-fill', default:'bi-info-circle-fill'};
  t.innerHTML = '<i class="bi ' + (icons[type]||icons.default) + '"></i> ' + msg;
  wrap.appendChild(t);
  setTimeout(function(){ t.style.opacity='0'; t.style.transform='translateY(10px)'; t.style.transition='all .3s ease'; setTimeout(function(){ t.remove(); },300); }, 2800);
}

/* ══ المواد الدراسية المتاحة ══ */
var MAKAM_SUBJECTS = [
  {name:'الرياضيات',       icon:'bi-calculator-fill', color:'#4F46E5', en:'Mathematics'},
  {name:'التاريخ الجزائري', icon:'bi-flag-fill',      color:'#006233', en:'Algerian History'},
];

var _childrenData = [];
var _currentChild = 0;

document.addEventListener('DOMContentLoaded', function(){
  loadDashboard();
  loadChildSessions();
  setInterval(loadChildSessions, 10000);
});

/* ══════════════════════════════
   تحميل الداشبورد الكامل
══════════════════════════════ */
function loadDashboard(){
  var user = null;
  try { user = JSON.parse(sessionStorage.getItem('makam_user') || 'null'); } catch(e){}

  if(user && user.fname){
    document.getElementById('wbParentName').innerHTML =
      user.fname + ' ' + (user.lname||'');
  } else {
    document.getElementById('wbParentName').innerHTML = 'ولي الأمر';
  }

  var pid = user ? (user.id || '') : '';
  if(!pid){
    document.getElementById('wbSub').innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> سجّل الدخول لرؤية بياناتك';
    document.getElementById('statChildren').textContent = '0';
    renderChildrenEmpty('لا يوجد حساب — الرجاء تسجيل الدخول');
    loadChildrenCredentials();
    return;
  }

  fetch('/api/auth_children?parent_id=' + encodeURIComponent(pid))
  .then(function(r){ return r.json(); })
  .then(function(res){
    var kids = (res.ok && res.data.children) ? res.data.children : [];
    _childrenData = kids;

    document.getElementById('statChildren').textContent = kids.length;
    document.getElementById('statBadges').textContent   = kids.length;
    document.getElementById('wbSub').innerHTML =
      '<i class="bi bi-info-circle-fill"></i> لديك ' + kids.length + ' ' + (kids.length===1?'طفل مسجل':'أطفال مسجلين') +
      ' — انتظر طلبات الدخول في القائمة الجانبية';

    if(!kids.length){
      renderChildrenEmpty('لا يوجد أطفال مسجلون بعد — أضف طفلك الأول!');
    } else {
      renderChildrenTabs(kids);
      renderChildrenPanels(kids);
      setTimeout(function(){
        document.querySelectorAll('[data-prog]').forEach(function(el){
          el.style.width = el.dataset.prog;
        });
      }, 400);
    }

    loadChildrenCredentials();
  })
  .catch(function(){
    renderChildrenEmpty('تعذّر تحميل البيانات — تحقق من الاتصال');
    loadChildrenCredentials();
  });
}

/* ── رسم التابات ── */
function renderChildrenTabs(kids){
  var colors = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];
  var html = '';
  kids.forEach(function(kid, i){
    var c = colors[i % colors.length];
    html += '<div class="child-tab' + (i===0?' active':'') + '" onclick="switchChild(' + i + ')">' +
      '<span class="child-tab-dot" style="background:' + (i===0?'rgba(255,255,255,.6)':c) + '"></span>' +
      kid.fname +
    '</div>';
  });
  html += '<div class="child-tab child-tab-add" onclick="openAddChildModal()">' +
    '<i class="bi bi-plus-lg" style="font-size:.85rem"></i> إضافة' +
  '</div>';
  document.getElementById('childTabs').innerHTML = html;
}

/* ── رسم البانلات ── */
var _sessionMap = {};

function renderChildrenPanels(kids){
  var colors  = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];
  var badges  = ['🌱','⭐','🏅','🏆'];
  var levels  = ['مبتدئ','نجم صاعد','متعلم مثابر','بطل الجزائر'];
  var html = '';

  kids.forEach(function(kid, i){
    var color = colors[i % colors.length];
    var badge = badges[0];
    var level = levels[0];
    var init  = kid.fname.charAt(0);

    var subjHtml = '';
    MAKAM_SUBJECTS.forEach(function(subj){
      subjHtml +=
        '<div class="subj-card" onclick="showToast(\'مادة ' + subj.name + ' ستكون متاحة قريباً!\',\'green\')">' +
          '<div class="subj-top">' +
            '<div class="subj-icon" style="background:' + subj.color + '"><i class="bi ' + subj.icon + '"></i></div>' +
            '<span class="subj-cnt">0/8</span>' +
          '</div>' +
          '<div class="subj-name">' + subj.name + '</div>' +
          '<div class="subj-en">' + subj.en + '</div>' +
          '<div class="subj-prog-bar">' +
            '<div class="subj-prog-fill" data-prog="0%" style="background:' + subj.color + '"></div>' +
          '</div>' +
          '<div class="subj-pct"><strong>0%</strong> نسبة الإنجاز</div>' +
        '</div>';
    });

    var joinDate = '';
    if(kid.created_at){
      var d = new Date(kid.created_at);
      joinDate = 'انضم ' + d.toLocaleDateString('ar-DZ',{year:'numeric',month:'long',day:'numeric'});
    }

    html +=
      '<div class="child-panel' + (i===0?' active':'') + '" id="childPanel' + i + '">' +
        '<div class="child-hero-card">' +

          '<div class="chc-header" style="background:linear-gradient(135deg,' + color + ' 0%,' + color + 'BB 100%)">' +
            '<div class="chc-avatar">' + init + '</div>' +
            '<div class="chc-info">' +
              '<div class="chc-name">' + kid.fname + ' ' + kid.lname + ' ' + badge + '</div>' +
              '<div class="chc-meta">' +
                '<span>' + kid.age + ' سنوات</span>' +
                '<span class="chc-meta-sep">•</span>' +
                '<span>مستوى: ' + level + '</span>' +
                '<span class="chc-meta-sep">•</span>' +
                '<span>@' + kid.username + '</span>' +
              '</div>' +
              '<div class="chc-perks">' +
                '<div class="chc-perk"><i class="bi bi-shield-fill-check"></i> حماية نشطة</div>' +
                (joinDate ? '<div class="chc-perk"><i class="bi bi-calendar3-fill"></i> ' + joinDate + '</div>' : '') +
              '</div>' +
            '</div>' +
            '<div class="chc-right">' +
              '<div class="chc-badge" id="statusBadge-' + kid.id + '" style="background:rgba(0,0,0,.18);color:rgba(255,255,255,.55)">' +
                '<i class="bi bi-circle-fill" style="font-size:.42rem"></i> غير متصل' +
              '</div>' +
              '<div class="chc-prog-wrap">' +
                '<div class="chc-prog-label">' +
                  '<span>التقدم الإجمالي</span>' +
                  '<span class="chc-pct">0%</span>' +
                '</div>' +
                '<div class="chc-prog-bar">' +
                  '<div class="chc-prog-fill" data-prog="0%"></div>' +
                '</div>' +
                '<div class="chc-tasks">لم يبدأ التعلم بعد</div>' +
              '</div>' +
            '</div>' +
          '</div>' +

          '<div class="chc-body">' +
            '<div class="chc-subj-label"><i class="bi bi-grid-3x2-gap-fill"></i> المواد الدراسية المتاحة</div>' +
            '<div class="subj-grid">' + subjHtml + '</div>' +
          '</div>' +

        '</div>' +
      '</div>';
  });

  document.getElementById('childPanelsWrap').innerHTML = html;
}

/* ── لا يوجد أطفال ── */
function renderChildrenEmpty(msg){
  document.getElementById('childTabs').innerHTML =
    '<div class="child-tab child-tab-add" onclick="openAddChildModal()">' +
      '<i class="bi bi-plus-lg" style="font-size:.85rem"></i> إضافة' +
    '</div>';
  document.getElementById('childPanelsWrap').innerHTML =
    '<div style="padding:3rem 1rem;text-align:center;color:var(--gray-400);font-weight:700">' +
      '<i class="bi bi-people" style="font-size:3rem;display:block;margin-bottom:.7rem;opacity:.2"></i>' +
      msg +
    '</div>';
}

/* ── التبديل بين الأطفال ── */
function switchChild(idx){
  _currentChild = idx;
  var tabs = document.querySelectorAll('#childTabs .child-tab:not(.child-tab-add)');
  tabs.forEach(function(t,i){
    t.classList.toggle('active', i === idx);
  });
  document.querySelectorAll('#childPanelsWrap .child-panel').forEach(function(p,i){
    p.classList.toggle('active', i === idx);
  });
}

/* ══════════════════════════════
   بيانات دخول الأطفال
══════════════════════════════ */
var _passVisible = {};

function loadChildrenCredentials(){
  var pid = getParentId();
  var el  = document.getElementById('credList');
  if(!pid){
    el.innerHTML = '<div class="cred-loading"><i class="bi bi-person-x"></i> سجّل الدخول لرؤية البيانات</div>';
    return;
  }
  fetch('/api/auth_children?parent_id=' + encodeURIComponent(pid))
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(!res.ok || !res.data.children.length){
      el.innerHTML = '<div class="cred-loading"><i class="bi bi-people"></i> لا يوجد أطفال مسجلون بعد</div>';
      return;
    }
    var kids = res.data.children;
    document.getElementById('credBadge').textContent = kids.length;
    el.innerHTML = renderCredentials(kids);
  })
  .catch(function(){
    el.innerHTML = '<div class="cred-loading"><i class="bi bi-wifi-off"></i> تعذّر الاتصال</div>';
  });
}

var _avatarColors = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];

function renderCredentials(kids){
  var tip = '<div class="cred-tip"><i class="bi bi-shield-lock-fill"></i> أعطِ هذه البيانات لطفلك فقط — لا تشاركها مع غيره</div>';
  var html = tip;
  kids.forEach(function(kid, i){
    var color      = _avatarColors[i % _avatarColors.length];
    var initLetter = kid.fname.charAt(0);
    var passId     = 'cred-pass-' + kid.id;
    var eyeId      = 'cred-eye-'  + kid.id;
    html += '<div class="cred-child-card">' +
      '<div class="cred-child-header">' +
        '<div class="cred-avatar" style="background:linear-gradient(135deg,' + color + ',' + color + 'BB)">' + initLetter + '</div>' +
        '<div>' +
          '<div class="cred-child-name">' + kid.fname + ' ' + kid.lname + '</div>' +
          '<div class="cred-child-age"><i class="bi bi-calendar3"></i> ' + kid.age + ' سنوات</div>' +
        '</div>' +
      '</div>' +
      '<div class="cred-fields">' +
        '<div class="cred-field">' +
          '<div style="flex:1;min-width:0">' +
            '<div class="cred-field-label lbl-user"><i class="bi bi-person-fill"></i> اسم المستخدم</div>' +
            '<div class="cred-field-val" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="' + kid.username + '">' + kid.username + '</div>' +
          '</div>' +
          '<div class="cred-field-actions">' +
            '<button class="cred-btn cred-btn-copy" title="نسخ" onclick="copyCredential(\'' + kid.username + '\',this)"><i class="bi bi-clipboard-fill"></i></button>' +
          '</div>' +
        '</div>' +
        '<div class="cred-field" style="background:var(--gold-pale);border-color:rgba(232,184,48,.35)">' +
          '<div style="flex:1;min-width:0">' +
            '<div class="cred-field-label lbl-pass"><i class="bi bi-key-fill"></i> رقم الدخول الثماني (PIN)</div>' +
            '<div class="cred-field-val" id="' + passId + '" data-pass="' + kid.id + '" style="font-size:1rem;letter-spacing:.15em;color:var(--gold2);direction:ltr;text-align:right">' +
              kid.id.slice(0,4) + ' – ' + kid.id.slice(4) +
            '</div>' +
          '</div>' +
          '<div class="cred-field-actions">' +
            '<button class="cred-btn cred-btn-eye" id="' + eyeId + '" title="إظهار / إخفاء" onclick="toggleCredPass(\'' + kid.id + '\')"><i class="bi bi-eye-slash-fill"></i></button>' +
            '<button class="cred-btn cred-btn-copy" title="نسخ" onclick="copyCredential(\'' + kid.id + '\',this)"><i class="bi bi-clipboard-fill"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>' +
    '</div>';
  });
  return html;
}

function toggleCredPass(childId){
  var val     = document.getElementById('cred-pass-' + childId);
  var btn     = document.getElementById('cred-eye-'  + childId);
  var visible = (childId in _passVisible) ? _passVisible[childId] : true;
  if(visible){
    val.textContent = '•••• – ••••';
    val.classList.add('pass-hidden');
    btn.innerHTML = '<i class="bi bi-eye-fill"></i>';
    _passVisible[childId] = false;
  } else {
    var raw = val.dataset.pass || '';
    val.textContent = raw.slice(0,4) + ' – ' + raw.slice(4);
    val.classList.remove('pass-hidden');
    btn.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    _passVisible[childId] = true;
  }
}

function copyCredential(text, btn){
  navigator.clipboard.writeText(text).then(function(){
    var orig = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check-lg"></i>';
    btn.style.background = 'var(--green)';
    btn.style.color = '#fff';
    setTimeout(function(){ btn.innerHTML = orig; btn.style.background = ''; btn.style.color = ''; }, 1500);
  }).catch(function(){ showToast('تعذّر النسخ، حاول يدوياً', 'orange'); });
}

/* ══════════════════════════════
   أدوات مساعدة
══════════════════════════════ */
function getParentId(){
  try { var u = JSON.parse(sessionStorage.getItem('makam_user') || '{}'); return u.id || ''; } catch(e){ return ''; }
}

function timeAgo(dateStr){
  if(!dateStr) return 'لم يدخل بعد';
  var diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
  if(diff < 60)    return 'منذ ' + diff + ' ثانية';
  if(diff < 3600)  return 'منذ ' + Math.floor(diff/60) + ' دقيقة';
  if(diff < 86400) return 'منذ ' + Math.floor(diff/3600) + ' ساعة';
  return 'منذ ' + Math.floor(diff/86400) + ' يوم';
}

/* ══════════════════════════════
   نشاط دخول الأطفال (حقيقي)
══════════════════════════════ */
function loadChildSessions(){
  var pid = getParentId();
  var el  = document.getElementById('sessionList');
  if(!pid){
    el.innerHTML = '<div class="req-empty"><i class="bi bi-person-x"></i> سجّل الدخول لرؤية النشاط</div>';
    return;
  }
  fetch('/api/auth_child_sessions?parent_id=' + encodeURIComponent(pid))
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(!res.ok) return;
    var children = res.data.children || [];
    var onlineCount = 0;
    children.forEach(function(c){
      _sessionMap[c.child_id] = c;
      if(c.online) onlineCount++;
      var badge = document.getElementById('statusBadge-' + c.child_id);
      if(badge){
        if(c.online){
          badge.style.background = 'rgba(45,122,69,.18)';
          badge.style.color      = 'var(--green)';
          badge.innerHTML = '<i class="bi bi-circle-fill" style="font-size:.42rem;color:var(--green)"></i> متصل الآن';
        } else if(c.last_login){
          badge.style.background = 'rgba(0,0,0,.15)';
          badge.style.color      = 'rgba(255,255,255,.55)';
          badge.innerHTML = '<i class="bi bi-circle-fill" style="font-size:.42rem"></i> ' + timeAgo(c.last_login);
        }
      }
    });
    var ob = document.getElementById('onlineBadge');
    if(ob){ ob.textContent = onlineCount + ' متصل'; ob.style.display = onlineCount > 0 ? '' : 'none'; }
    renderSessions(children);
  })
  .catch(function(){});
}

function renderSessions(children){
  var el = document.getElementById('sessionList');
  if(!children.length){
    el.innerHTML = '<div class="req-empty"><i class="bi bi-people"></i> لا يوجد أطفال مسجلون بعد</div>';
    return;
  }
  var colors = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];
  var html = '';
  children.forEach(function(c, i){
    var color    = colors[i % colors.length];
    var isOnline = c.online;
    var lastText = c.last_login ? timeAgo(c.last_login) : 'لم يدخل بعد';
    html +=
      '<div class="sess-item">' +
        '<div class="sess-avatar" style="background:' + color + '">' + c.fname.charAt(0) + '</div>' +
        '<div class="sess-info">' +
          '<div class="sess-name">' + c.fname + ' ' + c.lname + '</div>' +
          '<div class="sess-time">' +
            (isOnline
              ? '<span class="sess-online-dot"></span> متصل الآن'
              : '<i class="bi bi-clock"></i> ' + lastText
            ) +
          '</div>' +
        '</div>' +
        '<div class="sess-pin" title="رقم الدخول">' +
          '<i class="bi bi-key-fill"></i>' +
          '<span class="sess-pin-val">••••</span>' +
          '<span class="sess-pin-real" style="display:none">' + c.pin + '</span>' +
          '<button class="sess-eye" onclick="toggleSessPin(this)" title="إظهار PIN"><i class="bi bi-eye-fill"></i></button>' +
        '</div>' +
      '</div>';
  });
  el.innerHTML = html;
}

function toggleSessPin(btn){
  var item   = btn.closest('.sess-item');
  var hidden = item.querySelector('.sess-pin-val');
  var real   = item.querySelector('.sess-pin-real');
  var icon   = btn.querySelector('i');
  if(hidden.style.display === 'none'){
    hidden.style.display = '';
    real.style.display   = 'none';
    icon.className       = 'bi bi-eye-fill';
  } else {
    hidden.style.display = 'none';
    real.style.display   = '';
    icon.className       = 'bi bi-eye-slash-fill';
  }
}
</script>

<?php require_once __DIR__ . '/../../site/frontend/includes/dashboard/parent/footer.php'; ?>
