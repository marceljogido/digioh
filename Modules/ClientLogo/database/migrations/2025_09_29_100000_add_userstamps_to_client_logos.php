<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client_logos', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->nullable()->after('updated_at');
            $table->integer('updated_by')->unsigned()->nullable()->after('created_by');
            $table->integer('deleted_by')->unsigned()->nullable()->after('updated_by');
        });
    }

    public function down(): void
    {
        Schema::table('client_logos', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
};




