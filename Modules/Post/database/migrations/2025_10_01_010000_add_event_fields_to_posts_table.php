<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->timestamp('event_start_date')->nullable()->after('published_at');
            $table->timestamp('event_end_date')->nullable()->after('event_start_date');
            $table->string('event_location')->nullable()->after('event_end_date');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['event_start_date', 'event_end_date', 'event_location']);
        });
    }
};

