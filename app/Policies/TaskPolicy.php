<?php

namespace App\Policies;

use App\Models\Manuscript\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy {
  use HandlesAuthorization;

  public function viewAny(User $user): bool {
    return $user->getCurrentRole() != 'author';
  }
  public function view(User $user, Task $task): bool {
    return $user->getCurrentRole() != 'author' && $task->user_id == $user->id;
  }

  public function makeDecision(User $user, Task $task): bool {
    return !($user->getCurrentRole() == 'author' || $user->getCurrentRole() == 'reviewer' || $user->getCurrentRole() == 'academic-editor') && $task->user_id == $user->id;
  }

  public function update(User $user, Task $task): bool {
    return $user->getCurrentRole() != 'author' && $task->user_id == $user->id && $task->role_id == $user->current_role_id;
  }
}
