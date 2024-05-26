<?php

namespace App\Models\Manuscript;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
  use HasUuids;

  protected $guarded = ['id'];
  protected $casts = [
    'notes' => 'array',
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function manuscript() {
    return $this->belongsTo(Manuscript::class);
  }

  public function role() {
    return $this->belongsTo(Role::class);
  }

  public function logs() {
    return $this->morphMany(Log::class, 'loggable')->latest();
  }

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }

  public static function rules(array $only = null): array {
    $rules = collect([
      'manuscript_id' => ['required', 'uuid', 'exists:manuscripts,id'],
      'role_id' => ['required', 'int', 'exists:roles,id'],
      'user_id' => ['required', 'uuid', 'exists:users,id'],
      'status' => ['required', 'string', 'max:255'],
      'decision' => ['required', 'string', 'max:255'],
      'notes' => ['nullable', 'array', 'min:3'],
      'notes.blocks' => ['nullable', 'array', 'min:1'],
      'filesId' => ['nullable', 'array',],
      'filesId.*' => ['nullable', 'uuid', 'exists:files,id'],
      'deadline' => ['required', 'date', 'after_or_equal:today'],

    ]);

    if ($only) {
      $rules = $rules->only($only);
    }
    return $rules->toArray();
  }

  public static function messages(): array {
    return [
      'deadline.after_or_equal' => 'Deadline must be after or equal today',
      'deadline.required' => 'Deadline is required',
      'deadline.date' => 'Deadline must be a date',
      'manuscript_id.required' => 'Manuscript is required',
      'role_id.required' => 'Role is required',
      'user_id.required' => 'User is required',
      'status.required' => 'Status is required',
      'decision.required' => 'Decision is required',
      'filesId.*.uuid' => 'File is required',
      'filesId.*.exists' => 'File is required',
      'notes.*.required' => 'Notes are required',
      'notes.*.min' => 'Notes must be at least 3 characters',
      'notes.*.max' => 'Notes may not be greater than 1000 characters',
    ];
  }
}
