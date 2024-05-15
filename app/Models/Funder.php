<?php

namespace App\Models;

use App\Models\Manuscript\Manuscript;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funder extends Model {
  use HasFactory, HasUuids;

  protected $guarded = ['id'];

  protected $casts = [
    'grants' => 'array'
  ];

  public function manuscript() {
    $this->belongsTo(Manuscript::class);
  }
}
