<?php

namespace App\Models\Manuscript;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model {
  use HasFactory, HasUuids;

  protected $guarded = ['id'];
  protected $with = ['fileType'];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function fileType() {
    return $this->belongsTo(FileType::class);
  }

  public function fileable() {
    return $this->morphTo();
  }
}
