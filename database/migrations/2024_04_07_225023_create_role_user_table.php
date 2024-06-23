<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('role_user', function (Blueprint $table) {
      $table->primary(['role_id', 'user_id', 'sub_gate_id']);
      $table->unsignedTinyInteger('role_id');
      $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
      $table->foreignUlid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->foreignUlid('sub_gate_id')->references('id')->on('sub_gates')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('role_user');
  }
};
