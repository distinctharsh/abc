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
        // First, check if the table exists
        if (!Schema::hasTable('youtube_highlights')) {
            // If the table doesn't exist, create it with all necessary columns
            Schema::create('youtube_highlights', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('url');
                $table->string('thumbnail')->nullable();
                $table->boolean('is_active')->default(1);
                $table->timestamps();
            });
        } else {
            // If the table exists, just add the missing column
            Schema::table('youtube_highlights', function (Blueprint $table) {
                if (!Schema::hasColumn('youtube_highlights', 'is_active')) {
                    $table->boolean('is_active')->default(1)->after('url');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop the column if it exists and we're not dropping the whole table
        if (Schema::hasTable('youtube_highlights') && 
            Schema::hasColumn('youtube_highlights', 'is_active')) {
            Schema::table('youtube_highlights', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};
