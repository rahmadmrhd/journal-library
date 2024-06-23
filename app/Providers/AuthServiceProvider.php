<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * Register services.
   */
  public function register(): void {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerPolicies();
    Gate::define('isSuperAdmin', function (User $user) {
      return $user->currentRole->slug == 'super-admin';
    });
    Gate::define('isAdmin', function (User $user) {
      return $user->currentRole->slug == 'admin';
    });
    Gate::define('isReviewer', function (User $user) {
      return $user->currentRole->slug == 'reviewer';
    });
    Gate::define('isEditorAssistant', function (User $user) {
      return $user->currentRole->slug == 'editor-assistant';
    });
    Gate::define('isEditorInChief', function (User $user) {
      return $user->currentRole->slug == 'editor-in-chief';
    });
    Gate::define('isAcademicEditor', function (User $user) {
      return $user->currentRole->slug == 'academic-editor';
    });
    Gate::define('isAuthor', function (User $user) {
      return $user->currentRole->slug == 'author';
    });
  }
}
