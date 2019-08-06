<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionStudent extends Pivot {
  protected $fillable = [
    'question_id', 'student_id', 'num_of_attempts_left'
  ];

  public function question(){
    return $this->belongsTo('App\Question');
  }

  public function student(){
    return $this->belongsTo('App\Student');
  }
}
