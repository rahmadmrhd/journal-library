<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('manuscripts', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('code')->nullable();
      $table->integer('number')->nullable();
      $table->string('title')->nullable();
      $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('SET NULL');
      $table->text('abstract')->nullable();
      $table->tinyInteger('current_step')->default(1);
      $table->foreignUuid('parent_id')->nullable()->references('id')->on('manuscripts')->cascadeOnDelete();

      $table->longText('cover_letter')->nullable();
      $table->boolean('potential_conflict')->nullable();
      $table->boolean('paper_contain')->nullable();
      $table->boolean('open_access')->nullable();
      $table->boolean('using_paperpal')->nullable();

      $table->timestamp('submitted_at')->nullable();
      $table->timestamp('canceled_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('manuscripts');
  }
};
