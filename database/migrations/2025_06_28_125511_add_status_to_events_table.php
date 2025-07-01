<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/[timestamp]_add_status_to_events_table.php

public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('status', 20)
                ->nullable()
                ->after('timezone')
                ->comment('Possible values: not_started, live, finished');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
