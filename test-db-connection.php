<?php

$config = [
    'host' => 'da1.eurodns.top',
    'port' => 3306,
    'database' => 'ebrahims_Website',
    'user' => 'ebrahims_Website',
    'password' => 'Hima0900856660@#@#$',
];

echo "🔍 محاولة الاتصال بقاعدة البيانات...\n";
echo "Host: {$config['host']}\n";
echo "Database: {$config['database']}\n";
echo "User: {$config['user']}\n";
echo "\n";

try {
    echo "⏳ جاري الاتصال...\n";
    
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 10,
    ];
    
    $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
    echo "✅ الاتصال نجح!\n";
    
    $stmt = $pdo->query('SELECT 1 as test');
    $result = $stmt->fetch();
    echo "✅ الاستعلام نجح!\n";
    
    $stmt = $pdo->query('SHOW TABLES');
    $tables = $stmt->fetchAll();
    echo "📋 عدد الجداول: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "   - " . array_values($table)[0] . "\n";
    }
    
    echo "✅ جميع الاختبارات نجحت!\n";
} catch (PDOException $e) {
    echo "❌ خطأ:\n";
    echo "   الكود: {$e->getCode()}\n";
    echo "   الرسالة: {$e->getMessage()}\n";
    echo "   الملف: {$e->getFile()}\n";
    echo "   السطر: {$e->getLine()}\n";
}




