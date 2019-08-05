<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
  public function owner() {
    return $this->morphOne('App\User', 'owner');
  }
}
