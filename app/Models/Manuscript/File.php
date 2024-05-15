<?php

namespace App\Models\Manuscript;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model {
  use HasFactory, HasUuids;

  protected $guarded = ['id'];

  public function user() {
    return $this->belongsTo(User::class);
  }
  public function manuscript() {
    return $this->belongsTo(Manuscript::class);
  }
  public function fileType() {
    return $this->belongsTo(FileType::class);
  }
}
