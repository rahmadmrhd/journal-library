<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Form\Form;
use App\Models\Manuscript\Category;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Keyword;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\StepSubmission;
use App\Models\Manuscript\Task;
use App\Models\User;
use App\Models\Role;
use App\Models\SubGate;
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
    $mgGate = SubGate::createOrFirst([
      'name' => 'Manuscript Gate',
      'slug' => 'mg',
    ]);
    SubGate::createOrFirst([
      'name' => 'Xpose',
      'slug' => 'xpose',
    ]);

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
    Role::createOrFirst([
      'name' => 'Super Administrator',
      'slug' => 'super-admin',
    ]);

    $user = User::factory()->create([
      'first_name' => 'Admin',
      'last_name' => '',
      'email' => 'nqK5n@example.com',
      'username' => 'admin',
      'password' => Hash::make('admin'),
    ]);

    $user->roles()->attach(
      [
        1 => ['sub_gate_id' => $mgGate->id],
        2 => ['sub_gate_id' => $mgGate->id],
        3 => ['sub_gate_id' => $mgGate->id],
        4 => ['sub_gate_id' => $mgGate->id],
        5 => ['sub_gate_id' => $mgGate->id],
        6 => ['sub_gate_id' => $mgGate->id]
      ]
    );

    $user = User::factory()->create([
      'first_name' => 'Super',
      'last_name' => 'Admin',
      'email' => 'nqK5asdn@example.com',
      'username' => 'superadmin',
      'password' => Hash::make('superadmin'),
    ]);

    $user->roles()->attach(
      [
        7 => ['sub_gate_id' => $mgGate->id]
      ]
    );


    $userEditorAssistant1 = User::factory()->create([
      'first_name' => 'Editor',
      'last_name' => 'Assistant 1',
      'email' => 'jwqBsdZ@example.com',
      'username' => 'editor-assistant-1',
    ]);
    $userEditorAssistant1->roles()->attach([3 => ['sub_gate_id' => $mgGate->id]]);

    $userEditorAssistant2 = User::factory()->create([
      'first_name' => 'Editor',
      'last_name' => 'Assistant 2',
      'email' => 'jwqBZ@example.com',
      'username' => 'editor-assistant-2',
    ]);
    $userEditorAssistant2->roles()->attach([3 => ['sub_gate_id' => $mgGate->id]]);

    $userEditorInChief = User::factory()->create([
      'first_name' => 'Editor',
      'last_name' => 'In Chief',
      'email' => 'jwqBqwdZ@example.com',
      'username' => 'editor-in-chief',
    ]);
    $userEditorInChief->roles()->attach([4 => ['sub_gate_id' => $mgGate->id]]);

    $userAcademicEditor = User::factory()->create([
      'first_name' => 'Academic',
      'last_name' => 'Editor',
      'email' => 'jwqqwdBZ@example.com',
      'username' => 'academic-editor',
    ]);
    $userAcademicEditor->roles()->attach([5 => ['sub_gate_id' => $mgGate->id]]);

    $userAcademicEditors = User::factory(5)->create();

    foreach ($userAcademicEditors as $user) {
      $user->roles()->attach([5 => ['sub_gate_id' => $mgGate->id]]);
    }

    $userReviewer = User::factory()->create([
      'first_name' => 'Reviewer',
      'last_name' => '',
      'email' => 'jwqBZds@example.com',
      'username' => 'reviewer',
    ]);
    $userReviewer->roles()->attach([2 => ['sub_gate_id' => $mgGate->id]]);

    $userReviewerEditors = User::factory(5)->create();

    foreach ($userReviewerEditors as $user) {
      $user->roles()->attach([2 => ['sub_gate_id' => $mgGate->id]]);
    }

    // $users = User::factory(10)->create();

    // foreach ($users as $user) {
    //   $user->roles()->attach($this->faker->numberBetween(1, 5));
    // }

    FileType::createOrFirst([
      'name' => 'Cover Letter',
      'slug' => 'cover_letter',
      'required' => true,
      'sub_gate_id' => $mgGate->id,
    ]);
    FileType::createOrFirst([
      'name' => 'Manuscript',
      'slug' => 'manuscript',
      'required' => true,
      'sub_gate_id' => $mgGate->id,
    ]);
    FileType::createOrFirst([
      'name' => 'Case Study Consent Form',
      'slug' => 'case_study_consent_form',
      'required' => true,
      'sub_gate_id' => $mgGate->id,
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
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "Viewpoint",
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "Technical Paper",
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "Conceptual Paper",
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "Case Study",
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "Literature Review",
      'sub_gate_id' => $mgGate->id,
    ]);
    Category::createOrFirst([
      'name' => "General View",
      'sub_gate_id' => $mgGate->id,
    ]);

    Keyword::factory(100)->create();

    Country::insert($this->countryApiService->getCountries()->values()->toArray());

    $formDetailManuscript = Form::create([
      'name' => 'Detail Manuscript',
      'formable_type' => Manuscript::class,
      'role_id' => 1,
    ]);

    $formDetailManuscript->questions()->createMany([
      [
        'question' => 'Confirm the following:',
        'required' => true,
        'type' => 'checkbox:col',
        'options' => [
          [
            'label' => 'Confirm that the manuscript has been submitted solely to this journal and is not published, in press, or submitted elsewhere.',
            'value' => '1',
            'required' => true,
          ], [
            'label' => 'Confirm that all of the research meets the ethical guidelines of your institution or company, as well as adherence to the legal requirements of the study country.',
            'value' => '1',
            'required' => true,
          ], [
            'label' => 'Confirm that you have prepared a complete text within the anonymous article file. Any identifying information has been included separately in a title page, acknowledgements or supplementary file not for review, to allow anonymous review.',
            'value' => '1',
            'required' => true,
          ]
        ],
        'order' => 0,
      ],
      [
        'required' => true,
        'type' => 'checkbox',
        'options' => [
          [
            'label' => 'Confirm that the manuscript has been created by the author(s) and not an AI tool/Large Language Model (LLM). If an AI tool/LLM has been used to develop or generate any portion of the manuscript then this must be clearly flagged in the Methods and Acknowledgements.',
            'value' => '1',
            'required' => true,
          ]
        ],
        'order' => 1
      ],
      [
        'question' => 'I/We have declared any potential conflict of interest in the research. Any support from a third party has been noted in the Acknowledgements.',
        'required' => true,
        'type' => 'radio',
        'options' => [
          [
            'label' => 'Yes',
            'value' => '1',
          ],
          [
            'label' => 'No',
            'value' => '0',
          ],
        ],
        'order' => 2,
      ],
      [
        'question' => 'Does this paper contain a case study, or research conducted within an identifiable organization?',
        'description' => 'If yes, please upload a completed Case Study Consent Form (download from the link at the top of this page) at the file upload step.',
        'required' => true,
        'type' => 'radio',
        'options' => [
          [
            'label' => 'Yes',
            'value' => '1',
          ],
          [
            'label' => 'No',
            'value' => '0',
          ],
        ],
        'order' => 3,
      ],
      [
        'question' => 'Open Access: Indicate here your intention to publish your article as open access under a Creative Commons Attribution 4.0 Licence (CC BY) if it is accepted?',
        'required' => true,
        'type' => 'radio',
        'options' => [
          [
            'label' => 'Yes, I want to publish my article as Open Access',
            'value' => '1',
          ],
          [
            'label' => 'No, I don’t want to publish Open Access',
            'value' => '0',
          ],
        ],
        'order' => 4,
      ],
      [
        'question' => 'Have you downloaded and used the PaperPal pre flight report to help edit your submission?',
        'required' => true,
        'type' => 'radio',
        'options' => [
          [
            'label' => 'Yes',
            'value' => '1',
          ],
          [
            'label' => 'No',
            'value' => '0',
          ],
        ],
        'order' => 5,
      ],
    ]);

    $formReviewer = Form::create([
      'name' => 'Reviewer',
      'formable_type' => Task::class,
      'role_id' => 2,
    ]);

    $formReviewer->questions()->createMany([
      [
        'question' => 'Reviewer Instructions',
        'readonly' => true,
        'type' => 'description',
        'order' => 0,
        'description' => 'Please read the instructions carefully before submitting your review.',
      ],
      [
        'question' => 'Review Questions',
        'readonly' => true,
        'type' => 'divider',
        'order' => 1,
      ],
      [
        'question' => 'Is the manuscript technically sound, and do the data support the conclusions?',
        'description' => 'The manuscript must describe a technically sound piece of scientific research with data that supports the conclusions. Experiments must have been conducted rigorously, with appropriate controls, replication, dan sample sizes. The conclusions must be drawn appropriately based on the data presented.',
        'type' => 'checkbox',
        'required' => true,
        'order' => 2,
        'options' => [
          [
            'label' => 'Yes',
            'value' => '0',
          ],
          [
            'label' => 'No',
            'value' => '1',
          ],
          [
            'label' => 'Partly',
            'value' => '2',
          ]
        ]
      ],
      [
        'question' => 'Has the statistical analysis been performed appropriately and rigorously?',
        'type' => 'checkbox',
        'required' => true,
        'order' => 3,
        'options' => [
          [
            'label' => 'Yes',
            'value' => '0',
          ],
          [
            'label' => 'No',
            'value' => '1',
          ],
          [
            'label' => 'I Don\'t Know',
            'value' => '2',
          ],
          [
            'label' => 'N/A',
            'value' => '3',
          ]
        ]
      ],
      [
        'question' => 'Have the authors made all data underlaying the findings in their manuscript fully available?',
        'description' => 'The manuscript must describe a technically sound piece of scientific research with data that supports the conclusions. Experiments must have been conducted rigorously, with appropriate controls, replication, dan sample sizes. The conclusions must be drawn appropriately based on the data presented.',
        'type' => 'checkbox',
        'required' => true,
        'order' => 4,
        'options' => [
          [
            'label' => 'Yes',
            'value' => '0',
          ],
          [
            'label' => 'No',
            'value' => '1',
          ]
        ]
      ],
    ]);
  }
}
