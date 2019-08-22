<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Purchase extends Pivot {
  protected $table = 'purchases';

  protected $fillable = [
    'student_id', 'subject_id', 'expiration_date'
  ];

  public function student() {
    return $this->belongsTo('App\Student');
  }

  public function subject() {
    return $this->belongsTo('App\Subject');
  }
}
