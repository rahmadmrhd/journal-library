<?php

namespace App\Models\Manuscript;

use App\Models\Funder;
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
  public function funders() {
    return $this->hasMany(Funder::class,);
  }

  public function parent() {
    return $this->belongsTo(Manuscript::class, 'parent_id');
  }
  public function children() {
    return $this->hasMany(Manuscript::class, 'parent_id');
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

      'authorsId' => ['nullable', 'array'],
      'authorsId.*' => ['required', 'uuid', 'exists:users,id'],

      'parent_id' => ['nullable', 'uuid', 'exists:manuscripts,id'],

      'funders' => ['nullable', 'array'],
      'funders.*.id' => ['nullable', 'uuid', 'exists:funders,id'],
      'funders.*.name' => ['required', 'string', 'min:3', 'max:255'],
      'funders.*.grants' => ['nullable', 'array'],
      'funders.*.grants.*' => ['required', 'string', 'min:3', 'max:255'],

      'potential_conflict' => ['required', 'boolean'],
      'paper_contain' => ['required', 'boolean'],
      'open_access' => ['required', 'boolean'],
      'using_paperpal' => ['required', 'boolean'],
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

      'authorsId.required' => 'The authors are required.',
      'authorsId.*.exists' => 'The author is invalid.',
      'authorsId.*.required' => 'The author is invalid.',
      'authorsId.*.uuid' => 'The author is invalid.',

      'parent_id.uuid' => 'The reference manuscript is invalid.',
      'parent_id.exists' => 'The reference manuscript is invalid.',

      'funders.required' => 'The funders are required.',
      'funders.*.id.exists' => 'The funder is invalid.',
      'funders.*.name.required' => 'The funder name is required.',
      'funders.*.name.min' => 'The funder name must be at least 3 characters.',
      'funders.*.name.max' => 'The funder name may not be greater than 255 characters.',
      'funders.*.grants.required' => 'The grants are required.',
      'funders.*.grants.*.required' => 'The grant is required.',
      'funders.*.grants.*.min' => 'The grant must be at least 3 characters.',
      'funders.*.grants.*.max' => 'The grant may not be greater than 255 characters.',

      'potential_conflict.required' => 'The potential conflict is required.',
      'paper_contain.required' => 'The paper contain is required.',
      'open_access.required' => 'The open access is required.',
      'using_paperpal.required' => 'The using paperpal is required.',
    ];
  }
}
