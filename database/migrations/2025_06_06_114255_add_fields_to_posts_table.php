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
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            }
        
            if (!Schema::hasColumn('posts', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft')->after('category_id');
            }
        
            if (!Schema::hasColumn('posts', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('published_at');
            }
        
            if (!Schema::hasColumn('posts', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'status', 'meta_title', 'meta_description']);
        });
    }
};
