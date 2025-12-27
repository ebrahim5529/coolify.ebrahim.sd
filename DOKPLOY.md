# إعداد النشر على Dokploy

هذا المشروع جاهز للنشر على Dokploy باستخدام Nixpacks.

## المتطلبات

- حساب على Dokploy
- قاعدة بيانات MySQL (يمكن إنشاؤها من داخل Dokploy)
- متغيرات البيئة المطلوبة

## خطوات النشر

### 1. إعداد المشروع في Dokploy

1. قم بإنشاء مشروع جديد في Dokploy
2. اختر "Git Repository" واربط المستودع
3. اختر "Nixpacks" كطريقة البناء

### 2. متغيرات البيئة المطلوبة

قم بإضافة المتغيرات التالية في إعدادات المشروع:

```env
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_STORE=file
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

### 3. إعداد قاعدة البيانات

1. أنشئ قاعدة بيانات MySQL من داخل Dokploy
2. احصل على معلومات الاتصال (Host, Port, Database, Username, Password)
3. أضفها كمتغيرات بيئة في المشروع

### 4. تشغيل Migrations

بعد النشر الأول، قم بتشغيل migrations:

```bash
php artisan migrate --force
```

يمكنك القيام بذلك من خلال:
- SSH إلى الحاوية
- أو إضافة أمر في مرحلة build في nixpacks.toml

### 5. إعدادات إضافية

- **Storage Link**: يتم إنشاء الرابط تلقائياً في مرحلة build
- **Permissions**: يتم تعيين الصلاحيات تلقائياً
- **Cache**: يتم تحسين الأداء تلقائياً

## الملفات المهمة

- `nixpacks.toml` - إعدادات البناء
- `.dockerignore` - الملفات المستبعدة من البناء
- `dokploy.json` - إعدادات إضافية لـ Dokploy (اختياري)

## استكشاف الأخطاء

### خطأ 502 Bad Gateway
- تأكد من أن التطبيق يعمل على المنفذ الصحيح
- تحقق من متغير `PORT` في Dokploy

### خطأ في الاتصال بقاعدة البيانات
- تحقق من متغيرات البيئة
- تأكد من أن قاعدة البيانات متاحة من الحاوية

### خطأ في الصلاحيات
- تأكد من أن مجلدات `storage` و `bootstrap/cache` لديها الصلاحيات الصحيحة

## ملاحظات

- يتم بناء الأصول (assets) تلقائياً أثناء البناء
- يتم تحسين الأداء تلقائياً (config cache, route cache, view cache)
- التطبيق يعمل على PHP 8.2 و Node.js 20

