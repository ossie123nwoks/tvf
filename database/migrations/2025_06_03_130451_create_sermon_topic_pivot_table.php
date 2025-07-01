<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('sermon_topic', function (Blueprint $table) {
        $table->foreignId('sermon_id')->constrained()->cascadeOnDelete();
        $table->foreignId('topic_id')->constrained()->cascadeOnDelete();
        $table->primary(['sermon_id', 'topic_id']); // Composite primary key
    });
}

public function down()
{
    Schema::dropIfExists('sermon_topic');
}
};
