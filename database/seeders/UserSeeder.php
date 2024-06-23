<?php

namespace Database\Seeders;

use App\Models\SubGate;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
  private Generator $faker;


  public function __construct() {
    $this->faker = Container::getInstance()->make(Generator::class);
  }
  /**
   * Run the database seeds.
   */
  public function run(): void {

    $mgGate = SubGate::firstOrCreate([
      'name' => 'Manuscript Gate',
      'slug' => 'mg',
    ]);
    $users = User::factory(10)->create();

    foreach ($users as $user) {
      $user->roles()->attach([$this->faker->numberBetween(1, 5) => ['sub_gate_id' => $mgGate->id]]);
    }
  }
}
