<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];
  protected $table = 'logs';

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function loggable() {
    return $this->morphTo();
  }
}
