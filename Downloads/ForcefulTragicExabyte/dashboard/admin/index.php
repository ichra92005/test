<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة - مقام</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --green: #2C7A51; --green-dark: #1E5C3B; --green-light: #eaf3ed;
            --white: #ffffff; --bg: #f8fafc;
            --text-dark: #1e293b; --text-light: #64748b;
            --border: #e2e8f0; --danger: #ef4444;
            --sidebar-width: 260px; --sidebar-collapsed-width: 80px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Cairo', sans-serif; background: var(--bg); color: var(--text-dark); height: 100vh; overflow: hidden; display: flex; }

        .sidebar { width: var(--sidebar-width); background: var(--green); color: var(--white); display: flex; flex-direction: column; transition: width .3s ease; border-left: 1px solid rgba(0,0,0,.1); position: relative; z-index: 20; }
        .sidebar.collapsed { width: var(--sidebar-collapsed-width); }
        .sidebar-header { height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); white-space: nowrap; }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; font-weight: 900; font-size: 1.25rem; }
        .sidebar.collapsed .sidebar-logo span { display: none; }
        .toggle-btn { background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; }
        .nav-menu { flex: 1; padding: 1.5rem 1rem; display: flex; flex-direction: column; gap: .5rem; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: .8rem 1rem; border-radius: 12px; color: rgba(255,255,255,.7); font-weight: 700; cursor: pointer; transition: all .2s; white-space: nowrap; border: none; background: transparent; width: 100%; text-align: right; font-family: inherit; font-size: 1rem; }
        .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
        .nav-item.active { background: var(--white); color: var(--green); box-shadow: 0 4px 12px rgba(0,0,0,.1); }
        .nav-item i { font-size: 1.25rem; flex-shrink: 0; }
        .sidebar.collapsed .nav-item span { display: none; }
        .sidebar.collapsed .nav-item { justify-content: center; padding: .8rem 0; }

        .main-wrapper { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { height: 70px; background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; }
        .topbar-title { font-size: 1.25rem; font-weight: 800; }
        .admin-profile { display: flex; align-items: center; gap: 10px; font-weight: 700; }
        .admin-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--green-light); color: var(--green); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        .content-area { flex: 1; padding: 2rem; overflow-y: auto; }
        .section-view { display: none; animation: fadeIn .3s ease; }
        .section-view.active { display: block; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }

        .card { background: var(--white); border-radius: 16px; border: 1px solid var(--border); padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,.05); margin-bottom: 1.5rem; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 800; display: flex; align-items: center; gap: 8px; }

        .btn { padding: .6rem 1.2rem; border-radius: 8px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: .2s; font-size: .9rem; }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-outline { background: transparent; border: 1.5px solid var(--border); color: var(--text-dark); }
        .btn-outline:hover { background: var(--bg); }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-sm { padding: .3rem .7rem; font-size: .8rem; }

        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th { padding: .9rem; border-bottom: 2px solid var(--border); color: var(--text-light); font-size: .82rem; font-weight: 700; }
        td { padding: .9rem; border-bottom: 1px solid var(--border); font-size: .88rem; font-weight: 600; }
        tr:hover td { background: var(--bg); }
        .badge { padding: .22rem .7rem; border-radius: 50px; font-size: .73rem; font-weight: 800; }
        .badge-green { background: var(--green-light); color: var(--green); }
        .badge-blue  { background: #EFF6FF; color: #2563EB; }
        .badge-orange{ background: #FFF7ED; color: #EA580C; }

        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; margin-bottom: .4rem; font-weight: 700; font-size: .88rem; }
        .form-control { width: 100%; padding: .7rem 1rem; border-radius: 8px; border: 1.5px solid var(--border); font-family: inherit; font-size: .9rem; transition: border-color .2s; outline: none; }
        .form-control:focus { border-color: var(--green); }

        .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
        .stat-card { padding: 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-info h4 { font-size: .82rem; color: var(--text-light); margin-bottom: .2rem; font-weight: 700; }
        .stat-info p { font-size: 1.5rem; font-weight: 900; }

        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal { background: var(--white); width: 90%; max-width: 520px; border-radius: 16px; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-header h3 { font-size: 1.2rem; font-weight: 800; }
        .close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-light); }

        .children-list-panel { display: flex; flex-direction: column; gap: .8rem; }
        .child-row-admin {
            display: flex; align-items: center; gap: 1rem;
            padding: .85rem 1rem; border-radius: 12px;
            border: 1.5px solid var(--border); background: var(--bg);
            transition: .2s;
        }
        .child-row-admin:hover { background: var(--white); border-color: #cbd5e1; }
        .cra-avatar {
            width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; font-weight: 900; color: #fff;
        }
        .cra-info { flex: 1; min-width: 0; }
        .cra-name { font-size: .9rem; font-weight: 800; }
        .cra-meta { font-size: .75rem; color: var(--text-light); margin-top: .1rem; }

        /* Screen time row */
        .st-row { display: flex; align-items: center; gap: 8px; margin-top: 4px; }
        .st-input { width: 70px; padding: 3px 8px; border: 1.5px solid var(--border); border-radius: 8px; font-family: inherit; font-size: .82rem; text-align: center; }
        .st-label { font-size: .75rem; color: var(--text-light); font-weight: 700; }
        .st-save-btn { padding: 3px 10px; border-radius: 8px; font-size: .75rem; font-weight: 700; font-family: inherit; background: var(--green); color: #fff; border: none; cursor: pointer; }
        .st-save-btn:hover { background: var(--green-dark); }

        @media(max-width:768px){
            .sidebar { position: absolute; height: 100%; transform: translateX(100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="bi bi-shield-check"></i>
            <span>مقام للإدارة</span>
        </div>
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    </div>
    <nav class="nav-menu">
        <button class="nav-item active" onclick="switchSection('users', this)">
            <i class="bi bi-people-fill"></i><span>إدارة المستخدمين</span>
        </button>
        <button class="nav-item" onclick="switchSection('children', this)">
            <i class="bi bi-person-hearts"></i><span>إدارة الأطفال</span>
        </button>
        <button class="nav-item" onclick="switchSection('analytics', this)">
            <i class="bi bi-bar-chart-fill"></i><span>الإحصائيات</span>
        </button>
        <button class="nav-item" onclick="switchSection('community', this)">
            <i class="bi bi-chat-heart-fill"></i><span>مجتمع الآباء</span>
        </button>
    </nav>
    <div style="padding:1.5rem 1rem;border-top:1px solid rgba(255,255,255,.1)">
        <button class="nav-item" style="color:var(--danger)" onclick="logoutAdmin()">
            <i class="bi bi-box-arrow-right"></i><span>تسجيل الخروج</span>
        </button>
    </div>
</aside>

<main class="main-wrapper">
    <header class="topbar">
        <div class="topbar-title" id="topbarTitle">إدارة المستخدمين</div>
        <div class="admin-profile">
            <span>المشرف العام</span>
            <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
        </div>
    </header>

    <div class="content-area">

        <!-- ─── USERS ─── -->
        <div id="sec-users" class="section-view active">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><i class="bi bi-people"></i> حسابات أولياء الأمور</div>
                    <button class="btn btn-primary" onclick="openModal('createAccModal')">
                        <i class="bi bi-person-plus-fill"></i> إنشاء حساب
                    </button>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead><tr>
                            <th>المعرف</th><th>الاسم الكامل</th><th>البريد الإلكتروني</th><th>عدد الأطفال</th><th>الحالة</th>
                        </tr></thead>
                        <tbody id="parentsTbody">
                            <tr><td colspan="5" style="text-align:center;color:var(--text-light);padding:2rem">
                                <i class="bi bi-arrow-clockwise"></i> جاري التحميل...
                            </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ─── CHILDREN ─── -->
        <div id="sec-children" class="section-view">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><i class="bi bi-person-hearts"></i> إدارة الأطفال</div>
                    <button class="btn btn-primary" onclick="openModal('addChildModal')">
                        <i class="bi bi-person-plus-fill"></i> إضافة طفل
                    </button>
                </div>
                <div style="margin-bottom:1rem">
                    <label class="form-label" style="display:inline-block;margin-left:10px">فلتر حسب ولي الأمر:</label>
                    <select id="parentFilter" class="form-control" style="display:inline-block;width:auto;min-width:200px" onchange="filterChildren()">
                        <option value="">كل الأطفال</option>
                    </select>
                </div>
                <div class="children-list-panel" id="childrenListPanel">
                    <div style="text-align:center;padding:2rem;color:var(--text-light)">
                        <i class="bi bi-arrow-clockwise"></i> جاري التحميل...
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── ANALYTICS ─── -->
        <div id="sec-analytics" class="section-view">
            <div class="grid-3">
                <div class="card stat-card">
                    <div class="stat-icon" style="background:var(--green-light);color:var(--green)"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-info">
                        <h4>أولياء الأمور</h4>
                        <p id="statParents">—</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon" style="background:#FFF7ED;color:#EA580C"><i class="bi bi-person-hearts"></i></div>
                    <div class="stat-info">
                        <h4>إجمالي الأطفال</h4>
                        <p id="statKids">—</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon" style="background:#EFF6FF;color:#2563EB"><i class="bi bi-clock-history"></i></div>
                    <div class="stat-info">
                        <h4>جلسات اليوم</h4>
                        <p id="statSessions">—</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── COMMUNITY ─── -->
        <div id="sec-community" class="section-view">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><i class="bi bi-chat-heart-fill"></i> مجتمع الآباء</div>
                </div>
                <p style="color:var(--text-light);font-size:.9rem">ميزة المجتمع ستكون متاحة قريباً.</p>
            </div>
        </div>

    </div>
</main>

<!-- Create Parent Account Modal -->
<div class="modal-overlay" id="createAccModal">
    <div class="modal">
        <div class="modal-header">
            <h3>إنشاء حساب ولي أمر</h3>
            <button class="close-modal" onclick="closeModal('createAccModal')"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="form-group">
            <label class="form-label">الاسم الأول</label>
            <input type="text" id="accFname" class="form-control" placeholder="أدخل الاسم الأول">
        </div>
        <div class="form-group">
            <label class="form-label">اللقب</label>
            <input type="text" id="accLname" class="form-control" placeholder="أدخل اللقب">
        </div>
        <div class="form-group">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" id="accEmail" class="form-control" placeholder="email@example.com">
        </div>
        <div class="form-group">
            <label class="form-label">كلمة المرور</label>
            <input type="password" id="accPass" class="form-control" placeholder="••••••">
        </div>
        <div style="display:flex;gap:10px;margin-top:1.5rem">
            <button class="btn btn-primary" id="btnCreateAcc" style="flex:1;justify-content:center" onclick="createParentAccount()">
                <i class="bi bi-person-check-fill"></i> حفظ الحساب
            </button>
            <button class="btn btn-outline" style="flex:1;justify-content:center" onclick="closeModal('createAccModal')">إلغاء</button>
        </div>
    </div>
</div>

<!-- Add Child Modal -->
<div class="modal-overlay" id="addChildModal">
    <div class="modal">
        <div class="modal-header">
            <h3>إضافة طفل</h3>
            <button class="close-modal" onclick="closeModal('addChildModal')"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="form-group">
            <label class="form-label">ولي الأمر <span style="color:red">*</span></label>
            <select id="childParentId" class="form-control">
                <option value="">اختر ولي الأمر...</option>
            </select>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="form-group">
                <label class="form-label">الاسم <span style="color:red">*</span></label>
                <input type="text" id="childFname" class="form-control" placeholder="الاسم الأول">
            </div>
            <div class="form-group">
                <label class="form-label">اللقب <span style="color:red">*</span></label>
                <input type="text" id="childLname" class="form-control" placeholder="اللقب">
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="form-group">
                <label class="form-label">العمر <span style="color:red">*</span></label>
                <input type="number" id="childAge" class="form-control" min="6" max="18" placeholder="6–18">
            </div>
            <div class="form-group">
                <label class="form-label">الجنس</label>
                <select id="childGender" class="form-control">
                    <option value="boy">ولد</option>
                    <option value="girl">بنت</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">احتياجات خاصة (اختياري)</label>
            <input type="text" id="childDisease" class="form-control" placeholder="مثال: عُسر القراءة">
        </div>
        <div style="display:flex;gap:10px;margin-top:1.5rem">
            <button class="btn btn-primary" id="btnAddChild" style="flex:1;justify-content:center" onclick="addChild()">
                <i class="bi bi-person-plus-fill"></i> إضافة الطفل
            </button>
            <button class="btn btn-outline" style="flex:1;justify-content:center" onclick="closeModal('addChildModal')">إلغاء</button>
        </div>
        <div id="addChildResult" style="display:none;margin-top:1rem;padding:1rem;border-radius:10px;font-size:.88rem;font-weight:700"></div>
    </div>
</div>

<script>
/* Auth check */
const userStr = sessionStorage.getItem('makam_user');
if (!userStr) window.location.href = '/login';
else {
    const u = JSON.parse(userStr);
    if (u.type !== 'admin') window.location.href = '/login';
}

/* State */
let _allParents  = [];
let _allChildren = [];

/* Sidebar toggle */
const sidebar = document.getElementById('sidebar');
function toggleSidebar() { sidebar.classList.toggle('collapsed'); }

/* Section switch */
const sectionTitles = {
    users: 'إدارة المستخدمين',
    children: 'إدارة الأطفال',
    analytics: 'الإحصائيات',
    community: 'مجتمع الآباء'
};
function switchSection(id, btn) {
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('topbarTitle').textContent = sectionTitles[id];
    document.querySelectorAll('.section-view').forEach(el => el.classList.remove('active'));
    document.getElementById('sec-' + id).classList.add('active');

    if (id === 'children') renderChildrenSection();
    if (id === 'analytics') renderAnalytics();
}

/* Modal helpers */
function openModal(id)  { document.getElementById(id).classList.add('active'); }
function closeModal(id) { document.getElementById(id).classList.remove('active'); }

function logoutAdmin() {
    sessionStorage.removeItem('makam_user');
    window.location.href = '/login';
}

/* ─── Load all data ─── */
function loadAllData() {
    // Load parents
    fetch('/api/auth_children?parent_id=__ALL__')
    .then(r => r.json())
    .catch(() => null)
    .then(() => {
        // Fallback: load parents via admin endpoint
        loadParents();
    });
}

function loadParents() {
    fetch('/api/admin_create_account', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'list_parents' })
    })
    .then(r => r.json())
    .catch(() => ({ ok: false }))
    .then(res => {
        if (res.ok && res.data && res.data.parents) {
            _allParents = res.data.parents;
        } else {
            // Try reading directly via a simple API
            _allParents = [];
        }
        renderParentsTable();
        populateParentSelects();
    });
}

function loadChildren() {
    // We'll load children by fetching them per parent
    // Since we don't have a bulk endpoint, we'll show what we have
    renderChildrenSection();
}

/* ─── Parents table ─── */
function renderParentsTable() {
    const tbody = document.getElementById('parentsTbody');
    if (!_allParents.length) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-light);padding:2rem">لا يوجد أولياء أمور مسجلون بعد</td></tr>';
        return;
    }
    tbody.innerHTML = _allParents.map(p => `
        <tr>
            <td style="font-size:.8rem;color:var(--text-light)">${p.id}</td>
            <td>${p.fname} ${p.lname}</td>
            <td style="direction:ltr;text-align:right">${p.email}</td>
            <td><span class="badge badge-blue">${(p.children_ids||[]).length} طفل</span></td>
            <td><span class="badge badge-green">نشط</span></td>
        </tr>`).join('');
}

/* ─── Children section ─── */
function populateParentSelects() {
    const selects = ['parentFilter', 'childParentId'];
    selects.forEach(id => {
        const sel = document.getElementById(id);
        if (!sel) return;
        const base = id === 'parentFilter' ? '<option value="">كل الأطفال</option>' : '<option value="">اختر ولي الأمر...</option>';
        sel.innerHTML = base + _allParents.map(p =>
            `<option value="${p.id}">${p.fname} ${p.lname} (${p.email})</option>`
        ).join('');
    });
}

let _currentParentIdForChildren = '';

function filterChildren() {
    const pid = document.getElementById('parentFilter').value;
    _currentParentIdForChildren = pid;
    if (!pid) {
        renderAllChildren();
        return;
    }
    fetchChildrenForParent(pid).then(kids => renderChildrenList(kids, pid));
}

function renderChildrenSection() {
    if (_currentParentIdForChildren) {
        filterChildren();
    } else {
        renderAllChildren();
    }
}

function renderAllChildren() {
    if (!_allParents.length) {
        document.getElementById('childrenListPanel').innerHTML =
            '<div style="text-align:center;padding:2rem;color:var(--text-light)">لا يوجد أولياء أمور لعرض أطفالهم.</div>';
        return;
    }
    const panel = document.getElementById('childrenListPanel');
    panel.innerHTML = '<div style="text-align:center;padding:1rem;color:var(--text-light)"><i class="bi bi-arrow-clockwise"></i> جاري التحميل...</div>';

    Promise.all(_allParents.map(p => fetchChildrenForParent(p.id).then(kids => ({ parent: p, kids }))))
    .then(results => {
        let html = '';
        let totalKids = 0;
        results.forEach(({ parent, kids }) => {
            if (!kids.length) return;
            totalKids += kids.length;
            html += `<div style="margin-bottom:1.5rem">
                <div style="font-size:.85rem;font-weight:800;color:var(--text-light);margin-bottom:.6rem;padding-bottom:.4rem;border-bottom:1.5px solid var(--border)">
                    <i class="bi bi-person-fill" style="color:var(--green)"></i>
                    ${parent.fname} ${parent.lname}
                    <span class="badge badge-blue" style="margin-right:.5rem">${kids.length} طفل</span>
                </div>
                ${renderChildrenRowsHTML(kids, parent.id)}
            </div>`;
        });
        if (!totalKids) {
            html = '<div style="text-align:center;padding:2rem;color:var(--text-light)">لا يوجد أطفال مسجلون بعد.</div>';
        }
        panel.innerHTML = html;
    });
}

function fetchChildrenForParent(pid) {
    return fetch('/api/auth_children?parent_id=' + encodeURIComponent(pid))
        .then(r => r.json())
        .then(res => (res.ok && res.data.children) ? res.data.children : [])
        .catch(() => []);
}

function renderChildrenList(kids, parentId) {
    const panel = document.getElementById('childrenListPanel');
    panel.innerHTML = renderChildrenRowsHTML(kids, parentId);
}

const COLORS = ['#2D7A45','#E07824','#6D28D9','#E8B830','#2563EB','#DB2777'];

function renderChildrenRowsHTML(kids, parentId) {
    if (!kids.length) return '<div style="text-align:center;padding:2rem;color:var(--text-light)">لا يوجد أطفال لهذا الولي.</div>';
    return kids.map((kid, i) => {
        const color = COLORS[i % COLORS.length];
        return `
        <div class="child-row-admin" id="row-${kid.id}">
            <div class="cra-avatar" style="background:${color}">${kid.fname.charAt(0)}</div>
            <div class="cra-info">
                <div class="cra-name">${kid.fname} ${kid.lname} · ${kid.age} سنة · @${kid.username}</div>
                <div class="cra-meta">
                    <span class="badge ${kid.gender==='girl'?'badge-orange':'badge-blue'}" style="font-size:.7rem">${kid.gender==='girl'?'بنت':'ولد'}</span>
                    ${kid.disease ? `<span style="margin-right:6px;color:var(--text-light)">${kid.disease}</span>` : ''}
                </div>
                <div class="st-row">
                    <span class="st-label">وقت الشاشة اليومي:</span>
                    <input type="number" class="st-input" id="st-${kid.id}"
                        min="0" max="480" placeholder="0"
                        value="${kid.screen_time_minutes || 0}"
                        title="دقيقة يومياً (0 = بلا حد)">
                    <span class="st-label">دقيقة</span>
                    <button class="st-save-btn" onclick="saveScreenTime('${kid.id}')">حفظ</button>
                    <span id="st-msg-${kid.id}" style="font-size:.72rem;font-weight:800;display:none"></span>
                </div>
            </div>
            <div style="display:flex;gap:6px;flex-shrink:0">
                <button class="btn btn-danger btn-sm" onclick="removeChild('${kid.id}','${kid.fname}')">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </div>
        </div>`;
    }).join('');
}

/* ─── Screen time ─── */
function saveScreenTime(childId) {
    const val = parseInt(document.getElementById('st-' + childId).value) || 0;
    const msg = document.getElementById('st-msg-' + childId);

    fetch('/api/screen_time', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ child_id: childId, daily_minutes: val, enabled: val > 0 })
    })
    .then(r => r.json())
    .then(res => {
        msg.style.display = '';
        if (res.ok) {
            msg.style.color = 'var(--green)';
            msg.textContent = '✓ تم الحفظ';
        } else {
            msg.style.color = 'red';
            msg.textContent = res.error || 'خطأ';
        }
        setTimeout(() => { msg.style.display = 'none'; }, 2500);
    })
    .catch(() => {
        msg.style.display = '';
        msg.style.color = 'red';
        msg.textContent = 'خطأ في الاتصال';
        setTimeout(() => { msg.style.display = 'none'; }, 2500);
    });
}

