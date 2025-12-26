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
        // إضافة indexes لتحسين أداء contact_messages
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->index('read_at');
            $table->index('created_at');
        });

        // إضافة index لـ category في blog_posts
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index('category');
        });

        // إضافة index لـ slug في blog_posts (إذا لم يكن موجوداً)
        // slug لديه unique index بالفعل، لكن نضيف index عادي للبحث
        if (! Schema::hasColumn('blog_posts', 'slug_index')) {
            Schema::table('blog_posts', function (Blueprint $table) {
                // slug لديه unique index بالفعل، لا حاجة لإضافة index آخر
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropIndex(['read_at']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['category']);
        });
    }
};
