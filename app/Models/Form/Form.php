<?php

namespace App\Models\Form;

use App\Models\Role;
use App\Models\SubGate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Form extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];

  public function questions() {
    return $this->hasMany(FormQuestion::class);
  }

  public function answers() {
    return $this->hasMany(FormAnswer::class);
  }

  public function role() {
    return $this->belongsTo(Role::class);
  }

  public static function getQuestions(string $model, SubGate $subGate, User $user) {
    $questions = Form::with('questions')->where('formable_type', $model)
      ->where(function (Builder $query) use ($subGate) {
        $query->where('sub_gate_id', $subGate->id);
        $query->orWhereNull('sub_gate_id');
      })->orderByDesc('sub_gate_id')->first()->questions->map(function ($question) use ($user) {
        unset($question->id);
        $question->user_id = $user->id;
        return $question->toArray();
      });
    return $questions;
  }

  public static function updateAnswers(Request $request) {
    $responses = [];
    foreach ($request->all() as $key => $value) {
      $keys = explode('_', $key);
      if ($keys[0] == 'field') {
        $response = FormAnswer::find($keys[1]);
        if ($response) {

          $response->answer = $value;
          $response->save();

          $responses[] = $response;
        }
      }
    }
    return $responses;
  }
}
