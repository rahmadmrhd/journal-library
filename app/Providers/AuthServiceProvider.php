<?php

namespace App\Providers;

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
    Gate::define('isAdmin', function ($user) {
      return $user->role == 'admin';
    });
    Gate::define('isEditor', function ($user) {
      return $user->role == 'editor';
    });
    Gate::define('isReviewer', function ($user) {
      return $user->role == 'reviewer';
    });
    Gate::define('isAuthor', function ($user) {
      return $user->role == 'author';
    });
  }
}
