<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {
  use HasFactory, EagerLoadPivotTrait;

  protected $guarded = ['id'];

  public function users() {
    return $this->belongsToMany(User::class);
  }
}