/* ─── Remove child ─── */
function removeChild(childId, name) {
    if (!confirm('هل أنت متأكد من حذف ملف ' + name + '؟ لا يمكن التراجع.')) return;

    fetch('/api/admin_remove_child', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ child_id: childId })
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            const row = document.getElementById('row-' + childId);
            if (row) { row.style.opacity = '0'; setTimeout(() => row.remove(), 300); }
            showToast('تم حذف ملف ' + name + ' بنجاح', 'success');
        } else {
            alert('خطأ: ' + (res.error || 'تعذر الحذف'));
        }
    })
    .catch(() => alert('حدث خطأ في الاتصال'));
}

/* ─── Add child ─── */
function addChild() {
    const parentId = document.getElementById('childParentId').value;
    const fname    = document.getElementById('childFname').value.trim();
    const lname    = document.getElementById('childLname').value.trim();
    const age      = parseInt(document.getElementById('childAge').value) || 0;
    const gender   = document.getElementById('childGender').value;
    const disease  = document.getElementById('childDisease').value.trim();

    if (!parentId || !fname || !lname || !age) {
        alert('يرجى ملء جميع الحقول المطلوبة'); return;
    }

    const btn = document.getElementById('btnAddChild');
    btn.textContent = 'جاري الإضافة...'; btn.disabled = true;

    fetch('/api/auth_add_child', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ parent_id: parentId, fname, lname, age, gender, disease })
    })
    .then(r => r.json())
    .then(res => {
        btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
        btn.disabled = false;
        const resultEl = document.getElementById('addChildResult');
        resultEl.style.display = 'block';
        if (res.ok) {
            const d = res.data;
            resultEl.style.background = '#f0fff4';
            resultEl.style.border = '1.5px solid #bbf7d0';
            resultEl.style.color = '#166534';
            resultEl.innerHTML = `
                ✅ تمت الإضافة بنجاح!<br>
                <strong>اسم المستخدم:</strong> ${d.username}<br>
                <strong>رمز الدخول (PIN):</strong> ${d.password.slice(0,4)} – ${d.password.slice(4)}`;
            // Clear form
            document.getElementById('childFname').value = '';
            document.getElementById('childLname').value = '';
            document.getElementById('childAge').value   = '';
            document.getElementById('childDisease').value = '';
            // Refresh children list
            renderChildrenSection();
        } else {
            resultEl.style.background = '#fff1f2';
            resultEl.style.border = '1.5px solid #fecdd3';
            resultEl.style.color = '#be123c';
            resultEl.textContent = '❌ خطأ: ' + (res.error || 'تعذّرت الإضافة');
        }
    })
    .catch(() => {
        btn.innerHTML = '<i class="bi bi-person-plus-fill"></i> إضافة الطفل';
        btn.disabled = false;
        alert('حدث خطأ في الاتصال بالخادم');
    });
}

