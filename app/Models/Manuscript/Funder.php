<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funder extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];

  protected $casts = [
    'grants' => 'array'
  ];

  public function manuscript() {
    $this->belongsTo(Manuscript::class);
  }
}
