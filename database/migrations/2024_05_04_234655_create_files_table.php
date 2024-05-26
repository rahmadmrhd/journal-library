<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

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
      $table->unsignedTinyInteger('file_type_id')->nullable();
      $table->foreign('file_type_id')->references('id')->on('file_types')->onDelete('set null');

      $table->nullableUuidMorphs('fileable');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Storage::deleteDirectory('files');
    Schema::dropIfExists('files');
  }
};
