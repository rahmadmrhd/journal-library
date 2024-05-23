<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('file_types', function (Blueprint $table) {
      $table->tinyIncrements('id')->primary();
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('extensions')->nullable();
      $table->boolean('required')->default(false);
      $table->integer('max_files')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('file_types');
  }
};
