<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('funders', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('name');
      $table->text('grants')->nullable();
      $table->foreignUlid('manuscript_id')->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('funders');
  }
};
