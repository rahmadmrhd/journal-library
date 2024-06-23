<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('forms', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('sub_gate_id')->nullable()->references('id')->on('sub_gates')->cascadeOnDelete();
      $table->unsignedTinyInteger('role_id');
      $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
      $table->string('formable_type')->unique();

      $table->string('name')->unique();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('forms');
  }
};
