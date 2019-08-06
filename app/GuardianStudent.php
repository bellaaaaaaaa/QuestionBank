<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GuardianStudent extends Pivot {
  protected $fillable = [
    'guardian_id', 'student_id', 'relationship'
  ];

  public function guardian(){
    return $this->belongsTo('App\Guardian');
  }

  public function student(){
    return $this->belongsTo('App\Student');
  }
}
