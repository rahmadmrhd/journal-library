<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('tasks', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->unsignedTinyInteger('role_id');
      $table->foreign('role_id')->references('id')->on('roles');
      $table->unique(['manuscript_id', 'user_id', 'role_id']);

      $table->enum('status', ['pending', 'alternative', 'in_progress', 'delegated', 'done', 'rejected'])->default('pending');
      $table->enum('decision', ['accept', 'reject'])->nullable();
      $table->longText('notes')->nullable();

      $table->dateTime('deadline')->nullable();
      $table->timestamp('processed_at')->nullable();
      $table->timestamp('completed_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('assignments');
  }
};
