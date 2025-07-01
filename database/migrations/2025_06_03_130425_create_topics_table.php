<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Faith", "Forgiveness"
            $table->string('slug')->unique(); // For SEO-friendly URLs (optional)
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
