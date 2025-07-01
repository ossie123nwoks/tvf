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
        Schema::table('events', function (Blueprint $table) {
            $table->string('recurrence')->nullable(); // 'daily', 'weekly', 'monthly'
            $table->integer('recurrence_interval')->default(1); // Every N days/weeks/months
            $table->integer('recurrence_count')->nullable(); // Total number of occurrences
            $table->date('recurrence_end_date')->nullable(); // When to stop repeating
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'recurrence',
                'recurrence_interval',
                'recurrence_count',
                'recurrence_end_date',
            ]);
        });
    }
};
