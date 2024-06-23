<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];
  protected $casts = [
    'roles' => 'array',
    'options' => 'array',
  ];

  public function form() {
    return $this->belongsTo(Form::class);
  }
}