/* ─── Create parent account ─── */
function createParentAccount() {
    const fname = document.getElementById('accFname').value.trim();
    const lname = document.getElementById('accLname').value.trim();
    const email = document.getElementById('accEmail').value.trim();
    const pass  = document.getElementById('accPass').value;

    if (!fname || !lname || !email || !pass) {
        alert('يرجى ملء جميع الحقول'); return;
    }

    const btn = document.getElementById('btnCreateAcc');
    btn.textContent = 'جاري الحفظ...'; btn.disabled = true;

    fetch('/api/admin_create_account', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'parent', name: fname + ' ' + lname, email_username: email, password: pass, fname, lname })
    })
    .then(r => r.json())
    .then(res => {
        btn.innerHTML = '<i class="bi bi-person-check-fill"></i> حفظ الحساب';
        btn.disabled = false;
        if (res.ok) {
            alert('تم إنشاء الحساب بنجاح!');
            closeModal('createAccModal');
            ['accFname','accLname','accEmail','accPass'].forEach(id => document.getElementById(id).value = '');
            loadParents();
        } else {
            alert('خطأ: ' + (res.error || 'تعذّر إنشاء الحساب'));
        }
    })
    .catch(() => {
        btn.innerHTML = '<i class="bi bi-person-check-fill"></i> حفظ الحساب';
        btn.disabled = false;
        alert('حدث خطأ في الاتصال بالخادم');
    });
}

