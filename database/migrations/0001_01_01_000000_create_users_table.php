<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('username')->unique()->nullable();
      $table->string('email')->unique()->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password')->nullable();
      $table->foreignId('current_role_id')->default(1);
      $table->string('orcid_id')->nullable()->unique();

      $table->string('title')->nullable();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('degree')->nullable();
      $table->string('preferred_name')->nullable();

      $table->string('institution')->nullable();
      $table->string('department')->nullable();
      $table->string('position')->nullable();
      $table->string('address')->nullable();
      $table->string('city')->nullable();
      $table->string('province')->nullable();
      $table->string('postal_code')->nullable();
      $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onDelete('set null');

      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('password_reset_tokens', function (Blueprint $table) {
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });

    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignUlid('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('users');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
  }
};
