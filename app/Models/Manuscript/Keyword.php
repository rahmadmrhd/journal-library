<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];

  public function manuscripts() {
    $this->belongsToMany(Manuscript::class, 'manuscript_keyword');
  }
}
