<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('manuscript_keyword', function (Blueprint $table) {
      $table->foreignUlid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->foreignUlid('keyword_id')->references('id')->on('keywords')->cascadeOnDelete();
      $table->primary(['manuscript_id', 'keyword_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('manuscript_keyword');
  }
};
