<?php

namespace App\Policies;

use App\Models\Manuscript\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy {
  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->currentRole->slug != 'author';
  }
  public function view(User $user, Task $task): bool {
    $subGate = request()->subGate;
    return $task->subGate->id == $subGate->id && $user->currentRole->slug != 'author' && $task->user_id == $user->id;
  }

  public function makeDecision(User $user, Task $task): bool {
    $subGate = request()->subGate;
    return $task->subGate->id == $subGate->id && !($user->currentRole->slug == 'author' || $user->currentRole->slug == 'reviewer' || $user->currentRole->slug == 'academic-editor') && $task->user_id == $user->id;
  }

  public function update(User $user, Task $task): bool {
    $subGate = request()->subGate;
    return $task->subGate->id == $subGate->id && $user->currentRole->slug != 'author' && $task->user_id == $user->id && $task->role_id == $user->current_role_id;
  }
}
