<?php

namespace Database\Seeders;

use App\Models\Manuscript\Keyword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    Keyword::factory(100)->create();
  }
}
