<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ManuscriptAuthor extends Pivot {
  use HasUuids;
  protected $guarded = ['id'];
}
