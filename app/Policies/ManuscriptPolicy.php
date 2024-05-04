<?php

namespace App\Policies;

use App\Models\Manuscript;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ManuscriptPolicy {
  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return true;
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Manuscript $manuscript): bool {
    return $user->id === $manuscript->user()->id;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return $user->getCurrentRole()->slug === 'author';
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Manuscript $manuscript): bool {
    switch ($user->getCurrentRole()->slug) {
      case 'author':
        return $user->id === $manuscript->user()->id;
      case 'editor':
      case 'admin':
        return true;
      default:
        return false;
    }
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Manuscript $manuscript): bool {
    switch ($user->getCurrentRole()->slug) {
      case 'author':
        return $user->id === $manuscript->user()->id;
      case 'admin':
        return true;
      default:
        return false;
    }
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Manuscript $manuscript): bool {
    switch ($user->getCurrentRole()->slug) {
      case 'author':
        return $user->id === $manuscript->user()->id;
      case 'admin':
        return true;
      default:
        return false;
    }
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Manuscript $manuscript): bool {
    switch ($user->getCurrentRole()->slug) {
      case 'author':
        return $user->id === $manuscript->user()->id;
      case 'admin':
        return true;
      default:
        return false;
    }
  }
}
