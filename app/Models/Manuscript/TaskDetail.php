<?php

namespace App\Models\Manuscript;

use App\Models\Form\FormAnswer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model {
  use HasFactory, HasUlids;

  protected $guarded = ['id'];
  protected $table = "task_details";
  protected $casts = [
    'notes' => 'array',
  ];

  public function task() {
    return $this->belongsTo(Task::class);
  }

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }

  public function invites() {
    return $this->belongsToMany(User::class, 'task_invitations', 'task_id', 'user_id', 'task_id')->using(TaskInvitation::class)->withPivot([
      'invited_at',
      'status'
    ]);
  }

  public function responses() {
    return $this->morphMany(FormAnswer::class, 'answerable');
  }


  public function toRole() {
    return $this->belongsTo(Role::class, 'to_role_id', 'id');
  }
}
