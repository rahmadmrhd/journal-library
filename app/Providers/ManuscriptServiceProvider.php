<?php

namespace App\Providers;

use App\Services\Manuscripts\SubmitNewManuscriptServices;
use App\Services\Manuscripts\TaskServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ManuscriptServiceProvider extends ServiceProvider implements DeferrableProvider {
  /**
   * Get the services provided by the provider.
   *
   * @return array<int, string>
   */
  public function provides(): array {
    return [
      SubmitNewManuscriptServices::class,
      TaskServices::class,
    ];
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
