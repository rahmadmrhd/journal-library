<?php

namespace App\Models\Manuscript;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
  use HasFactory;
  protected $guarder = ['id'];

  public function Manuscripts() {
    return $this->hasMany(Manuscript::class);
  }
}
