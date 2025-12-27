# دليل النشر على Dokploy - Laravel Application

## المتغيرات البيئية المطلوبة

أضف هذه المتغيرات في إعدادات Dokploy (Environment Variables):

### متغيرات التطبيق الأساسية
```env
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-domain.com
```

**ملاحظة مهمة:** قم بتوليد `APP_KEY` باستخدام:
```bash
php artisan key:generate --show
```

### متغيرات قاعدة البيانات
```env
DB_CONNECTION=mysql
DB_HOST=your-mysql-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

**إذا كنت تستخدم قاعدة بيانات من Dokploy:**
- أنشئ قاعدة بيانات MySQL من داخل Dokploy
- استخدم اسم الخدمة كـ `DB_HOST` (مثل: `mysql-service`)
- أو استخدم IP الداخلي للحاوية

### متغيرات الجلسات والكاش
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false

CACHE_STORE=file
QUEUE_CONNECTION=database
```

### متغيرات السجلات
```env
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### متغيرات إضافية (اختيارية)
```env
APP_LOCALE=ar
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

FILESYSTEM_DISK=local
```

## خطوات النشر

### 1. إعداد المشروع في Dokploy

1. سجل الدخول إلى Dokploy
2. افتح المشروع: `http://31.97.37.248:3000/dashboard/project/xmA1487qrC_p3xbtzHQrA`
3. افتح Environment: `1FZzaj5deudd8t6TKGEp3`
4. افتح Service: `-Q8v3Oz9jBE1aTYobOsC2`

### 2. إعداد Git Repository

- تأكد من ربط المستودع بشكل صحيح
- تأكد من أن الفرع (Branch) صحيح (عادة `main` أو `master`)

### 3. إعداد Build

- **Build Type:** Nixpacks
- **Build Command:** (يتم استخدام nixpacks.toml تلقائياً)
- **Start Command:** (يتم استخدام nixpacks.toml تلقائياً)

### 4. إضافة متغيرات البيئة

1. اذهب إلى تبويب **Environment Variables**
2. أضف جميع المتغيرات المذكورة أعلاه
3. تأكد من أن `APP_KEY` موجود وصحيح
4. تأكد من أن `DB_*` متغيرات صحيحة

### 5. إعداد قاعدة البيانات

#### إذا كنت تستخدم قاعدة بيانات من Dokploy:

1. أنشئ قاعدة بيانات MySQL من داخل Dokploy
2. احصل على معلومات الاتصال:
   - **Host:** اسم الخدمة (مثل: `mysql-service`) أو IP
   - **Port:** 3306
   - **Database:** اسم قاعدة البيانات
   - **Username:** اسم المستخدم
   - **Password:** كلمة المرور

3. أضفها كمتغيرات بيئة في التطبيق

#### إذا كنت تستخدم قاعدة بيانات خارجية:

- استخدم معلومات الاتصال من مزود قاعدة البيانات
- تأكد من أن قاعدة البيانات متاحة من خادم Dokploy

### 6. تشغيل Migrations

بعد النشر الأول، قم بتشغيل migrations:

**الطريقة 1: من Terminal في Dokploy**
```bash
php artisan migrate --force
```

**الطريقة 2: إضافة أمر في nixpacks.toml (اختياري)**
يمكنك إضافة الأمر في مرحلة build، لكن يُفضل تشغيله يدوياً أول مرة.

### 7. النشر

1. اضغط على **Deploy** أو **Redeploy**
2. انتظر حتى يكتمل البناء
3. تحقق من Logs للتأكد من عدم وجود أخطاء

## التحقق من النشر

### 1. Health Check
- افتح: `https://your-domain.com/up`
- يجب أن يعيد: `{"status":"ok"}`

### 2. فحص Logs
- اذهب إلى تبويب **Logs** في Dokploy
- ابحث عن أخطاء أو تحذيرات

### 3. فحص التطبيق
- افتح الموقع في المتصفح
- تحقق من أن الصفحة الرئيسية تعمل

## استكشاف الأخطاء

### Bad Gateway (502)

**الأسباب المحتملة:**
1. التطبيق لا يعمل على المنفذ الصحيح
2. `PORT` متغير غير موجود
3. مشكلة في start command

**الحل:**
- تأكد من أن `PORT` متغير موجود (عادة يتم تعيينه تلقائياً)
- تحقق من Logs لمعرفة الخطأ الدقيق
- تأكد من أن start command في nixpacks.toml صحيح

### خطأ في الاتصال بقاعدة البيانات

**الأسباب المحتملة:**
1. معلومات الاتصال خاطئة
2. قاعدة البيانات غير متاحة
3. IP غير مسموح

**الحل:**
- تحقق من متغيرات `DB_*`
- تأكد من أن قاعدة البيانات تعمل
- إذا كانت قاعدة البيانات في Dokploy، استخدم اسم الخدمة كـ host

### خطأ في APP_KEY

**الحل:**
```bash
php artisan key:generate --show
```
ثم أضف المفتاح كمتغير `APP_KEY` في Dokploy

### خطأ في الصلاحيات

**الحل:**
- تأكد من أن nixpacks.toml يحتوي على:
```toml
chmod -R 775 storage bootstrap/cache
```

## الملفات المهمة

- `nixpacks.toml` - إعدادات البناء
- `.dockerignore` - الملفات المستبعدة
- `dokploy.json` - إعدادات إضافية (اختياري)

## نصائح مهمة

1. **لا ترفع ملف `.env`** إلى Git
2. **استخدم `APP_DEBUG=false`** في الإنتاج
3. **احفظ `APP_KEY`** بشكل آمن
4. **راقب Logs** بانتظام
5. **قم بعمل Backup** لقاعدة البيانات بانتظام

## الدعم

إذا واجهت مشاكل:
1. راجع ملف `DOKPLOY_TROUBLESHOOTING.md`
2. تحقق من Logs في Dokploy
3. راجع [وثائق Dokploy](https://docs.dokploy.com)

