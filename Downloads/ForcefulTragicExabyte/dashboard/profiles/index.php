<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>من يلعب الآن؟ · مقام</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Reem+Kufi+Fun:wght@400;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <style>
        :root {
            --clay:   #C0392B;
            --amber:  #E67E22;
            --sun:    #F9C74F;
            --mint:   #2C7A51;
            --cream:  #FFF6E5;
            --paper:  #FFFBF1;
            --ink:    #2A1810;
            --soft:   #FFE9C4;
            --shadow: rgba(60,30,10,.18);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Warm grain texture */
        body::before {
            content: "";
            position: fixed; inset: 0;
            pointer-events: none; z-index: 0;
            background-image:
                radial-gradient(rgba(192,57,43,.04) 1px, transparent 1px),
                radial-gradient(rgba(44,122,81,.03) 1px, transparent 1px);
            background-size: 22px 22px, 18px 18px;
            background-position: 0 0, 9px 9px;
        }

        /* Desert blobs */
        .blob {
            position: fixed; border-radius: 50%;
            filter: blur(80px); pointer-events: none; z-index: 0;
        }
        .blob-1 { width:420px; height:420px; background:rgba(230,126,34,.12); top:-120px; right:-100px; }
        .blob-2 { width:360px; height:360px; background:rgba(192,57,43,.08); bottom:-100px; left:-80px; }
        .blob-3 { width:260px; height:260px; background:rgba(249,199,79,.10); bottom:80px; right:-60px; }

        .page-wrap {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            padding: 40px 20px 80px;
        }

        /* Logo */
        .logo-area {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 36px;
        }
        .logo-area img {
            height: 52px;
            filter: drop-shadow(0 4px 8px rgba(192,57,43,.2));
        }
        .logo-area .brand {
            font-family: 'Reem Kufi Fun', sans-serif;
            font-size: 28px; font-weight: 700; color: var(--clay);
            letter-spacing: 1px;
        }

        /* Heading */
        .heading {
            text-align: center;
            margin-bottom: 40px;
        }
        .heading .subtitle {
            font-size: 13px; font-weight: 800; color: var(--amber);
            letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px;
        }
        .heading h1 {
            font-family: 'Reem Kufi Fun', sans-serif;
            font-size: clamp(28px, 5vw, 42px);
            font-weight: 700; color: var(--ink); line-height: 1.2;
        }
        .heading p {
            font-size: 14px; color: #7a5538; font-weight: 700; margin-top: 8px;
        }

        /* Profiles grid */
        .profiles-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 900px;
            width: 100%;
        }

        /* Profile card */
        .profile-card {
            background: rgba(255, 251, 241, 0.9);
            border: 3px solid var(--soft);
            border-radius: 24px;
            padding: 28px 20px 22px;
            width: 190px;
            cursor: pointer;
            display: flex; flex-direction: column; align-items: center; gap: 12px;
            box-shadow: 0 8px 0 var(--shadow);
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
            position: relative;
            overflow: hidden;
        }
        .profile-card::before {
            content: "";
            position: absolute; inset: 0;
            background: linear-gradient(160deg, rgba(249,199,79,.06), transparent);
            pointer-events: none;
        }
        .profile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 0 var(--shadow);
            border-color: var(--amber);
        }
        .profile-card:active {
            transform: scale(.96);
            box-shadow: 0 4px 0 var(--shadow);
        }

        .profile-card .avatar-wrap {
            width: 110px; height: 110px;
            border-radius: 50%;
            border: 4px solid var(--amber);
            background: var(--cream);
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(192,57,43,.18);
            flex-shrink: 0;
        }
        .profile-card .avatar-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .profile-card .child-name {
            font-family: 'Reem Kufi Fun', sans-serif;
            font-size: 22px; font-weight: 700;
            color: var(--ink);
            text-align: center;
        }
        .profile-card .age-badge {
            font-size: 11px; font-weight: 800;
            background: var(--soft);
            border: 2px solid var(--amber);
            border-radius: 999px;
            padding: 4px 12px;
            color: #5a3a1f;
        }
        .profile-card .gender-tag {
            font-size: 12px; color: var(--amber); font-weight: 800;
        }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 48px 24px;
            background: rgba(255,251,241,.9);
            border: 3px dashed var(--soft);
            border-radius: 24px; max-width: 420px;
        }
        .empty-state .empty-icon {
            font-size: 56px; margin-bottom: 16px; opacity: .4;
        }
        .empty-state p {
            font-size: 15px; font-weight: 800; color: #7a5538; margin-bottom: 6px;
        }
        .empty-state small { font-size: 13px; color: #a07050; font-weight: 700; }

        /* Loading */
        .loading {
            display: flex; flex-direction: column; align-items: center; gap: 16px;
            padding: 48px 24px;
        }
        .loading-ball {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--clay);
            animation: bounce 0.9s ease-in-out infinite alternate;
        }
        @keyframes bounce { from { transform: translateY(0) } to { transform: translateY(-28px) } }
        .loading p { font-size: 14px; font-weight: 800; color: #7a5538; }

        /* Parent gateway button */
        .parent-btn {
            position: fixed;
            bottom: 28px;
            left: 28px;
            background: rgba(255,251,241,.92);
            backdrop-filter: blur(8px);
            border: 2px solid var(--soft);
            border-radius: 50px;
            padding: 10px 22px;
            color: #7a5538;
            font-family: 'Cairo', sans-serif;
            font-size: 14px; font-weight: 800;
            cursor: pointer;
            display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 16px var(--shadow);
            transition: all .2s ease;
            z-index: 10;
        }
        .parent-btn:hover {
            background: var(--cream);
            border-color: var(--amber);
            color: var(--clay);
            transform: scale(1.04);
        }

        /* Spinner overlay on click */
        .card-spinner {
            display: none;
            position: absolute; inset: 0;
            background: rgba(255,251,241,.85);
            border-radius: 21px;
            align-items: center; justify-content: center;
        }
        .card-spinner.show { display: flex; }
        .spin {
            width: 36px; height: 36px; border-radius: 50%;
            border: 3px solid var(--soft);
            border-top-color: var(--clay);
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg) } }

        /* Modal */
        #parentModal {
            display: none;
            position: fixed; inset: 0;
            background: rgba(42,24,16,.65);
            backdrop-filter: blur(6px);
            align-items: center; justify-content: center;
            z-index: 200;
        }
        #parentModal.open { display: flex; }
        .modal-box {
            background: var(--cream);
            border: 3px solid var(--amber);
            border-radius: 28px;
            padding: 32px 28px;
            width: 90%; max-width: 380px;
            box-shadow: 0 24px 60px rgba(0,0,0,.3);
            position: relative;
        }
        .modal-box h3 {
            font-family: 'Reem Kufi Fun', sans-serif;
            font-size: 24px; font-weight: 700; color: var(--ink);
            margin-bottom: 6px; text-align: center;
        }
        .modal-box p { font-size: 13px; color: #7a5538; font-weight: 700; text-align: center; margin-bottom: 20px; }
        .modal-box input[type="password"] {
            width: 100%; padding: 14px 16px;
            border: 2px solid var(--soft);
            border-radius: 12px;
            font-family: 'Cairo', sans-serif;
            font-size: 15px; color: var(--ink);
            background: var(--paper);
            outline: none; transition: border-color .2s;
            margin-bottom: 12px;
        }
        .modal-box input:focus { border-color: var(--amber); }
        .modal-btns { display: flex; gap: 10px; }
        .modal-btns button {
            flex: 1; padding: 12px;
            border-radius: 12px; border: none;
            font-family: 'Cairo', sans-serif;
            font-size: 14px; font-weight: 800;
            cursor: pointer; transition: .2s;
        }
        .btn-submit { background: var(--clay); color: #fff; }
        .btn-submit:hover { background: #a93226; }
        .btn-cancel { background: var(--soft); color: var(--ink); }
        .btn-cancel:hover { background: #f0d5a0; }
        #modalError {
            color: var(--clay); font-size: 13px; font-weight: 800;
            text-align: center; margin-bottom: 10px; display: none;
        }
        .close-modal-btn {
            position: absolute; top: 14px; left: 14px;
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--soft); border: none; cursor: pointer;
            display: grid; place-items: center; font-size: 18px; color: var(--clay);
            transition: background .2s;
        }
        .close-modal-btn:hover { background: #f0d5a0; }
    </style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<div class="page-wrap">

    <div class="logo-area">
        <img src="/assets/logo-maqam-transparent.png" alt="مقام"
             onerror="this.style.display='none'">
        <span class="brand">مقام</span>
    </div>

    <div class="heading">
        <div class="subtitle">· اختر ملفك الشخصي ·</div>
        <h1>من يلعب الآن؟</h1>
        <p>اختر حسابك للدخول إلى عالم مقام</p>
    </div>

    <!-- Profiles injected here -->
    <div class="profiles-grid" id="profilesGrid">
        <div class="loading">
            <div class="loading-ball"></div>
            <p>جاري التحميل...</p>
        </div>
    </div>

</div>

<!-- Parent gateway button -->
<button class="parent-btn" onclick="openParentModal()">
    ⚙️ بوابة الولي
</button>

<!-- Parent modal -->
<div id="parentModal">
    <div class="modal-box">
        <button class="close-modal-btn" onclick="closeParentModal()">✕</button>
        <h3>وصول الولي</h3>
        <p>أدخل كلمة مرور حسابك للدخول إلى لوحة التحكم</p>
        <div id="modalError">كلمة المرور غير صحيحة</div>
        <input type="password" id="parentPassword" placeholder="كلمة المرور">
        <div class="modal-btns">
            <button class="btn-cancel" onclick="closeParentModal()">إلغاء</button>
            <button class="btn-submit" id="submitParentBtn" onclick="verifyParent()">متابعة</button>
        </div>
    </div>
</div>

<script>
/* ── Auth check ── */
const userStr = sessionStorage.getItem('makam_user');
if (!userStr) { window.location.href = '/login'; }
const userData = JSON.parse(userStr);
if (userData.type !== 'parent') { window.location.href = '/login'; }

/* ── Render children ── */
const grid = document.getElementById('profilesGrid');
const children = userData.children || [];

if (!children.length) {
    grid.innerHTML = `
        <div class="empty-state">
            <div class="empty-icon">👧🏻</div>
            <p>لا يوجد أطفال مسجلون بعد</p>
            <small>يمكنك إضافة أطفال من بوابة الولي</small>
        </div>`;
} else {
    grid.innerHTML = '';
    children.forEach(child => {
        const pfp = child.gender === 'girl'
            ? '/assets/pfp/girl.png'
            : '/assets/pfp/boy.png';
        const genderLabel = child.gender === 'girl' ? 'بنت' : 'ولد';

        const card = document.createElement('div');
        card.className = 'profile-card';
        card.innerHTML = `
            <div class="avatar-wrap">
                <img src="${pfp}" alt="${child.fname}"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 40 40%22><circle cx=%2220%22 cy=%2220%22 r=%2220%22 fill=%22%23FFE9C4%22/><text x=%2250%25%22 y=%2255%25%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-size=%2220%22>${child.fname.charAt(0)}</text></svg>'">
            </div>
            <div class="child-name">${child.fname}</div>
            <div class="gender-tag">${genderLabel}</div>
            <div class="age-badge">${child.age} سنة</div>
            <div class="card-spinner" id="spinner-${child.id}">
                <div class="spin"></div>
            </div>`;
        card.addEventListener('click', () => loginAsChild(child, card));
        grid.appendChild(card);
    });
}

/* ── Login as child ── */
function loginAsChild(child, card) {
    const spinner = document.getElementById('spinner-' + child.id);
    if (spinner) spinner.classList.add('show');

    fetch('/api/auth_login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'child', login: child.username, password: child.id })
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            sessionStorage.setItem('makam_user', JSON.stringify(res.data));
            const age = parseInt(res.data.age) || 0;
            let cat = 1;
            if (age >= 8 && age <= 11) cat = 2;
            else if (age >= 12) cat = 3;
            window.location.href = '/dashboard/student?category=' + cat;
        } else {
            if (spinner) spinner.classList.remove('show');
            alert('تعذّر الدخول: ' + (res.error || 'خطأ غير معروف'));
        }
    })
    .catch(() => {
        if (spinner) spinner.classList.remove('show');
        alert('حدث خطأ في الاتصال بالخادم');
    });
}

/* ── Parent modal ── */
function openParentModal() {
    document.getElementById('parentModal').classList.add('open');
    document.getElementById('parentPassword').value = '';
    document.getElementById('modalError').style.display = 'none';
    setTimeout(() => document.getElementById('parentPassword').focus(), 100);
}
function closeParentModal() {
    document.getElementById('parentModal').classList.remove('open');
}

function verifyParent() {
    const pass = document.getElementById('parentPassword').value;
    if (!pass) return;

    const btn = document.getElementById('submitParentBtn');
    btn.textContent = 'جاري التحقق...';
    btn.disabled = true;

    fetch('/api/auth_login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'parent', login: userData.email, password: pass })
    })
    .then(r => r.json())
    .then(res => {
        btn.textContent = 'متابعة';
        btn.disabled = false;
        if (res.ok) {
            sessionStorage.setItem('makam_user', JSON.stringify(res.data));
            window.location.href = '/dashboard/parent/index.php';
        } else {
            document.getElementById('modalError').style.display = 'block';
            document.getElementById('modalError').textContent = res.error || 'كلمة المرور غير صحيحة';
        }
    })
    .catch(() => {
        btn.textContent = 'متابعة';
        btn.disabled = false;
        document.getElementById('modalError').style.display = 'block';
        document.getElementById('modalError').textContent = 'حدث خطأ في الاتصال';
    });
}

/* Close modal on outside click */
document.getElementById('parentModal').addEventListener('click', function(e) {
    if (e.target === this) closeParentModal();
});
</script>
</body>
</html>
