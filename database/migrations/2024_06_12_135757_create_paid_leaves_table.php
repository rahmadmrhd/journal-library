<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('paid_leaves', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->date('start_date');
      $table->date('end_date');
      $table->string('reason');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('paid_leaves');
  }
};
