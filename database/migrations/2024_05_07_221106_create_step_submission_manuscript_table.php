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
      $table->unsignedTinyInteger('step_submission_id');
      $table->foreign('step_submission_id')->references('id')->on('step_submissions')->cascadeOnDelete();
      $table->foreignUuid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();

      $table->unique(['step_submission_id', 'manuscript_id'], 'step_submission_manuscript_unique');
      $table->enum('status', ['success', 'error'])->nullable();
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
