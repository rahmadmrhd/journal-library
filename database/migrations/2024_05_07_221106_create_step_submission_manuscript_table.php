<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('step_submission_manuscript', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignId('step_submission_id')->references('id')->on('step_submissions')->cascadeOnDelete();
      $table->foreignUuid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('step_submission_manuscript');
  }
};
