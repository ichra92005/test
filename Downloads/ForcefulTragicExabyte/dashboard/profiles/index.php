<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختيار الملف الشخصي - مقام</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --green: #2C7A51;
            --white: #ffffff;
            --bg: #eaf3ed;
        }
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, var(--bg), #d4ebd9);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        .container {
            text-align: center;
            z-index: 10;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--green);
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .profiles {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .profile {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 2rem;
            width: 150px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(44, 122, 81, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 40px rgba(44, 122, 81, 0.2);
            border-color: var(--green);
        }
        .avatar {
            width: 80px;
            height: 80px;
            background: var(--green);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #222;
        }
        
        /* Parent Access */
        .parent-btn {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(5px);
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid rgba(0,0,0,0.1);
            color: #555;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .parent-btn:hover {
            background: var(--white);
            color: var(--green);
            transform: scale(1.05);
        }
        
        /* Modal */
        #parentModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            z-index: 100;
        }
        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            text-align: center;
        }
        .modal-content h3 {
            margin-top: 0;
            color: var(--green);
            margin-bottom: 1.5rem;
        }
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-family: inherit;
            font-size: 1.1rem;
            outline: none;
            transition: border-color 0.2s;
            margin-bottom: 1rem;
            box-sizing: border-box;
        }
        input[type="password"]:focus {
            border-color: var(--green);
        }
        .modal-btns {
            display: flex;
            gap: 10px;
        }
        .modal-btns button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-submit {
            background: var(--green);
            color: white;
        }
        .btn-submit:hover { background: #236140; }
        .btn-cancel {
            background: #eee;
            color: #555;
        }
        .btn-cancel:hover { background: #ddd; }
        
        #errorMsg {
            color: #dc3545;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>من يلعب الآن؟</h1>
        <div class="profiles" id="profilesContainer">
            <!-- Profiles injected by JS -->
        </div>
    </div>

    <button class="parent-btn" onclick="openParentModal()">
        <i class="bi bi-person-gear"></i> بوابة الولي
    </button>

    <!-- Parent Access Modal -->
    <div id="parentModal">
        <div class="modal-content">
            <h3>وصول الولي</h3>
            <p style="color: #666; margin-bottom: 1.5rem; font-size: 0.9rem;">الرجاء إدخال كلمة المرور الخاصة بحسابك للمتابعة إلى لوحة التحكم.</p>
            <div id="errorMsg">كلمة المرور غير صحيحة</div>
            <input type="password" id="parentPassword" placeholder="كلمة المرور">
            <div class="modal-btns">
                <button class="btn-cancel" onclick="closeParentModal()">إلغاء</button>
                <button class="btn-submit" id="submitBtn" onclick="verifyParent()">متابعة</button>
            </div>
        </div>
    </div>

    <script>
        // Load profiles from session storage
        const userStr = sessionStorage.getItem('makam_user');
        if (!userStr) {
            window.location.href = '/login';
        }
        
        const userData = JSON.parse(userStr);
        if (userData.type !== 'parent') {
            window.location.href = '/login';
        }

        const container = document.getElementById('profilesContainer');
        const children = userData.children || [];

        if (children.length === 0) {
            container.innerHTML = '<p style="color:#555;">لا يوجد أطفال مسجلين. يمكنك إضافتهم من بوابة الولي.</p>';
        } else {
            children.forEach(child => {
                const el = document.createElement('div');
                el.className = 'profile';
                el.onclick = () => loginAsChild(child);
                
                const firstLetter = child.fname.charAt(0);
                
                el.innerHTML = `
                    <div class="avatar">${firstLetter}</div>
                    <div class="name">${child.fname}</div>
                `;
                container.appendChild(el);
            });
        }

        function loginAsChild(child) {
            // Send request to API to register child session and get full child data
            fetch('/api/auth_login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'child', login: child.username, password: child.id })
            })
            .then(res => res.json())
            .then(res => {
                if(res.ok) {
                    sessionStorage.setItem('makam_user', JSON.stringify(res.data));
                    
                    // Categorization logic based on age
                    let age = parseInt(res.data.age) || 0;
                    let cat = 1;
                    if (age >= 8 && age <= 11) cat = 2;
                    else if (age >= 12) cat = 3;
                    
                    window.location.href = '/dashboard/student?category=' + cat;
                } else {
                    alert('تعذر الدخول كـ ' + child.fname);
                }
            })
            .catch(err => {
                alert('حدث خطأ في الاتصال');
            });
        }

        function openParentModal() {
            document.getElementById('parentModal').style.display = 'flex';
            document.getElementById('parentPassword').value = '';
            document.getElementById('errorMsg').style.display = 'none';
            document.getElementById('parentPassword').focus();
        }

        function closeParentModal() {
            document.getElementById('parentModal').style.display = 'none';
        }

        function verifyParent() {
            const pass = document.getElementById('parentPassword').value;
            if (!pass) return;
            
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = 'جاري التحقق...';
            btn.disabled = true;

            fetch('/api/auth_login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'parent', login: userData.email, password: pass })
            })
            .then(res => res.json())
            .then(res => {
                btn.innerHTML = 'متابعة';
                btn.disabled = false;
                
                if (res.ok) {
                    window.location.href = '/dashboard/parent/index.php';
                } else {
                    document.getElementById('errorMsg').style.display = 'block';
                    document.getElementById('errorMsg').innerText = res.error || 'كلمة المرور غير صحيحة';
                }
            })
            .catch(err => {
                btn.innerHTML = 'متابعة';
                btn.disabled = false;
                document.getElementById('errorMsg').style.display = 'block';
                document.getElementById('errorMsg').innerText = 'حدث خطأ في الاتصال';
            });
        }
    </script>
</body>
</html>
