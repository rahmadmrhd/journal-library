<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot {
  protected $table = 'role_user';
  protected $with = [];
  public function subGate() {
    return $this->belongsTo(SubGate::class, 'sub_gate_id');
  }
}
