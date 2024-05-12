<?php

namespace App\Models\Manuscript;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manuscript extends Model {
  use HasFactory, HasUuids;
  protected $guarded = ['id'];

  public function authors() {
    return $this->belongsToMany(User::class, 'manuscript_author')->using(ManuscriptAuthor::class);
  }
  public function files() {
    return $this->hasMany(File::class);
  }
  public function steps() {
    return $this->belongsToMany(StepSubmission::class, 'step_submission_manuscript')->using(StepSubmissionManuscript::class)->withPivot('status');
  }
  public function category() {
    return $this->belongsTo(Category::class);
  }
  public function keywords() {
    return $this->belongsToMany(Keyword::class, 'manuscript_keyword');
  }

  /*
  * Rules and custom messages
  */
  public static function rules(array $only = null): array {
    $rules = collect([
      'filesId' => ['required', 'array', 'min:1'],
      'filesId.*' => ['required', 'uuid', 'exists:files,id'],

      'title' => ['required', 'string', 'min:3', 'max:255'],
      'category_id' => ['required', 'integer', 'exists:categories,id'],
      'abstract' => ['required', 'string', 'min:100', 'max:1000'],
      'keywords' => ['required', 'array', 'min:3'],
      'keywords.*' => ['required', 'min:3', 'max:25'],
    ]);

    if ($only) {
      $rules = $rules->only($only);
    }
    return $rules->toArray();
  }
  public static function messages(): array {
    return [
      'filesId.required' => 'Please upload at least one file.',
      'filesId.min' => 'Please upload at least one file.',
      'filesId.*.exists' => 'The file is invalid.',
      'filesId.*.uuid' => 'The file is invalid.',
      'filesId.*.required' => 'The file is invalid.',

      'title.required' => 'The title is required.',
      'title.min' => 'The title must be at least 3 characters.',
      'title.max' => 'The title may not be greater than 255 characters.',
      'category.required' => 'The category is required.',
      'category.exists' => 'The category is invalid.',
      'abstract.required' => 'The abstract is required.',
      'abstract.min' => 'The abstract must be at least 100 characters.',
      'abstract.max' => 'The abstract may not be greater than 1000 characters.',
      'keywords.required' => 'The keywords are required.',
      'keywords.min' => 'The keywords must be at least 3 items.',
      'keywords.*.min' => 'The keyword must be at least 3 characters.',
      'keywords.*.max' => 'The keyword may not be greater than 25 characters.',
    ];
  }
}
