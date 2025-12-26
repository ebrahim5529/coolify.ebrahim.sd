<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // إضافة indexes لتحسين أداء الاستعلامات
        // التحقق من وجود الجداول قبل إضافة indexes
        if (Schema::hasTable('services')) {
            Schema::table('services', function (Blueprint $table) {
                if (! $this->hasIndex('services', 'services_order_index')) {
                    $table->index('order');
                }
            });
        }

        if (Schema::hasTable('technologies')) {
            Schema::table('technologies', function (Blueprint $table) {
                if (! $this->hasIndex('technologies', 'technologies_order_index')) {
                    $table->index('order');
                }
            });
        }

        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                if (! $this->hasIndex('projects', 'projects_order_index')) {
                    $table->index('order');
                }
            });
        }

        if (Schema::hasTable('blog_posts')) {
            Schema::table('blog_posts', function (Blueprint $table) {
                if (! $this->hasIndex('blog_posts', 'blog_posts_published_index')) {
                    $table->index('published');
                }
                if (! $this->hasIndex('blog_posts', 'blog_posts_date_index')) {
                    $table->index('date');
                }
            });
        }
    }

    /**
     * التحقق من وجود index
     */
    private function hasIndex(string $table, string $indexName): bool
    {
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();

        if ($connection->getDriverName() === 'sqlite') {
            $indexes = $connection->select("SELECT name FROM sqlite_master WHERE type='index' AND tbl_name=? AND name=?", [$table, $indexName]);

            return count($indexes) > 0;
        }

        return false;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['order']);
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->dropIndex(['order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['order']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['published']);
            $table->dropIndex(['date']);
        });
    }
};
