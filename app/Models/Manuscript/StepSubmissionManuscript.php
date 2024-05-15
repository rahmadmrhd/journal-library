<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StepSubmissionManuscript extends Pivot {
  use HasUuids;
  protected $guarded = ['id'];
  protected $table = 'step_submission_manuscript';
}
