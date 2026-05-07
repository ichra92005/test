<?php
session_start();
// Security check for admin
$makam_user = json_decode($_SESSION['makam_user'] ?? 'null', true);
// If using sessionStorage only, we might not have $_SESSION. Let's just do a basic HTML shell.
// The JS will verify the sessionStorage.
?>
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
            --green: #2C7A51;
            --green-dark: #1E5C3B;
            --green-light: #eaf3ed;
            --white: #ffffff;
            --bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg);
            color: var(--text-dark);
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        /* ─── Sidebar ─── */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--green);
            color: var(--white);
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            border-left: 1px solid rgba(0,0,0,0.1);
            position: relative;
            z-index: 20;
        }
        .sidebar.collapsed { width: var(--sidebar-collapsed-width); }
        
        .sidebar-header {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            white-space: nowrap;
        }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; font-weight: 900; font-size: 1.25rem; }
        .sidebar-logo img { height: 35px; }
        .sidebar.collapsed .sidebar-logo span { display: none; }
        
        .toggle-btn {
            background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
        }

        .nav-menu { flex: 1; padding: 1.5rem 1rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 0.8rem 1rem; border-radius: 12px;
            color: rgba(255,255,255,0.7); text-decoration: none;
            font-weight: 700; cursor: pointer; transition: all 0.2s ease;
            white-space: nowrap; border: none; background: transparent; width: 100%; text-align: right;
            font-family: inherit; font-size: 1rem;
        }
        .nav-item:hover { background-color: rgba(255,255,255,0.1); color: var(--white); }
        .nav-item.active { background-color: var(--white); color: var(--green); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .nav-item i { font-size: 1.25rem; flex-shrink: 0; }
        .sidebar.collapsed .nav-item span { display: none; }
        .sidebar.collapsed .nav-item { justify-content: center; padding: 0.8rem 0; }

        /* ─── Main Content ─── */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        
        .topbar {
            height: 70px; background: var(--white); border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem;
        }
        .topbar-title { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); }
        .admin-profile { display: flex; align-items: center; gap: 10px; font-weight: 700; }
        .admin-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--green-light); color: var(--green); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

        .content-area { flex: 1; padding: 2rem; overflow-y: auto; }
        
        .section-view { display: none; animation: fadeIn 0.3s ease; }
        .section-view.active { display: block; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }

        /* ─── UI Components ─── */
        .card { background: var(--white); border-radius: 16px; border: 1px solid var(--border); padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 1.5rem; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 800; display: flex; align-items: center; gap: 8px; }
        
        .btn { padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; font-size: 0.9rem; }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-outline { background: transparent; border: 1.5px solid var(--border); color: var(--text-dark); }
        .btn-outline:hover { background: var(--bg); }
        .btn-danger { background: var(--danger); color: white; }

        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th { padding: 1rem; border-bottom: 2px solid var(--border); color: var(--text-light); font-size: 0.85rem; font-weight: 700; }
        td { padding: 1rem; border-bottom: 1px solid var(--border); color: var(--text-dark); font-size: 0.9rem; font-weight: 600; }
        tr:hover td { background-color: var(--bg); }
        .badge { padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; }
        .badge-green { background: var(--green-light); color: var(--green); }
        
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 700; font-size: 0.9rem; color: var(--text-dark); }
        .form-control { width: 100%; padding: 0.75rem 1rem; border-radius: 8px; border: 1.5px solid var(--border); font-family: inherit; font-size: 0.9rem; transition: border-color 0.2s; }
        .form-control:focus { outline: none; border-color: var(--green); }
        textarea.form-control { resize: vertical; min-height: 100px; }

        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .stat-card { padding: 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-info h4 { font-size: 0.85rem; color: var(--text-light); margin-bottom: 0.25rem; font-weight: 700; }
        .stat-info p { font-size: 1.5rem; font-weight: 900; color: var(--text-dark); }

        /* ─── Modals ─── */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal { background: var(--white); width: 90%; max-width: 500px; border-radius: 16px; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-header h3 { font-size: 1.25rem; font-weight: 800; }
        .close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-light); }
        
        /* ─── Responsive ─── */
        @media(max-width: 768px){
            .sidebar { position: absolute; height: 100%; transform: translateX(100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="bi bi-shield-check"></i>
                <span>مقام للإدارة</span>
            </div>
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>
        
        <nav class="nav-menu">
            <button class="nav-item active" onclick="switchSection('users')">
                <i class="bi bi-people-fill"></i>
                <span>إدارة المستخدمين</span>
            </button>
            <button class="nav-item" onclick="switchSection('content')">
                <i class="bi bi-journal-text"></i>
                <span>إدارة المحتوى</span>
            </button>
            <button class="nav-item" onclick="switchSection('analytics')">
                <i class="bi bi-bar-chart-fill"></i>
                <span>الإحصائيات</span>
            </button>
            <button class="nav-item" onclick="switchSection('community')">
                <i class="bi bi-chat-heart-fill"></i>
                <span>مجتمع الآباء</span>
            </button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title" id="topbarTitle">إدارة المستخدمين</div>
            <div class="admin-profile">
                <span>المشرف العام</span>
                <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
            </div>
        </header>

        <div class="content-area">
            
            <!-- SECTION: User Management -->
            <div id="sec-users" class="section-view active">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-people"></i> حسابات المنصة</div>
                        <button class="btn btn-primary" onclick="openModal('createAccModal')">
                            <i class="bi bi-person-plus-fill"></i> إنشاء حساب
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>المعرف</th>
                                    <th>الاسم</th>
                                    <th>البريد / اسم المستخدم</th>
                                    <th>النوع</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1054</td>
                                    <td>أحمد بن علي</td>
                                    <td>ahmed@example.com</td>
                                    <td>ولي أمر</td>
                                    <td><span class="badge badge-green">نشط</span></td>
                                    <td><button class="btn btn-outline" style="padding:0.3rem 0.6rem"><i class="bi bi-pencil"></i></button></td>
                                </tr>
                                <tr>
                                    <td>#1055</td>
                                    <td>سمير</td>
                                    <td>samir123</td>
                                    <td>طفل</td>
                                    <td><span class="badge badge-green">نشط</span></td>
                                    <td><button class="btn btn-outline" style="padding:0.3rem 0.6rem"><i class="bi bi-pencil"></i></button></td>
                                </tr>
                                <tr>
                                    <td>#1056</td>
                                    <td>لينا كمال</td>
                                    <td>lina@example.com</td>
                                    <td>ولي أمر</td>
                                    <td><span class="badge badge-green">نشط</span></td>
                                    <td><button class="btn btn-outline" style="padding:0.3rem 0.6rem"><i class="bi bi-pencil"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION: Content Management -->
            <div id="sec-content" class="section-view">
                <div class="grid-3" style="grid-template-columns: 2fr 1fr;">
                    <!-- Update Content Form -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="bi bi-pencil-square"></i> تحديث القصص والألعاب</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">اختر القسم</label>
                            <select class="form-control">
                                <option>وحدة تاريخ الجزائر - الألعاب</option>
                                <option>قصص الأنبياء</option>
                                <option>ألعاب الرياضيات</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">العنوان</label>
                            <input type="text" class="form-control" value="مغامرة الأمير عبد القادر">
                        </div>
                        <div class="form-group">
                            <label class="form-label">المحتوى / الوصف</label>
                            <textarea class="form-control">تبدأ القصة في معسكر...</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">رابط اللعبة (إن وجد)</label>
                            <input type="text" class="form-control" placeholder="https://...">
                        </div>
                        <button class="btn btn-primary" onclick="alert('تم تحديث المحتوى!')"><i class="bi bi-save"></i> حفظ التحديثات</button>
                    </div>

                    <!-- Add New Section -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="bi bi-plus-square-dotted"></i> إضافة قسم جديد</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">اسم القسم (Section Name)</label>
                            <input type="text" class="form-control" placeholder="مثال: علوم الفضاء">
                        </div>
                        <div class="form-group">
                            <label class="form-label">الأيقونة (Lucide / Bootstrap)</label>
                            <input type="text" class="form-control" placeholder="bi-rocket">
                        </div>
                        <button class="btn btn-outline" style="width:100%; justify-content:center;" onclick="alert('تم إضافة القسم بنجاح!')">
                            <i class="bi bi-plus-lg"></i> إضافة
                        </button>
                    </div>
                </div>
            </div>

            <!-- SECTION: Analytics -->
            <div id="sec-analytics" class="section-view">
                <div class="grid-3">
                    <div class="card stat-card">
                        <div class="stat-icon" style="background:var(--green-light); color:var(--green)"><i class="bi bi-people-fill"></i></div>
                        <div class="stat-info">
                            <h4>إجمالي المستخدمين</h4>
                            <p>1,250</p>
                        </div>
                    </div>
                    <div class="card stat-card">
                        <div class="stat-icon" style="background:#fef3c7; color:#d97706"><i class="bi bi-controller"></i></div>
                        <div class="stat-info">
                            <h4>الألعاب الملعوبة</h4>
                            <p>8,430</p>
                        </div>
                    </div>
                    <div class="card stat-card">
                        <div class="stat-icon" style="background:#e0e7ff; color:#4f46e5"><i class="bi bi-clock-history"></i></div>
                        <div class="stat-info">
                            <h4>متوسط وقت اللعب</h4>
                            <p>45 دقيقة</p>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header"><div class="card-title"><i class="bi bi-graph-up"></i> نمو المنصة</div></div>
                    <div style="height:250px; background:var(--bg); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--text-light); border:2px dashed var(--border);">
                        [ مساحة لرسم بياني تفاعلي - Chart.js ]
                    </div>
                </div>
            </div>

            <!-- SECTION: Community -->
            <div id="sec-community" class="section-view">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-chat-heart-fill"></i> مجتمع الآباء والتفاعلات</div>
                        <button class="btn btn-outline"><i class="bi bi-funnel"></i> تصفية</button>
                    </div>
                    
                    <div style="display:flex; flex-direction:column; gap:1rem;">
                        <div style="padding:1rem; border:1px solid var(--border); border-radius:12px;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                                <strong>أحمد ولي أمر</strong>
                                <span style="font-size:0.8rem; color:var(--text-light)">منذ 10 دقائق</span>
                            </div>
                            <p style="font-size:0.95rem; color:var(--text-dark);">"تطبيق رائع! طفلي تعلم الكثير عن تاريخ الجزائر بفضل الألعاب الممتعة."</p>
                            <div style="margin-top:0.8rem; display:flex; gap:10px;">
                                <button class="btn btn-outline" style="padding:0.3rem 0.6rem; font-size:0.8rem;"><i class="bi bi-hand-thumbs-up"></i> إعجاب</button>
                                <button class="btn btn-danger" style="padding:0.3rem 0.6rem; font-size:0.8rem;"><i class="bi bi-trash"></i> حذف</button>
                            </div>
                        </div>
                        
                        <div style="padding:1rem; border:1px solid var(--border); border-radius:12px;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                                <strong>سارة كمال</strong>
                                <span style="font-size:0.8rem; color:var(--text-light)">أمس</span>
                            </div>
                            <p style="font-size:0.95rem; color:var(--text-dark);">"هل سيتم إضافة أقسام لتعلم الحروف العربية قريباً؟"</p>
                            <div style="margin-top:0.8rem; display:flex; gap:10px;">
                                <button class="btn btn-outline" style="padding:0.3rem 0.6rem; font-size:0.8rem;"><i class="bi bi-reply"></i> رد مباشر</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Create Account Modal -->
    <div class="modal-overlay" id="createAccModal">
        <div class="modal">
            <div class="modal-header">
                <h3>إنشاء حساب جديد</h3>
                <button class="close-modal" onclick="closeModal('createAccModal')"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="form-group">
                <label class="form-label">نوع الحساب</label>
                <select class="form-control" id="accType">
                    <option value="parent">ولي أمر</option>
                    <option value="child">طفل</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" class="form-control" placeholder="أدخل الاسم">
            </div>
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني / اسم المستخدم</label>
                <input type="text" class="form-control" placeholder="email@example.com">
            </div>
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" placeholder="****">
            </div>
            <div style="display:flex; gap:10px; margin-top:2rem;">
                <button class="btn btn-primary" style="flex:1; justify-content:center;" onclick="mockCreateAccount()">حفظ الحساب</button>
                <button class="btn btn-outline" style="flex:1; justify-content:center;" onclick="closeModal('createAccModal')">إلغاء</button>
            </div>
        </div>
    </div>

    <script>
        // Check if admin is logged in
        const userStr = sessionStorage.getItem('makam_user');
        if(!userStr){
            window.location.href = '/login';
        } else {
            const user = JSON.parse(userStr);
            if(user.type !== 'admin'){
                window.location.href = '/login';
            }
        }

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
        }

        // Section Switcher
        const titles = {
            'users': 'إدارة المستخدمين',
            'content': 'إدارة المحتوى',
            'analytics': 'الإحصائيات',
            'community': 'مجتمع الآباء'
        };

        function switchSection(secId) {
            // Update nav items
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
            event.currentTarget.classList.add('active');
            
            // Update Title
            document.getElementById('topbarTitle').innerText = titles[secId];
            
            // Show corresponding section
            document.querySelectorAll('.section-view').forEach(el => el.classList.remove('active'));
            document.getElementById('sec-' + secId).classList.add('active');
            
            // On mobile, auto close sidebar after selection
            if(window.innerWidth <= 768) {
                sidebar.classList.remove('mobile-open');
            }
        }

        // Modals
        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        function mockCreateAccount() {
            alert('تم إنشاء الحساب بنجاح!');
            closeModal('createAccModal');
        }
    </script>
</body>
</html>
