<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Technology;
use App\Models\User;
use App\Models\ContactMessage;

// الاتصال بقاعدة البيانات المحلية (SQLite)
$sqlitePath = __DIR__ . '/database/database.sqlite';
if (!file_exists($sqlitePath)) {
    die("❌ ملف قاعدة البيانات SQLite غير موجود\n");
}

$sqlite = new PDO("sqlite:{$sqlitePath}");
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "🔄 بدء نقل البيانات من SQLite إلى MySQL...\n\n";

// نقل الخدمات
try {
    $services = $sqlite->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($services as $service) {
        Service::updateOrCreate(['id' => $service['id']], [
            'title' => $service['title'],
            'description' => $service['description'],
            'icon' => $service['icon'] ?? 'Code',
            'order' => $service['order'] ?? 0,
            'created_at' => $service['created_at'] ?? now(),
            'updated_at' => $service['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($services) . " خدمة\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل الخدمات: " . $e->getMessage() . "\n";
}

// نقل المشاريع
try {
    $projects = $sqlite->query("SELECT * FROM projects")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($projects as $project) {
        Project::updateOrCreate(['id' => $project['id']], [
            'title' => $project['title'],
            'description' => $project['description'],
            'image' => $project['image'] ?? null,
            'technologies' => $project['technologies'] ?? null,
            'demo_url' => $project['demo_url'] ?? null,
            'github_url' => $project['github_url'] ?? null,
            'order' => $project['order'] ?? 0,
            'created_at' => $project['created_at'] ?? now(),
            'updated_at' => $project['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($projects) . " مشروع\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل المشاريع: " . $e->getMessage() . "\n";
}

// نقل مقالات المدونة
try {
    $posts = $sqlite->query("SELECT * FROM blog_posts")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($posts as $post) {
        BlogPost::updateOrCreate(['id' => $post['id']], [
            'title' => $post['title'],
            'slug' => $post['slug'],
            'description' => $post['description'],
            'content' => $post['content'] ?? '',
            'image' => $post['image'] ?? null,
            'category' => $post['category'] ?? 'عام',
            'date' => $post['date'] ?? now(),
            'read_time' => $post['read_time'] ?? '5 دقائق',
            'keywords' => $post['keywords'] ?? null,
            'published' => $post['published'] ?? true,
            'created_at' => $post['created_at'] ?? now(),
            'updated_at' => $post['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($posts) . " مقال\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل المقالات: " . $e->getMessage() . "\n";
}

// نقل التقنيات
try {
    $technologies = $sqlite->query("SELECT * FROM technologies")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($technologies as $tech) {
        Technology::updateOrCreate(['id' => $tech['id']], [
            'name' => $tech['name'],
            'icon' => $tech['icon'] ?? '',
            'color' => $tech['color'] ?? '#000000',
            'category' => $tech['category'] ?? null,
            'order' => $tech['order'] ?? 0,
            'created_at' => $tech['created_at'] ?? now(),
            'updated_at' => $tech['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($technologies) . " تقنية\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل التقنيات: " . $e->getMessage() . "\n";
}

// نقل المستخدمين
try {
    $users = $sqlite->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        User::updateOrCreate(['id' => $user['id']], [
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'email_verified_at' => $user['email_verified_at'] ?? null,
            'created_at' => $user['created_at'] ?? now(),
            'updated_at' => $user['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($users) . " مستخدم\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل المستخدمين: " . $e->getMessage() . "\n";
}

// نقل الرسائل
try {
    $messages = $sqlite->query("SELECT * FROM contact_messages")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($messages as $message) {
        ContactMessage::updateOrCreate(['id' => $message['id']], [
            'name' => $message['name'],
            'email' => $message['email'],
            'message' => $message['message'],
            'created_at' => $message['created_at'] ?? now(),
            'updated_at' => $message['updated_at'] ?? now(),
        ]);
    }
    echo "✅ تم نقل " . count($messages) . " رسالة\n";
} catch (Exception $e) {
    echo "⚠️ خطأ في نقل الرسائل: " . $e->getMessage() . "\n";
}

echo "\n✅ تم نقل جميع البيانات بنجاح!\n";




