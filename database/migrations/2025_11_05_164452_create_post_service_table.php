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
        Schema::create('post_service', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->primary(['post_id', 'service_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_our_work')->default(false);
            $table->unsignedInteger('our_work_sort_order')->default(0);
            $table->json('gallery_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['is_our_work', 'our_work_sort_order', 'gallery_images']);
        });

        Schema::dropIfExists('post_service');
    }
};
