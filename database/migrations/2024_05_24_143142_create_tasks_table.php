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
      $table->ulid('id')->primary();
      $table->foreignUlid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->foreignUlid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->unsignedTinyInteger('role_id');
      $table->foreign('role_id')->references('id')->on('roles');
      $table->unique(['manuscript_id', 'user_id', 'role_id']);

      $table->enum('status', ['pending', 'in_progress', 'delegated', 'finalization', 'done', 'rejected'])->default('pending');

      $table->foreignUlid('parent_id')->nullable()->references('id')->on('tasks')->cascadeOnDelete();
      $table->foreignUlid('sub_gate_id')->references('id')->on('sub_gates')->cascadeOnDelete();

      $table->unsignedTinyInteger('deadline')->nullable();
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
