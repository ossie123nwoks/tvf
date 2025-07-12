<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->string('speaker')->after('description');
            $table->string('thumbnail')->nullable()->after('speaker');
            $table->string('transcript_url')->nullable()->after('video_url'); // Note: Correct spelling to match your model
            $table->foreignId('series_id')->nullable()->constrained('series')->after('transcript_url');
            
            // Optional but recommended:
            $table->string('slug')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeign(['series_id']);
            $table->dropColumn([
                'speaker',
                'thumbnail',
                'transcript_url',
                'series_id',
                'slug'
            ]);
        });
    }
};