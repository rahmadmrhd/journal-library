<?php

namespace App\Models\Form;

use App\Casts\MixedAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\Traits\HasBatch;

class FormAnswer extends Model {
  use HasFactory, HasUlids, HasBatch;

  protected $guarded = ['id'];
  protected $casts = [
    'roles' => 'array',
    'options' => 'array',
    'answer' => MixedAnswer::class,
  ];
  protected $appends = ['name'];

  protected function name(): Attribute {
    return new Attribute(
      get: fn () => 'field_' . $this->id,
    );
  }

  public function form() {
    return $this->belongsTo(Form::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function answerable() {
    return $this->morphTo();
  }

  public function getValidator() {
    $rules = $this->roles != null ? [$this->name => $this->roles] : [];
    $rules[$this->name][] = $this->required ? 'required' : 'nullable';
    return Validator::make(
      [
        $this->name => $this->answer
      ],
      $rules,
      [
        'required' => '"' . $this->question . '" ' . 'is required',
        'min' => '"' . $this->question . '" ' . 'must be at least :min characters',
        'max' => '"' . $this->question . '" ' . 'must not be greater than :max characters',
        'between' => '"' . $this->question . '" ' . 'must be between :min and :max characters',
        'in' => '"' . $this->question . '" ' . 'is invalid',
        'exists' => '"' . $this->question . '" ' . 'is invalid',
        'numeric' => '"' . $this->question . '" ' . 'must be a number',
        'boolean' => '"' . $this->question . '" ' . 'must be true or false',
        'array' => '"' . $this->question . '" ' . 'must be an array',
        'string' => '"' . $this->question . '" ' . 'must be a string',
        'date' => '"' . $this->question . '" ' . 'must be a date',
        'before' => '"' . $this->question . '" ' . 'must be before :date',
        'after' => '"' . $this->question . '" ' . 'must be after :date',
        'after_or_equal' => '"' . $this->question . '" ' . 'must be after or equal :date',
        'before_or_equal' => '"' . $this->question . '" ' . 'must be before or equal :date',
        'confirmed' => '"' . $this->question . '" ' . 'must be confirmed',
        'same' => '"' . $this->question . '" ' . 'must be the same as :field',
        'different' => '"' . $this->question . '" ' . 'must be different from :field',
        'not_in' => '"' . $this->question . '" ' . 'is invalid',
        'email' => '"' . $this->question . '" ' . 'must be a valid email',
        'url' => '"' . $this->question . '" ' . 'must be a valid url',
        'regex' => '"' . $this->question . '" ' . 'must be a valid regex',
        'ip' => '"' . $this->question . '" ' . 'must be a valid ip address',
        'in_array' => '"' . $this->question . '" ' . 'must be a valid value',
        'json' => '"' . $this->question . '" ' . 'must be a valid json',
        'uuid' => '"' . $this->question . '" ' . 'must be a valid uuid',
        'date_format' => '"' . $this->question . '" ' . 'must be a valid date format',
      ]
    );
  }
}
