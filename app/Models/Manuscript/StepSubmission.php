<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepSubmission extends Model {
  use HasFactory;

  protected $guarded = ['id'];
  public function manuscripts() {
    return $this->belongsToMany(Manuscript::class, 'step_submission_manuscript')->using(StepSubmissionManuscript::class);
  }
}
