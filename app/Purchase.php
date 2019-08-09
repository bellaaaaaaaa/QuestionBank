<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Purchase extends Pivot {
  protected $table = 'purchases';

  protected $fillable = [
    'login_to', 'nric', 'age'
  ];

  public function student() {
    return $this->belongsTo('App\Student');
  }

  public function subject() {
    return $this->belongsTo('App\Subject');
  }
}
