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
        Schema::create('ngrams', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('phrase');
            $table->integer('frequency');
            $table->enum('type', ['unigram', 'bigram']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngrams');
    }
};
