<?php

namespace Database\Seeders;

use App\Models\Manuscript\FileType;
use App\Models\Manuscript\StepSubmission;
use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
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
      'required' => true,
    ]);
    FileType::createOrFirst([
      'name' => 'Manuscript',
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
  }
}
