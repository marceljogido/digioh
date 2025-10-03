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
        Schema::table('stats', function (Blueprint $table) {
            $table->string('value')->comment('Statistik value, misal: 12+, 150+, 98%');
            $table->string('label')->comment('Deskripsi statistik, misal: Tahun pengalaman, Proyek berhasil diselesaikan, dll');
            $table->string('label_en')->nullable()->comment('Deskripsi statistik dalam bahasa Inggris');
            $table->integer('sort_order')->default(0)->comment('Urutan tampil statistik');
            $table->boolean('is_active')->default(true)->comment('Status aktif/non-aktif statistik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['value', 'label', 'label_en', 'sort_order', 'is_active']);
        });
    }
};