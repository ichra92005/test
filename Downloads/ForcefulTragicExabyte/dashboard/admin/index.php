<?php
require_once __DIR__ . '/../../site/frontend/config/config.php';
$dash_title  = 'لوحة تحكم الإدارة';
$dash_icon   = 'shield-lock-fill';
$dash_active = 'overview';

require_once __DIR__ . '/../../site/frontend/includes/dashboard/admin/header.php';
?>

<style>
/* ══════════════════════════════════════════
   ADMIN DASHBOARD
══════════════════════════════════════════ */
.dash-content {
  background: linear-gradient(160deg, #FFF8F0 0%, #FFFCF5 35%, #F2FAF5 70%, #F5F8FF 100%);
  min-height: 100vh;
  padding: 2rem 2rem 3rem;
  position: relative;
}

.page-blobs { position: absolute; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
.pg-blob {
  position: absolute; border-radius: 50%;
  filter: blur(80px); opacity: .08;
}
.pg-blob-1 { width: 500px; height: 500px; background: var(--orange); top: -150px; right: -100px; animation: blobDrift 12s ease-in-out infinite; }
.pg-blob-2 { width: 380px; height: 380px; background: var(--red); bottom: 100px; left: -80px; animation: blobDrift 15s ease-in-out 3s infinite reverse; }

@keyframes blobDrift { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-20px) scale(1.05)} }

.dash-content > * { position: relative; z-index: 1; }

.tab-content { display: none; animation: fadeUp .4s ease; }
.tab-content.active { display: block; }

