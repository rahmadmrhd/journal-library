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

class DatabaseSeeder extends Seeder {
  private CountryApiService $countryApiService;
  public function __construct(CountryApiService $countryApiService) {
    $this->countryApiService = $countryApiService;
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
      'name' => 'Editor',
      'slug' => 'editor',
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

    $user->roles()->attach([1, 2, 3, 4]);

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
