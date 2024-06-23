<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ManuscriptAuthor extends Pivot {
  use HasUlids;
  protected $guarded = ['id'];
}
