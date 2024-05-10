<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
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
    // Carbon::setLocale('id');
    Gate::policy(\App\Models\Manuscript\Manuscript::class, \App\Policies\ManuscriptPolicy::class);
  }
}
