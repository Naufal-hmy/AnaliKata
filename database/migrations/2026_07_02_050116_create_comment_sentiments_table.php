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
        Schema::create('comment_sentiments', function (Blueprint $table) {
            $table->id();
            $table->string('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments')->cascadeOnDelete();
            $table->integer('score');
            $table->enum('sentiment_label', ['Positif', 'Negatif', 'Netral']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_sentiments');
    }
};
