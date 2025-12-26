<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Technology;
use App\Models\ContactMessage;
use Exception;

class ImportDataFromBackendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔄 بدء استيراد البيانات من قاعدة البيانات البعيدة...');
        
        // إعدادات الاتصال بقاعدة البيانات البعيدة
        $remoteConfig = [
            'host' => 'da1.eurodns.top',
            'port' => 3306,
            'database' => 'ebrahims_Website',
            'username' => 'ebrahims_Website',
            'password' => 'Hima0900856660@#@#$',
        ];

        try {
            // الاتصال بقاعدة البيانات البعيدة
            $this->command->info('⏳ محاولة الاتصال بقاعدة البيانات البعيدة...');
            $remoteConnection = $this->connectToRemoteDatabase($remoteConfig);
            
            if (!$remoteConnection) {
                $this->command->warn('⚠️ فشل الاتصال بقاعدة البيانات البعيدة. سيتم استخدام بيانات تجريبية.');
                $this->seedSampleData();
                return;
            }

            $this->command->info('✅ تم الاتصال بقاعدة البيانات البعيدة بنجاح!');
            
            // استيراد البيانات
            $this->importServices($remoteConnection);
            $this->importProjects($remoteConnection);
            $this->importBlogPosts($remoteConnection);
            $this->importTechnologies($remoteConnection);
            $this->importContactMessages($remoteConnection);
            
            $this->command->info('✅ تم استيراد جميع البيانات بنجاح!');
            
        } catch (Exception $e) {
            $this->command->error('❌ خطأ في الاستيراد: ' . $e->getMessage());
            $this->command->warn('⚠️ سيتم استخدام بيانات تجريبية بدلاً من ذلك.');
            $this->seedSampleData();
        }
    }

    /**
     * الاتصال بقاعدة البيانات البعيدة
     */
    private function connectToRemoteDatabase(array $config)
    {
        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4";
            $pdo = new \PDO($dsn, $config['username'], $config['password'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_TIMEOUT => 10,
            ]);
            return $pdo;
        } catch (\PDOException $e) {
            $this->command->warn('⚠️ فشل الاتصال: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * استيراد الخدمات
     */
    private function importServices($connection)
    {
        try {
            $this->command->info('📦 استيراد الخدمات...');
            $services = $connection->query("SELECT * FROM services ORDER BY `order`")->fetchAll();
            
            foreach ($services as $service) {
                Service::updateOrCreate(
                    ['id' => $service['id']],
                    [
                        'title' => $service['title'],
                        'description' => $service['description'],
                        'icon' => $service['icon'] ?? 'Code',
                        'order' => $service['order'] ?? 0,
                        'created_at' => $service['created_at'] ?? now(),
                        'updated_at' => $service['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم استيراد " . count($services) . " خدمة");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في استيراد الخدمات: " . $e->getMessage());
        }
    }

    /**
     * استيراد المشاريع
     */
    private function importProjects($connection)
    {
        try {
            $this->command->info('📦 استيراد المشاريع...');
            $projects = $connection->query("SELECT * FROM projects ORDER BY `order`")->fetchAll();
            
            foreach ($projects as $project) {
                $technologies = $project['technologies'] ?? null;
                if ($technologies && !is_array($technologies)) {
                    $technologies = json_decode($technologies, true);
                }
                
                Project::updateOrCreate(
                    ['id' => $project['id']],
                    [
                        'title' => $project['title'],
                        'description' => $project['description'],
                        'image' => $project['image'] ?? null,
                        'technologies' => $technologies ? json_encode($technologies) : null,
                        'demo_url' => $project['demo_url'] ?? null,
                        'github_url' => $project['github_url'] ?? null,
                        'order' => $project['order'] ?? 0,
                        'created_at' => $project['created_at'] ?? now(),
                        'updated_at' => $project['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم استيراد " . count($projects) . " مشروع");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في استيراد المشاريع: " . $e->getMessage());
        }
    }

    /**
     * استيراد مقالات المدونة
     */
    private function importBlogPosts($connection)
    {
        try {
            $this->command->info('📦 استيراد مقالات المدونة...');
            $posts = $connection->query("SELECT * FROM blog_posts ORDER BY date DESC")->fetchAll();
            
            foreach ($posts as $post) {
                BlogPost::updateOrCreate(
                    ['id' => $post['id']],
                    [
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
                    ]
                );
            }
            $this->command->info("✅ تم استيراد " . count($posts) . " مقال");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في استيراد المقالات: " . $e->getMessage());
        }
    }

    /**
     * استيراد التقنيات
     */
    private function importTechnologies($connection)
    {
        try {
            $this->command->info('📦 استيراد التقنيات...');
            $technologies = $connection->query("SELECT * FROM technologies ORDER BY `order`")->fetchAll();
            
            foreach ($technologies as $tech) {
                Technology::updateOrCreate(
                    ['id' => $tech['id']],
                    [
                        'name' => $tech['name'],
                        'icon' => $tech['icon'] ?? '',
                        'color' => $tech['color'] ?? '#000000',
                        'category' => $tech['category'] ?? null,
                        'order' => $tech['order'] ?? 0,
                        'created_at' => $tech['created_at'] ?? now(),
                        'updated_at' => $tech['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم استيراد " . count($technologies) . " تقنية");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في استيراد التقنيات: " . $e->getMessage());
        }
    }

    /**
     * استيراد الرسائل
     */
    private function importContactMessages($connection)
    {
        try {
            $this->command->info('📦 استيراد الرسائل...');
            $messages = $connection->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
            
            foreach ($messages as $message) {
                ContactMessage::updateOrCreate(
                    ['id' => $message['id']],
                    [
                        'name' => $message['name'],
                        'email' => $message['email'],
                        'message' => $message['message'],
                        'read' => $message['read'] ?? false,
                        'created_at' => $message['created_at'] ?? now(),
                        'updated_at' => $message['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم استيراد " . count($messages) . " رسالة");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في استيراد الرسائل: " . $e->getMessage());
        }
    }

    /**
     * إدراج بيانات تجريبية في حالة فشل الاتصال
     */
    private function seedSampleData()
    {
        $this->command->info('📝 إدراج بيانات من seeders الـ backend...');
        
        // الخدمات
        $services = [
            ['title' => 'تطوير أنظمة ويب مخصصة', 'description' => 'بناء أنظمة إدارية ومحاسبية وخدمية متكاملة تلبي احتياجاتك الخاصة', 'icon' => 'Code', 'order' => 1],
            ['title' => 'متاجر إلكترونية', 'description' => 'إنشاء متاجر إلكترونية احترافية مع أنظمة دفع آمنة ولوحة تحكم شاملة', 'icon' => 'ShoppingCart', 'order' => 2],
            ['title' => 'حلول الذكاء الاصطناعي', 'description' => 'تطوير تطبيقات ذكية باستخدام AI وتعلم الآلة لأتمتة العمليات وتحليل البيانات', 'icon' => 'Brain', 'order' => 3],
            ['title' => 'الأتمتة والتكامل', 'description' => 'أتمتة سير العمل وربط الأنظمة المختلفة لتحسين الكفاءة وتقليل الأخطاء', 'icon' => 'Zap', 'order' => 4],
            ['title' => 'تصميم واجهات المستخدم', 'description' => 'تصميم واجهات حديثة ومتجاوبة (UI/UX) توفر تجربة مستخدم مميزة', 'icon' => 'Palette', 'order' => 5],
            ['title' => 'مواقع تعريفية احترافية', 'description' => 'تصميم مواقع تعريفية للشركات والأفراد تعكس هويتك الرقمية', 'icon' => 'Server', 'order' => 6],
            ['title' => 'تطوير RESTful APIs', 'description' => 'بناء واجهات برمجية قوية وربط الأنظمة مع قواعد البيانات بكفاءة', 'icon' => 'Database', 'order' => 7],
            ['title' => 'صيانة وتحسين الأداء', 'description' => 'صيانة الأنظمة الحالية وتحسين أدائها وتخصيصها حسب احتياجاتك', 'icon' => 'Wrench', 'order' => 8],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
        $this->command->info("✅ تم إدراج " . count($services) . " خدمة");

        // المشاريع
        $projects = [
            ['title' => 'نظام إدارة المخزون', 'description' => 'نظام متكامل لإدارة المخزون والمبيعات مع تقارير تفصيلية ولوحة تحكم تفاعلية', 'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=500&fit=crop', 'technologies' => json_encode(['Laravel', 'React', 'MySQL', 'Tailwind CSS']), 'demo_url' => '#', 'github_url' => '#', 'order' => 1],
            ['title' => 'متجر إلكتروني متكامل', 'description' => 'منصة تجارة إلكترونية مع نظام دفع آمن وإدارة طلبات متطورة', 'image' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=800&h=500&fit=crop', 'technologies' => json_encode(['PHP', 'Laravel', 'Bootstrap', 'Stripe']), 'demo_url' => '#', 'github_url' => '#', 'order' => 2],
            ['title' => 'لوحة تحكم تحليلية', 'description' => 'نظام متقدم لتحليل البيانات وعرض الإحصائيات بشكل مرئي وتفاعلي', 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=500&fit=crop', 'technologies' => json_encode(['React', 'TypeScript', 'Chart.js', 'REST API']), 'demo_url' => '#', 'github_url' => '#', 'order' => 3],
            ['title' => 'نظام حجز المواعيد', 'description' => 'تطبيق لإدارة المواعيد والحجوزات مع تنبيهات آلية وتكامل مع التقويم', 'image' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&h=500&fit=crop', 'technologies' => json_encode(['Laravel', 'Vue.js', 'MySQL', 'WebSocket']), 'demo_url' => '#', 'github_url' => '#', 'order' => 4],
            ['title' => 'منصة تعليمية تفاعلية', 'description' => 'نظام إدارة تعليمي شامل مع إمكانية البث المباشر واختبارات إلكترونية', 'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&h=500&fit=crop', 'technologies' => json_encode(['React', 'Node.js', 'MongoDB', 'Socket.io']), 'demo_url' => '#', 'github_url' => '#', 'order' => 5],
            ['title' => 'تطبيق إدارة المشاريع', 'description' => 'أداة احترافية لإدارة المشاريع والمهام مع نظام تتبع الوقت', 'image' => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=800&h=500&fit=crop', 'technologies' => json_encode(['Laravel', 'React', 'PostgreSQL', 'Redis']), 'demo_url' => '#', 'github_url' => '#', 'order' => 6],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
        $this->command->info("✅ تم إدراج " . count($projects) . " مشروع");

        // التقنيات
        $technologies = [
            ['name' => 'Laravel', 'icon' => 'https://laravel.com/img/logomark.min.svg', 'color' => '#FF2D20', 'category' => 'Backend', 'order' => 1],
            ['name' => 'React', 'icon' => 'https://react.dev/favicon-192x192.png', 'color' => '#61DAFB', 'category' => 'Frontend', 'order' => 2],
            ['name' => 'TypeScript', 'icon' => 'https://www.typescriptlang.org/favicon-32x32.png', 'color' => '#3178C6', 'category' => 'Language', 'order' => 3],
            ['name' => 'MySQL', 'icon' => 'https://www.mysql.com/common/logos/logo-mysql-170x115.png', 'color' => '#4479A1', 'category' => 'Database', 'order' => 4],
            ['name' => 'PHP', 'icon' => 'https://www.php.net/favicon.ico', 'color' => '#777BB4', 'category' => 'Backend', 'order' => 5],
            ['name' => 'JavaScript', 'icon' => 'https://www.javascript.com/favicon.ico', 'color' => '#F7DF1E', 'category' => 'Language', 'order' => 6],
            ['name' => 'Tailwind CSS', 'icon' => 'https://tailwindcss.com/favicon-32x32.png', 'color' => '#06B6D4', 'category' => 'Frontend', 'order' => 7],
            ['name' => 'Vue.js', 'icon' => 'https://vuejs.org/favicon.ico', 'color' => '#4FC08D', 'category' => 'Frontend', 'order' => 8],
        ];

        foreach ($technologies as $tech) {
            Technology::firstOrCreate(
                ['name' => $tech['name']],
                $tech
            );
        }
        $this->command->info("✅ تم إدراج " . count($technologies) . " تقنية");

        // مقالات المدونة
        $posts = [
            [
                'title' => 'أفضل ممارسات تطوير تطبيقات الويب الحديثة',
                'slug' => 'best-practices-web-development',
                'description' => 'تعرف على أحدث التقنيات والأدوات المستخدمة في تطوير تطبيقات الويب الاحترافية',
                'content' => '<h2>مقدمة</h2><p>في عالم تطوير الويب المتسارع، أصبح من الضروري اتباع أفضل الممارسات لضمان بناء تطبيقات ويب عالية الجودة وقابلة للصيانة.</p>',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=600&fit=crop',
                'category' => 'تطوير الويب',
                'date' => '2024-03-15',
                'read_time' => '5 دقائق',
                'keywords' => 'تطوير الويب, أفضل الممارسات, تطبيقات حديثة, React, TypeScript',
                'published' => true,
            ],
            [
                'title' => 'كيفية تحسين أداء موقعك الإلكتروني',
                'slug' => 'website-performance-optimization',
                'description' => 'نصائح عملية لتحسين سرعة تحميل وأداء موقعك الإلكتروني',
                'content' => '<h2>لماذا الأداء مهم؟</h2><p>الأداء الجيد لموقعك الإلكتروني ليس مجرد رفاهية، بل عامل حاسم في نجاح موقعك.</p>',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&h=600&fit=crop',
                'category' => 'تحسين الأداء',
                'date' => '2024-03-10',
                'read_time' => '7 دقائق',
                'keywords' => 'تحسين الأداء, سرعة الموقع, تحسين محركات البحث, Web Performance',
                'published' => true,
            ],
            [
                'title' => 'مقدمة في Laravel وبناء APIs قوية',
                'slug' => 'laravel-api-development',
                'description' => 'دليل شامل لبناء واجهات برمجية احترافية باستخدام Laravel',
                'content' => '<h2>لماذا Laravel؟</h2><p>Laravel هو أحد أشهر أطر عمل PHP وأكثرها شعبية.</p>',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1200&h=600&fit=crop',
                'category' => 'Backend',
                'date' => '2024-03-05',
                'read_time' => '10 دقائق',
                'keywords' => 'Laravel, API, RESTful, Backend Development, PHP',
                'published' => true,
            ],
            [
                'title' => 'React.js: بناء واجهات مستخدم تفاعلية',
                'slug' => 'react-interactive-ui',
                'description' => 'تعلم كيفية إنشاء مكونات React قابلة لإعادة الاستخدام',
                'content' => '<h2>مقدمة في React</h2><p>React هي مكتبة JavaScript لبناء واجهات المستخدم.</p>',
                'image' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=1200&h=600&fit=crop',
                'category' => 'Frontend',
                'date' => '2024-02-28',
                'read_time' => '8 دقائق',
                'keywords' => 'React, Frontend, JavaScript, UI Components',
                'published' => true,
            ],
            [
                'title' => 'أمان تطبيقات الويب: الأساسيات',
                'slug' => 'web-security-basics',
                'description' => 'كيف تحمي تطبيقك من الثغرات الأمنية الشائعة',
                'content' => '<h2>أهمية أمان تطبيقات الويب</h2><p>في عصر التحول الرقمي، أصبح أمان تطبيقات الويب أمراً بالغ الأهمية.</p>',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=1200&h=600&fit=crop',
                'category' => 'الأمان',
                'date' => '2024-02-20',
                'read_time' => '6 دقائق',
                'keywords' => 'أمان الويب, حماية التطبيقات, XSS, CSRF, SQL Injection',
                'published' => true,
            ],
            [
                'title' => 'التصميم المتجاوب: دليل شامل',
                'slug' => 'responsive-design-guide',
                'description' => 'أفضل الممارسات لإنشاء تصاميم تعمل على جميع الأجهزة',
                'content' => '<h2>ما هو التصميم المتجاوب؟</h2><p>التصميم المتجاوب يضمن أن موقعك يعمل بشكل مثالي على جميع الأجهزة.</p>',
                'image' => 'https://images.unsplash.com/photo-1559028012-481c04fa702d?w=1200&h=600&fit=crop',
                'category' => 'UI/UX',
                'date' => '2024-02-15',
                'read_time' => '9 دقائق',
                'keywords' => 'Responsive Design, UI/UX, Mobile First, CSS Grid, Flexbox',
                'published' => true,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::firstOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
        $this->command->info("✅ تم إدراج " . count($posts) . " مقال");

        // إنشاء مستخدم admin
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'ebrahim5529@gmail.com'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $this->command->info("✅ تم إنشاء مستخدم Admin");

        $this->command->info('✅ تم إدراج جميع البيانات بنجاح!');
    }
}
