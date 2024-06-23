<?php

namespace App\Models\Manuscript;

use App\Models\Role;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskInvitation extends Pivot {
  use HasUlids;

  protected $guarded = ['id'];
  protected $with = [
    'invited_at',
    'status',
    'role'
  ];

  public function taskDetail() {
    return $this->belongsTo(TaskDetail::class, 'task_detail_id');
  }

  public function role() {
    return $this->belongsTo(Role::class, 'role_id');
  }
}
