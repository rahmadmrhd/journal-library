<?php

namespace App\Providers;

use \App\Services\CountryApiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CountryApiServiceProvider extends ServiceProvider implements DeferrableProvider {
  /**
   * Get the services provided by the provider.
   *
   * @return array<int, string>
   */
  public function provides(): array {
    return [CountryApiService::class];
  }
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
    //
  }
}
