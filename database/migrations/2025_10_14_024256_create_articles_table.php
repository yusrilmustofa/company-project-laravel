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
        Schema::create('articles', function (Blueprint $table) {
            // Untuk MongoDB, kita akan menggunakan _id sebagai primary key
            // dan menambahkan field id_artikel sebagai field terpisah
            $table->string('id_artikel')->unique(); // Field custom untuk ID artikel
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('author');
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('category_id');
            $table->string('level_id')->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->index(['status', 'published_at']);
            $table->index('category_id');
            $table->index('level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};