<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('task_invitations', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('task_id')->references('id')->on('tasks')->cascadeOnDelete();
      $table->foreignUlid('task_detail_id')->references('id')->on('task_details')->cascadeOnDelete();
      $table->foreignUlid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->unsignedTinyInteger('role_id');
      $table->foreign('role_id')->references('id')->on('roles');

      $table->unsignedTinyInteger('deadline')->nullable();
      $table->timestamp('invited_at');
      $table->enum('status', ['pending', 'invited', 'accepted', 'rejected', 'expired']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('task_invitation');
  }
};
