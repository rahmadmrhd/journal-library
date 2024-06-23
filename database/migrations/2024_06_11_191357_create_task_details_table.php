<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('task_details', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('task_id')->references('id')->on('tasks')->cascadeOnDelete();
      $table->enum('decision', ['accept', 'continue', 'reject', 'revision', 'major_revision, minor_revision'])->nullable();
      $table->longText('notes')->nullable();
      $table->unsignedTinyInteger('to_role_id');
      $table->foreign('to_role_id')->references('id')->on('roles');

      $table->unsignedTinyInteger('deadline_invites')->nullable();
      $table->timestamp('submitted_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('task_details');
  }
};
