<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnswerStudent extends Pivot {
  protected $fillable = [
    'answer_id', 'student_id'
  ];

  public function answer(){
    return $this->belongsTo('App\Answer');
  }

  public function student(){
    return $this->belongsTo('App\Student');
  }
}
