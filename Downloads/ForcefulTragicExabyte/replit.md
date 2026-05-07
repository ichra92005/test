# MAKAM — مكام | منصة التعليم الجزائرية للأطفال

منصة تعليمية جزائرية تفاعلية للأطفال من 6 إلى 15 سنة، تجمع بين المتعة والتعلم بتصميم جزائري أصيل.

## Run & Operate
- **Start**: `php -S 0.0.0.0:5000 server.php`
- **Port**: 5000

## Stack
- **Backend**: PHP 8.2 (built-in dev server)
- **Frontend**: HTML5, CSS3 (inline per page), Vanilla JS
- **Fonts**: Cairo + Tajawal (Google Fonts)
- **Router**: `server.php` — custom PHP router

## Where things live
```
index.php                          ← الصفحة الرئيسية (landing page كاملة)
server.php                         ← الراوتر الرئيسي
register/index.php                 ← تسجيل ولي الأمر + الطفل (3 خطوات)
login/index.php                    ← تسجيل دخول (ولي أمر / طفل)
error/404.php                      ← صفحة الخطأ 404
site/
  frontend/
    config/config.php              ← إعدادات الموقع (اسم, ألوان, مواد, شارات...)
    includes/
      header.php                   ← رأس الصفحة المشترك
      footer.php                   ← ذيل الصفحة المشترك
```

## Architecture decisions
- **JSON Database** — قاعدة بيانات JSON حقيقية في `site/backend/database/users/`
- **CSS inline في كل صفحة** لتجنب ملفات CSS خارجية وتسريع التحميل
- **PHP includes** لفصل header/footer عن محتوى الصفحات
- **RTL بالكامل** (العربية)، خط Cairo + Tajawal
- **ألوان العلم الجزائري**: أخضر #006233 + أبيض + أحمر #D21034 + ذهبي #FFD700
- **config.php** يحتوي جميع ثوابت الموقع (MAKAM_*) والمصفوفات (مواد، شارات)

## Database
```
site/backend/database/users/
  parents.json    ← بيانات أولياء الأمور (id 8 أرقام، اسم، بريد، كلمة مرور مشفرة، قائمة أطفال)
  children.json   ← بيانات الأطفال (id 8 أرقام، parent_id يربطهم بالوالد، username)
```

**بنية ولي الأمر**: `id` (8 أرقام عشوائية)، `fname`، `lname`، `email`، `password` (bcrypt)، `children_ids[]`
**بنية الطفل**: `id` (8 أرقام)، `parent_id` (ربط بالوالد)، `fname`، `lname`، `age`، `username` (اسم+id)
**كلمة سر الطفل**: رقمه الثماني (`id`) — يُعرض للوالد بعد التسجيل

## API
```
site/backend/api/
  auth_register.php   ← POST /api/auth_register — تسجيل ولي أمر + طفل
  auth_login.php      ← POST /api/auth_login    — دخول (type: parent | child)
```

## Product
- **الصفحة الرئيسية**: Hero + إحصائيات + ٦ مواد + كيف تعمل + المميزات + شارات + آراء + CTA
- **التسجيل**: نموذج ٣ خطوات (معلومات ولي الأمر → كلمة المرور + الطفل → تأكيد)
- **تسجيل الدخول**: تبويبان (ولي أمر / طفل)
- **٦ مواد**: رياضيات، عربية، علوم، تاريخ وجغرافيا، فرنسية، تربية فنية
- **نظام شارات**: المبتدئ → النجم الصاعد → المتعلم المثابر → بطل الجزائر

## User preferences
- Frontend فقط، لا backend حقيقي
- CSS في نفس الصفحة (inline)
- Header و Footer في `site/frontend/includes/`
- معلومات الموقع في `site/frontend/config/config.php`
- محتوى جزائري ١٠٠٪ (عربية، RTL، علم جزائري)
- تصميم مناسب للأطفال وأولياء الأمور، متجاوب لجميع الأجهزة

## Gotchas
- `server.php` يتحقق من وجود `site/backend/api/_helpers.php` قبل استدعائه
- جميع صفحات الحساب (register, login) تحتوي CSS خاصة بها inline
- صفحة 404 في `error/404.php` — يستدعيها server.php في النهاية
- لإضافة صفحة جديدة: أضفها في `$routes` في server.php
