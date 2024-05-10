<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\ManuscriptAuthor;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
  use HasFactory, Notifiable, SoftDeletes, HasUuids, EagerLoadPivotTrait;

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
  public function roles() {
    return $this->belongsToMany(Role::class, 'role_user');
  }
  public function getFullName(): string {
    return $this->title . ' ' . $this->first_name . ' ' . $this->last_name . ' ' . $this->degree;
  }
  public function getCurrentRole(): Role {
    return Role::find($this->current_role_id);
  }

  public function manuscripts() {
    return $this->belongsToMany(Manuscript::class, 'manuscript_author')->using(ManuscriptAuthor::class);
  }
}
