<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Change slider columns from varchar to text to accommodate JSON translatable data.
     */
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('subtitle')->nullable()->change();
            $table->text('button_text')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('title', 191)->change();
            $table->string('subtitle', 191)->nullable()->change();
            $table->string('button_text', 191)->nullable()->change();
        });
    }
};
