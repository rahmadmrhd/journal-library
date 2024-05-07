<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model {
  use HasFactory, SoftDeletes;
  protected $guarded = ['id'];

  public function files() {
    return $this->hasMany(File::class);
  }
}
