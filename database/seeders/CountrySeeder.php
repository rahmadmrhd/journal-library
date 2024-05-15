<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\CountryApiService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder {
  private CountryApiService $countryApiService;
  public function __construct(CountryApiService $countryApiService) {
    $this->countryApiService = $countryApiService;
  }



  /**
   * Run the database seeds.
   */
  public function run(): void {
    Country::truncate();
    Country::insert($this->countryApiService->getCountries()->values()->toArray());
  }
}
