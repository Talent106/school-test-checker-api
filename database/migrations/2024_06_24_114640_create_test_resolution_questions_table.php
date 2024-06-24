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
        Schema::create('test_resolution_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_resolution_id')->constrained();
            $table->foreignId('test_question_id')->constrained();
            $table->string('answer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_resolution_questions');
    }
};
