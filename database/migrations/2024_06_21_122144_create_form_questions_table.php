<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('form_questions', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('form_id')->references('id')->on('forms')->cascadeOnDelete();

      $table->string('question')->nullable();
      $table->string('placeholder')->nullable();
      $table->text('roles')->nullable();
      $table->string('type');
      $table->unsignedTinyInteger('order');
      $table->boolean('required')->default(false);
      $table->text('description')->nullable();
      $table->text('options')->nullable();
      $table->boolean('readonly')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('form_questions');
  }
};
