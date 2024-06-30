<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_resolution_questions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('test_resolution_id')->constrained();
            $table->foreignId('test_question_id')->constrained();
            $table->boolean('is_correct')->default(false);
            $table->string('answer', 5)->nullable();
            $table->text('extracted_text')->nullable();
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
