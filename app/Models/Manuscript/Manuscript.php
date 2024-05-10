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
}
