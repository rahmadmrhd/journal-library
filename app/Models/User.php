<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Manuscript\Task;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\ManuscriptAuthor;
use App\Models\Manuscript\TaskDetail;
use App\Models\Manuscript\TaskInvitation;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
  use HasFactory, Notifiable, SoftDeletes, HasUlids, EagerLoadPivotTrait;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  // protected $fillable = [
  //     'name',
  //     'email',
  //     'password',
  // ];
  protected $guarded = ['id'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  // protected $with = [
  //   'currentRole',
  // ];

  public function roles() {
    return $this->belongsToMany(Role::class, 'role_user')->using(RoleUser::class)->withPivot(['sub_gate_id']);
  }

  public function currentRole() {
    return $this->belongsTo(Role::class, 'current_role_id');
  }

  public function getFullName(): string {
    return $this->title . ' ' . $this->first_name . ' ' . $this->last_name . ' ' . $this->degree;
  }

  public function manuscripts() {
    return $this->belongsToMany(Manuscript::class, 'manuscript_author')->using(ManuscriptAuthor::class);
  }

  public function country() {
    return $this->belongsTo(Country::class);
  }

  public function logs() {
    return $this->hasMany(Log::class,);
  }

  public function tasks() {
    return $this->hasMany(Task::class);
  }

  public function invitations() {
    return $this->belongsToMany(Task::class, 'task_invitations', 'user_id', 'task_id')->using(TaskInvitation::class)->withPivot([
      'invited_at',
      'status'
    ]);
  }
}
