<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Manuscript\Category;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Keyword;
use App\Models\Manuscript\StepSubmission;
use App\Models\User;
use App\Models\Role;
use App\Services\CountryApiService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator;
use Illuminate\Container\Container;

class DatabaseSeeder extends Seeder {
  private CountryApiService $countryApiService;
  private Generator $faker;


  public function __construct(CountryApiService $countryApiService) {
    $this->countryApiService = $countryApiService;
    $this->faker = Container::getInstance()->make(Generator::class);
  }

  /**
   * Seed the application's database.
   */
  public function run(): void {
    Role::createOrFirst([
      'name' => 'Author',
      'slug' => 'author',
    ]);
    Role::createOrFirst([
      'name' => 'Reviewer',
      'slug' => 'reviewer',
    ]);
    Role::createOrFirst([
      'name' => 'Editor Assistant',
      'slug' => 'editor-assistant',
    ]);
    Role::createOrFirst([
      'name' => 'Editor In Chief',
      'slug' => 'editor-in-chief',
    ]);
    Role::createOrFirst([
      'name' => 'Academic Editor',
      'slug' => 'academic-editor',
    ]);
    Role::createOrFirst([
      'name' => 'Administrator',
      'slug' => 'admin',
    ]);
    $user = User::factory()->create([
      'first_name' => 'Admin',
      'last_name' => '',
      'email' => 'nqK5n@example.com',
      'username' => 'admin',
      'password' => Hash::make('admin'),
    ]);

    $user->roles()->attach([1, 2, 3, 4, 5, 6]);

    $users = User::factory(10)->create();

    foreach ($users as $user) {
      $user->roles()->attach($this->faker->numberBetween(1, 5));
    }

    FileType::createOrFirst([
      'name' => 'Cover Letter',
      'slug' => 'cover_letter',
      'required' => true,
    ]);
    FileType::createOrFirst([
      'name' => 'Manuscript',
      'slug' => 'manuscript',
      'required' => true,
    ]);
    FileType::createOrFirst([
      'name' => 'Case Study Consent Form',
      'slug' => 'case_study_consent_form',
      'required' => true,
    ]);

    StepSubmission::createOrFirst([
      'name' => 'File Upload',
    ]);
    StepSubmission::createOrFirst([
      'name' => 'Title, Abstract, & Keywords',
    ]);
    StepSubmission::createOrFirst([
      'name' => 'Authors & Institutions',
    ]);
    StepSubmission::createOrFirst([
      'name' => 'Details & Comments',
    ]);
    StepSubmission::createOrFirst([
      'name' => 'Review & Submit',
    ]);

    Category::createOrFirst([
      'name' => "Research Paper",
    ]);
    Category::createOrFirst([
      'name' => "Viewpoint",
    ]);
    Category::createOrFirst([
      'name' => "Technical Paper",
    ]);
    Category::createOrFirst([
      'name' => "Conceptual Paper",
    ]);
    Category::createOrFirst([
      'name' => "Case Study",
    ]);
    Category::createOrFirst([
      'name' => "Literature Review",
    ]);
    Category::createOrFirst([
      'name' => "General View",
    ]);

    Keyword::factory(100)->create();

    Country::insert($this->countryApiService->getCountries()->values()->toArray());
  }
}
