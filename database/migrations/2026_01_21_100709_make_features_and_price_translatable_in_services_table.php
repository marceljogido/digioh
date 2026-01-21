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
        Schema::table('services', function (Blueprint $table) {
            // Drop old string columns
            $table->dropColumn(['price', 'price_note']);
        });

        Schema::table('services', function (Blueprint $table) {
            // Re-create as JSON
            $table->json('price')->nullable()->after('features');
            $table->json('price_note')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['price', 'price_note']);
        });

        Schema::table('services', function (Blueprint $table) {
             $table->string('price', 100)->nullable()->after('features');
             $table->string('price_note', 255)->nullable()->after('price');
        });
    }
};
