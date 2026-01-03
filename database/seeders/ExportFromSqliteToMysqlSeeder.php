<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Technology;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\Certification;
use App\Models\Education;
use App\Models\PersonalInfo;
use App\Models\SiteSetting;
use App\Models\CoreCompetency;
use App\Models\TechnicalSkill;
use Exception;

class ExportFromSqliteToMysqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔄 بدء تصدير البيانات من SQLite إلى MySQL...');
        
        // الاتصال بقاعدة البيانات المحلية (SQLite)
        $localConfig = [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
        ];
        
        try {
            // الاتصال بقاعدة البيانات المحلية
            $this->command->info('⏳ الاتصال بقاعدة البيانات المحلية (SQLite)...');
            $localConnection = $this->connectToLocalDatabase($localConfig);
            
            if (!$localConnection) {
                $this->command->error('❌ فشل الاتصال بقاعدة البيانات المحلية.');
                return;
            }
            
            $this->command->info('✅ تم الاتصال بقاعدة البيانات المحلية بنجاح!');
            
            // تصدير البيانات
            $this->exportServices($localConnection);
            $this->exportProjects($localConnection);
            $this->exportBlogPosts($localConnection);
            $this->exportTechnologies($localConnection);
            $this->exportUsers($localConnection);
            $this->exportContactMessages($localConnection);
            $this->exportCertifications($localConnection);
            $this->exportEducations($localConnection);
            $this->exportPersonalInfo($localConnection);
            $this->exportSiteSettings($localConnection);
            $this->exportCoreCompetencies($localConnection);
            $this->exportTechnicalSkills($localConnection);
            
            $this->command->info('✅ تم تصدير جميع البيانات بنجاح إلى MySQL!');
            
        } catch (Exception $e) {
            $this->command->error('❌ خطأ في التصدير: ' . $e->getMessage());
        }
    }

    /**
     * الاتصال بقاعدة البيانات المحلية
     */
    private function connectToLocalDatabase(array $config)
    {
        try {
            $dsn = "sqlite:{$config['database']}";
            $pdo = new \PDO($dsn, null, null, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (\PDOException $e) {
            $this->command->warn('⚠️ فشل الاتصال: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * تصدير الخدمات
     */
    private function exportServices($connection)
    {
        try {
            $this->command->info('📦 تصدير الخدمات...');
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
            $this->command->info("✅ تم تصدير " . count($services) . " خدمة");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير الخدمات: " . $e->getMessage());
        }
    }

    /**
     * تصدير المشاريع
     */
    private function exportProjects($connection)
    {
        try {
            $this->command->info('📦 تصدير المشاريع...');
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
            $this->command->info("✅ تم تصدير " . count($projects) . " مشروع");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير المشاريع: " . $e->getMessage());
        }
    }

    /**
     * تصدير مقالات المدونة
     */
    private function exportBlogPosts($connection)
    {
        try {
            $this->command->info('📦 تصدير مقالات المدونة...');
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
            $this->command->info("✅ تم تصدير " . count($posts) . " مقال");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير المقالات: " . $e->getMessage());
        }
    }

    /**
     * تصدير التقنيات
     */
    private function exportTechnologies($connection)
    {
        try {
            $this->command->info('📦 تصدير التقنيات...');
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
            $this->command->info("✅ تم تصدير " . count($technologies) . " تقنية");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير التقنيات: " . $e->getMessage());
        }
    }

    /**
     * تصدير المستخدمين
     */
    private function exportUsers($connection)
    {
        try {
            $this->command->info('📦 تصدير المستخدمين...');
            $users = $connection->query("SELECT * FROM users")->fetchAll();
            
            foreach ($users as $user) {
                User::updateOrCreate(
                    ['id' => $user['id']],
                    [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => $user['password'],
                        'email_verified_at' => $user['email_verified_at'] ?? null,
                        'created_at' => $user['created_at'] ?? now(),
                        'updated_at' => $user['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($users) . " مستخدم");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير المستخدمين: " . $e->getMessage());
        }
    }

    /**
     * تصدير الرسائل
     */
    private function exportContactMessages($connection)
    {
        try {
            $this->command->info('📦 تصدير الرسائل...');
            $messages = $connection->query("SELECT * FROM contact_messages")->fetchAll();
            
            foreach ($messages as $message) {
                ContactMessage::updateOrCreate(
                    ['id' => $message['id']],
                    [
                        'name' => $message['name'],
                        'email' => $message['email'],
                        'message' => $message['message'],
                        'created_at' => $message['created_at'] ?? now(),
                        'updated_at' => $message['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($messages) . " رسالة");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير الرسائل: " . $e->getMessage());
        }
    }

    /**
     * تصدير الشهادات
     */
    private function exportCertifications($connection)
    {
        try {
            $this->command->info('📦 تصدير الشهادات...');
            $certifications = $connection->query("SELECT * FROM certifications ORDER BY `order`")->fetchAll();
            
            foreach ($certifications as $cert) {
                Certification::updateOrCreate(
                    ['id' => $cert['id']],
                    [
                        'name' => $cert['name'],
                        'order' => $cert['order'] ?? 0,
                        'created_at' => $cert['created_at'] ?? now(),
                        'updated_at' => $cert['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($certifications) . " شهادة");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير الشهادات: " . $e->getMessage());
        }
    }

    /**
     * تصدير التعليم
     */
    private function exportEducations($connection)
    {
        try {
            $this->command->info('📦 تصدير التعليم...');
            $educations = $connection->query("SELECT * FROM educations ORDER BY `order`")->fetchAll();
            
            foreach ($educations as $edu) {
                Education::updateOrCreate(
                    ['id' => $edu['id']],
                    [
                        'degree' => $edu['degree'],
                        'institution' => $edu['institution'],
                        'order' => $edu['order'] ?? 0,
                        'created_at' => $edu['created_at'] ?? now(),
                        'updated_at' => $edu['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($educations) . " تعليم");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير التعليم: " . $e->getMessage());
        }
    }

    /**
     * تصدير المعلومات الشخصية
     */
    private function exportPersonalInfo($connection)
    {
        try {
            $this->command->info('📦 تصدير المعلومات الشخصية...');
            $personalInfo = $connection->query("SELECT * FROM personal_info LIMIT 1")->fetch();
            
            if ($personalInfo) {
                PersonalInfo::updateOrCreate(
                    ['id' => $personalInfo['id']],
                    [
                        'name' => $personalInfo['name'] ?? null,
                        'job_title' => $personalInfo['job_title'] ?? null,
                        'description' => $personalInfo['description'] ?? null,
                        'location' => $personalInfo['location'] ?? null,
                        'phone' => $personalInfo['phone'] ?? null,
                        'email' => $personalInfo['email'] ?? null,
                        'whatsapp' => $personalInfo['whatsapp'] ?? null,
                        'profile_image' => $personalInfo['profile_image'] ?? null,
                        'hero_image' => $personalInfo['hero_image'] ?? null,
                        'professional_summary' => $personalInfo['professional_summary'] ?? null,
                        'created_at' => $personalInfo['created_at'] ?? now(),
                        'updated_at' => $personalInfo['updated_at'] ?? now(),
                    ]
                );
                $this->command->info("✅ تم تصدير المعلومات الشخصية");
            } else {
                $this->command->warn("⚠️ لا توجد معلومات شخصية للتصدير");
            }
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير المعلومات الشخصية: " . $e->getMessage());
        }
    }

    /**
     * تصدير إعدادات الموقع
     */
    private function exportSiteSettings($connection)
    {
        try {
            $this->command->info('📦 تصدير إعدادات الموقع...');
            $settings = $connection->query("SELECT * FROM site_settings")->fetchAll();
            
            foreach ($settings as $setting) {
                $value = $setting['value'] ?? null;
                if ($value && !is_array($value)) {
                    $value = json_decode($value, true);
                }
                
                SiteSetting::updateOrCreate(
                    ['key' => $setting['key']],
                    [
                        'value' => $value,
                        'created_at' => $setting['created_at'] ?? now(),
                        'updated_at' => $setting['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($settings) . " إعداد");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير إعدادات الموقع: " . $e->getMessage());
        }
    }

    /**
     * تصدير الكفاءات الأساسية
     */
    private function exportCoreCompetencies($connection)
    {
        try {
            $this->command->info('📦 تصدير الكفاءات الأساسية...');
            $competencies = $connection->query("SELECT * FROM core_competencies ORDER BY `order`")->fetchAll();
            
            foreach ($competencies as $comp) {
                CoreCompetency::updateOrCreate(
                    ['id' => $comp['id']],
                    [
                        'name' => $comp['name'],
                        'order' => $comp['order'] ?? 0,
                        'created_at' => $comp['created_at'] ?? now(),
                        'updated_at' => $comp['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($competencies) . " كفاءة أساسية");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير الكفاءات الأساسية: " . $e->getMessage());
        }
    }

    /**
     * تصدير المهارات التقنية
     */
    private function exportTechnicalSkills($connection)
    {
        try {
            $this->command->info('📦 تصدير المهارات التقنية...');
            $skills = $connection->query("SELECT * FROM technical_skills ORDER BY `order`")->fetchAll();
            
            foreach ($skills as $skill) {
                $skillsArray = $skill['skills'] ?? null;
                if ($skillsArray && !is_array($skillsArray)) {
                    $skillsArray = json_decode($skillsArray, true);
                }
                
                TechnicalSkill::updateOrCreate(
                    ['id' => $skill['id']],
                    [
                        'category' => $skill['category'],
                        'skills' => $skillsArray,
                        'order' => $skill['order'] ?? 0,
                        'created_at' => $skill['created_at'] ?? now(),
                        'updated_at' => $skill['updated_at'] ?? now(),
                    ]
                );
            }
            $this->command->info("✅ تم تصدير " . count($skills) . " مهارة تقنية");
        } catch (Exception $e) {
            $this->command->warn("⚠️ خطأ في تصدير المهارات التقنية: " . $e->getMessage());
        }
    }
}






