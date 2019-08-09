<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model {
  public function owner() {
    return $this->morphOne('App\User', 'owner');
  }
  
  public function students(){
    return $this->belongsToMany('App\Student', 'guardian_student');
  }
}
