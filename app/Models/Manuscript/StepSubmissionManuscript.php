<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StepSubmissionManuscript extends Pivot {
  use HasUlids;
  protected $guarded = ['id'];
  protected $table = 'step_submission_manuscript';
}
