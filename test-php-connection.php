<?php

$host = 'da1.eurodns.top';
$port = 3306;
$database = 'ebrahims_Website';
$username = 'ebrahims_Website';
$password = 'Hima0900856660@#@#$';

echo "🔍 محاولة الاتصال بقاعدة البيانات...\n";
echo "Host: $host\n";
echo "Database: $database\n";
echo "User: $username\n\n";

try {
    echo "⏳ جاري الاتصال...\n";
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 10,
    ]);
    
    echo "✅ الاتصال نجح!\n\n";
    
    // اختبار استعلام بسيط
    echo "📊 اختبار استعلام بسيط...\n";
    $stmt = $pdo->query('SELECT 1 as test');
    $result = $stmt->fetch();
    echo "✅ الاستعلام نجح! النتيجة: " . json_encode($result) . "\n\n";
    
    // عرض الجداول
    echo "📋 الجداول في قاعدة البيانات:\n";
    $stmt = $pdo->query('SHOW TABLES');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "عدد الجداول: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "   - $table\n";
    }
    echo "\n";
    
    // اختبار عدد السجلات
    $testTables = ['users', 'services', 'projects', 'blog_posts', 'technologies', 'contact_messages'];
    echo "📊 عدد السجلات في الجداول:\n";
    foreach ($testTables as $table) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM `$table`");
            $count = $stmt->fetch()['count'];
            echo "   $table: $count سجل\n";
        } catch (PDOException $e) {
            if ($e->getCode() == '42S02') {
                echo "   $table: ⚠️ الجدول غير موجود\n";
            } else {
                echo "   $table: ❌ خطأ - " . $e->getMessage() . "\n";
            }
        }
    }
    
    echo "\n✅ جميع الاختبارات نجحت!\n";
    
} catch (PDOException $e) {
    echo "❌ خطأ في الاتصال:\n";
    echo "   الكود: " . $e->getCode() . "\n";
    echo "   الرسالة: " . $e->getMessage() . "\n\n";
    
    if ($e->getCode() == 1045) {
        echo "💡 الحل: خطأ في اسم المستخدم أو كلمة المرور\n";
        echo "   - تحقق من اسم المستخدم\n";
        echo "   - تحقق من كلمة المرور\n";
        echo "   - تحقق من صلاحيات المستخدم\n";
    } elseif ($e->getCode() == 2002) {
        echo "💡 الحل: الخادم غير متاح أو المنفذ مغلق\n";
    } elseif ($e->getCode() == 1049) {
        echo "💡 الحل: قاعدة البيانات غير موجودة\n";
    }
    
    exit(1);
}

