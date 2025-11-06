<?php

use App\Enums\ServiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('status')->default(ServiceStatus::Draft->value)->after('icon');
        });

        // Sync existing data: published when previously active.
        DB::table('services')->update([
            'status' => DB::raw("CASE WHEN is_active = true THEN '".ServiceStatus::Published->value."' ELSE '".ServiceStatus::Draft->value."' END"),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
