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
    Schema::table('categories', function (Blueprint $table) {
        if (!Schema::hasColumn('categories', 'name')) {
            $table->string('name');
        }
    
        if (!Schema::hasColumn('categories', 'slug')) {
            $table->string('slug')->unique();
        }
    
        if (!Schema::hasColumn('categories', 'created_at') && !Schema::hasColumn('categories', 'updated_at')) {
            $table->timestamps();
        }
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
