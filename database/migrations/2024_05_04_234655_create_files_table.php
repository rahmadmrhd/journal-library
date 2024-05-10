<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('files', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('path');
      $table->string('extension');
      $table->string('mime_type');
      $table->boolean('is_temporary')->default(true);
      $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->foreignId('file_type_id')->nullable()->references('id')->on('file_types')->onDelete('set null');
      $table->foreignUuid('manuscript_id')->nullable()->references('id')->on('manuscripts')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('files');
  }
};
