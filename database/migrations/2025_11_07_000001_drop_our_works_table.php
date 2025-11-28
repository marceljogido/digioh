<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('our_work_service');

        Schema::dropIfExists('our_works');
    }

    public function down(): void
    {
        Schema::create('our_works', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon_class')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('featured_on_home')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        });

        Schema::create('our_work_service', function (Blueprint $table) {
            $table->unsignedBigInteger('our_work_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->primary(['our_work_id', 'service_id']);
            $table->foreign('our_work_id')->references('id')->on('our_works')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }
};
