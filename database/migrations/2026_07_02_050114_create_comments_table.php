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
        Schema::create('comments', function (Blueprint $table) {
            $table->string('id')->primary(); // YouTube Comment ID
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->timestamp('published_at');
            $table->integer('like_count')->default(0);
            $table->integer('word_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