/* ─── Analytics ─── */
function renderAnalytics() {
    document.getElementById('statParents').textContent = _allParents.length || '—';
    const totalKids = _allParents.reduce((s, p) => s + (p.children_ids || []).length, 0);
    document.getElementById('statKids').textContent = totalKids || '—';

    fetch('/api/auth_child_sessions?parent_id=admin')
    .then(r => r.json())
    .catch(() => null)
    .then(res => {
        const sessions = (res && res.ok && res.data && res.data.children) ? res.data.children.length : '—';
        document.getElementById('statSessions').textContent = sessions;
    });
}

/* ─── Toast ─── */
function showToast(msg, type) {
    const colors = { success: '#2D7A45', error: '#C1392B' };
    const t = document.createElement('div');
    t.style.cssText = `position:fixed;bottom:24px;left:50%;transform:translateX(-50%);
        background:${colors[type]||colors.success};color:#fff;font-family:'Cairo',sans-serif;
        font-size:.88rem;font-weight:800;padding:.65rem 1.4rem;border-radius:50px;
        z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,.2);white-space:nowrap;
        transition:opacity .3s ease`;
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }, 2800);
}

/* ─── Init ─── */
document.addEventListener('DOMContentLoaded', function() {
    loadParents();
});

/* Load screen_time values for children display */
function loadScreenTimesForParent(parentId) {
    if (!parentId) return;
    fetch('/api/screen_time?parent_id=' + encodeURIComponent(parentId))
    .then(r => r.json())
    .then(res => {
        if (!res.ok) return;
        res.data.limits.forEach(l => {
            const inp = document.getElementById('st-' + l.child_id);
            if (inp) inp.value = l.daily_minutes;
        });
    })
    .catch(() => {});
}
</script>
</body>
</html>