/* Dashboard Cards */
.stats-band {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 1.2rem; margin-bottom: 2rem;
}
.sband-card {
  background: rgba(255, 255, 255, 0.6);
  border-radius: 20px;
  padding: 1.5rem 1.4rem;
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 4px 24px rgba(0,0,0,.04);
  display: flex; flex-direction: column; gap: .8rem;
  transition: all .3s;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.sband-card:hover { transform: translateY(-5px); box-shadow: 0 16px 48px rgba(0,0,0,.1); background: rgba(255, 255, 255, 0.8); }
.sbc-top { display: flex; align-items: flex-start; justify-content: space-between; }
.sbc-icon {
  width: 52px; height: 52px; border-radius: 16px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem; flex-shrink: 0; color: white;
}
.sbc-num { font-size: 2.2rem; font-weight: 900; line-height: 1; color: var(--gray-800); }
.sbc-label { font-size: .85rem; font-weight: 700; color: var(--gray-500); }

/* Tables */
.admin-table-container {
  background: rgba(255, 255, 255, 0.6); border-radius: 20px;
  padding: 1.5rem; box-shadow: 0 4px 24px rgba(0,0,0,.04);
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.admin-table { width: 100%; border-collapse: collapse; text-align: right; }
.admin-table th { padding: 1rem; border-bottom: 2px solid var(--gray-200); color: var(--gray-600); font-size: .9rem; }
.admin-table td { padding: 1rem; border-bottom: 1px solid var(--gray-100); color: var(--gray-800); font-size: .9rem; font-weight: 600; }
.admin-table tr:last-child td { border-bottom: none; }
.status-badge { padding: .3rem .8rem; border-radius: 50px; font-size: .75rem; font-weight: bold; }
.status-active { background: var(--green-pale); color: var(--green); }
.status-pending { background: var(--orange-pale); color: var(--orange); }

/* Content Editor */
.editor-container {
  background: rgba(255, 255, 255, 0.6); border-radius: 20px;
  padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04);
  border: 1.5px solid rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
.form-group { margin-bottom: 1.5rem; }
.form-label { display: block; margin-bottom: .5rem; font-weight: bold; color: var(--gray-700); }
.form-control { width: 100%; padding: .8rem 1rem; border-radius: 12px; border: 1px solid var(--gray-300); font-family: var(--font); }
textarea.form-control { min-height: 150px; resize: vertical; }
.btn-submit { background: linear-gradient(135deg, var(--red), #E53935); color: white; padding: .8rem 2rem; border-radius: 12px; border: none; font-weight: bold; font-family: var(--font); cursor: pointer; transition: .3s; }
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(193,57,43,.3); }
</style>

<div class="page-blobs">
  <div class="pg-blob pg-blob-1"></div>
  <div class="pg-blob pg-blob-2"></div>
</div>

<!-- Overview Tab -->
<div id="overview" class="tab-content active">
    <div class="stats-band">
        <div class="sband-card">
            <div class="sbc-top">
                <div class="sbc-icon" style="background: linear-gradient(135deg, var(--green), var(--green2));"><i class="bi bi-people-fill"></i></div>
            </div>
            <div>
                <div class="sbc-num">1,204</div>
                <div class="sbc-label">إجمالي المستخدمين</div>
            </div>
        </div>
        <div class="sband-card">
            <div class="sbc-top">
                <div class="sbc-icon" style="background: linear-gradient(135deg, var(--orange), var(--orange2));"><i class="bi bi-activity"></i></div>
            </div>
            <div>
                <div class="sbc-num">850</div>
                <div class="sbc-label">نشطون اليوم</div>
            </div>
        </div>
        <div class="sband-card">
            <div class="sbc-top">
                <div class="sbc-icon" style="background: linear-gradient(135deg, var(--red), #E53935);"><i class="bi bi-journal-text"></i></div>
            </div>
            <div>
                <div class="sbc-num">120</div>
                <div class="sbc-label">محتوى تعليمي</div>
            </div>
        </div>
        <div class="sband-card">
            <div class="sbc-top">
                <div class="sbc-icon" style="background: linear-gradient(135deg, var(--purple), #6D28D9);"><i class="bi bi-cash-stack"></i></div>
            </div>
            <div>
                <div class="sbc-num">340</div>
                <div class="sbc-label">اشتراك جديد</div>
            </div>
        </div>
    </div>

    <div class="admin-table-container" style="margin-top: 2rem;">
        <h3 style="margin-bottom: 1rem; color: var(--gray-800);"><i class="bi bi-clock-history"></i> آخر نشاطات النظام</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>المستخدم</th>
                    <th>النشاط</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>أحمد ولي أمر</td>
                    <td>تسجيل حساب طفل جديد (سمير)</td>
                    <td>منذ 10 دقائق</td>
                    <td><span class="status-badge status-active">مكتمل</span></td>
                </tr>
                <tr>
                    <td>محمد علي</td>
                    <td>تحديث بيانات الملف الشخصي</td>
                    <td>منذ 45 دقيقة</td>
                    <td><span class="status-badge status-active">مكتمل</span></td>
                </tr>
                <tr>
                    <td>سارة بن يحي</td>
                    <td>محاولة تسجيل دخول فاشلة</td>
                    <td>منذ ساعتين</td>
                    <td><span class="status-badge status-pending">تنبيه</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Activities Tab -->
<div id="activities" class="tab-content">
    <div class="admin-table-container">
        <h3 style="margin-bottom: 1rem; color: var(--gray-800);"><i class="bi bi-list-check"></i> نشاطات حسابات المستخدمين الشاملة</h3>
        <div class="dt-search" style="margin-bottom: 1.5rem; max-width: 400px; background: var(--gray-50);">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="ابحث عن مستخدم أو نشاط..." style="width:100%;">
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>اسم المستخدم</th>
                    <th>نوع الحساب</th>
                    <th>آخر نشاط</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#10045</td>
                    <td>كريم عبد القادر</td>
                    <td>ولي أمر</td>
                    <td>تسجيل دخول</td>
                    <td>2023-10-12</td>
                    <td><button style="border:none;background:none;color:var(--blue);cursor:pointer;"><i class="bi bi-eye"></i> عرض</button></td>
                </tr>
                <tr>
                    <td>#10046</td>
                    <td>مريم بلقاسم</td>
                    <td>طفل</td>
                    <td>إكمال درس (تاريخ)</td>
                    <td>2023-11-05</td>
                    <td><button style="border:none;background:none;color:var(--blue);cursor:pointer;"><i class="bi bi-eye"></i> عرض</button></td>
                </tr>
                <tr>
                    <td>#10047</td>
                    <td>يوسف علي</td>
                    <td>ولي أمر</td>
                    <td>شراء حزمة</td>
                    <td>2024-01-20</td>
                    <td><button style="border:none;background:none;color:var(--blue);cursor:pointer;"><i class="bi bi-eye"></i> عرض</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Content Tab -->
<div id="content" class="tab-content">
    <div class="editor-container">
        <h3 style="margin-bottom: 1.5rem; color: var(--gray-800);"><i class="bi bi-pencil-square"></i> إضافة/تحديث محتوى تعليمي</h3>
        
        <div class="form-group">
            <label class="form-label">عنوان الدرس / المحتوى</label>
            <input type="text" class="form-control" placeholder="أدخل عنوان الدرس">
        </div>
        
        <div class="form-group">
            <label class="form-label">المادة الدراسية</label>
            <select class="form-control">
                <option>الرياضيات</option>
                <option>التاريخ الجزائري</option>
                <option>اللغة العربية</option>
                <option>التربية الإسلامية</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">محتوى الدرس</label>
            <textarea class="form-control" placeholder="اكتب محتوى الدرس هنا..."></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label">إرفاق وسائط (صورة / فيديو)</label>
            <input type="file" class="form-control" style="padding: .5rem;">
        </div>
        
        <button class="btn-submit" onclick="alert('تم حفظ المحتوى بنجاح!');"><i class="bi bi-save"></i> حفظ المحتوى</button>
    </div>
</div>

<?php require_once __DIR__ . '/../../site/frontend/includes/footer.php'; ?>
