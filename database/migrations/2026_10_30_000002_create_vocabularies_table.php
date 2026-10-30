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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('arabic_text', 255);
            $table->string('latin_text', 255);
            $table->string('meaning', 255);
            $table->text('description')->nullable();
            $table->text('example_sentence')->nullable();
            $table->string('image_path', 2048)->nullable();
            $table->string('audio_path', 2048)->nullable();
            $table->boolean('is_trending')->default(false);
            $table->timestamps();

            $table->index('is_trending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
    }
};
