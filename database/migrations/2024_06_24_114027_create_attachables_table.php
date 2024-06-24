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
        Schema::create('attachables', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('attachment_id')->constrained();
            $table->foreignId('attachable_id');
            $table->string('attachable_type');
            $table->index(['attachable_id', 'attachable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachables');
    }
};
