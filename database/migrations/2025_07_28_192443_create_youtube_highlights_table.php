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
        Schema::create('youtube_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('author');
            $table->string('thumbnail')->nullable();
            $table->string('video_url')->nullable();
            $table->string('youtube_id')->nullable();
            $table->date('published_date');
            $table->json('tags')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_highlights');
    }
};
