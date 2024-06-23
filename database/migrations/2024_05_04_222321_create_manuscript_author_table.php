<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('manuscript_author', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->foreignUlid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->boolean('is_corresponding_author')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('manuscript_author');
  }
};
