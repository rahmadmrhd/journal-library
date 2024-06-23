<?php

namespace App\Providers;

use App\Models\SubGate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   */
  public function register(): void {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {
    Paginator::defaultView('components.pagination');

    Route::bind('subGate', function (string $value) {
      if ($value == 'admin') {
        return SubGate::where('slug', 'admin')->firstOrNew([
          'slug' => 'superadmin',
        ]);
      }
      return SubGate::where('slug', $value)->firstOrFail();
    });

    Gate::policy(\App\Models\Manuscript\Manuscript::class, \App\Policies\ManuscriptPolicy::class);
    Gate::policy(\App\Models\Manuscript\Task::class, \App\Policies\TaskPolicy::class);
  }
}
