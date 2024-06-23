<?php

namespace App\Models\Manuscript;

use App\Models\Log;
use App\Models\Role;
use App\Models\SubGate;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Task extends Model {
  use HasUlids;

  protected $guarded = ['id'];
  protected $with = ['details'];

  public function subGate() {
    return $this->belongsTo(SubGate::class);
  }

  public function details() {
    return $this->hasMany(TaskDetail::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function manuscript() {
    return $this->belongsTo(Manuscript::class);
  }

  public function role() {
    return $this->belongsTo(Role::class);
  }

  public function parent() {
    return $this->belongsTo(Task::class, 'parent_id');
  }
  public function children() {
    return $this->hasMany(Task::class, 'parent_id');
  }

  public function logs() {
    return $this->morphMany(Log::class, 'loggable')->latest();
  }


  public static function rules(array $only = null): array {
    $rules = collect([
      'manuscript_id' => ['required', 'ulid', 'exists:manuscripts,id'],
      'role_id' => ['required', 'int', 'exists:roles,id'],
      'user_id' => ['required', 'ulid', 'exists:users,id'],
      'status' => ['required', 'string', 'max:255'],
      'decision' => ['required', 'string', 'max:255'],
      'notes' => ['nullable', 'array', 'min:3'],
      'notes.blocks' => ['nullable', 'array', 'min:1'],
      'filesId' => ['nullable', 'array',],
      'filesId.*' => ['nullable', 'ulid', 'exists:files,id'],
      'deadline' => ['required', 'int', 'min:1'],

      'parent_id' => ['nullable', 'ulid', 'exists:tasks,id'],
      'sub_gate_id' => ['nullable', 'ulid', 'exists:sub_gates,id'],

      'academic_editor' => ['required', 'array', 'min:1'],
      'academic_editor.*.id' => ['required', 'ulid', 'exists:users,id'],
      'academic_editor.*.status' => ['required', 'string', 'max:255'],

      'reviewer' => ['required', 'array', 'min:2'],
      'reviewer.*.id' => ['required', 'ulid', 'exists:users,id'],
      'reviewer.*.status' => ['required', 'string', 'max:255'],
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
      'filesId.*.ulid' => 'File is required',
      'filesId.*.exists' => 'File is required',
      'notes.*.required' => 'Notes are required',
      'notes.*.min' => 'Notes must be at least 3 characters',
      'notes.*.max' => 'Notes may not be greater than 1000 characters',

      'parent_id.ulid' => 'Parent task is required',
      'parent_id.exists' => 'Parent task is required',
      'sub_gate_id.ulid' => 'Sub gate is required',
      'sub_gate_id.exists' => 'Sub gate is required',

      'academic_editor.required' => 'Academic editor is required',
      'academic_editor.min' => 'Academic editor must be at least 1',
      'academic_editor.*.required' => 'Academic editor is required',
      'academic_editor.*.id.required' => 'Academic editor is required',
      'academic_editor.*.id.ulid' => 'Academic editor is required',
      'academic_editor.*.id.exists' => 'Academic editor is required',
      'academic_editor.*.status.required' => 'Academic editor status is required',
      'academic_editor.*.status.max' => 'Academic editor status is required',

      'reviewer.required' => 'Reviewer is required',
      'reviewer.min' => 'Reviewer must be at least 2',
      'reviewer.*.required' => 'Reviewer is required',
      'reviewer.*.id.required' => 'Reviewer is required',
      'reviewer.*.id.ulid' => 'Reviewer is required',
      'reviewer.*.id.exists' => 'Reviewer is required',
      'reviewer.*.status.required' => 'Reviewer status is required',
      'reviewer.*.status.max' => 'Reviewer status is required',

    ];
  }
}
