<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Exam extends Pivot {
  protected $table = 'exams';

  protected $fillable = [
    'question_id', 'student_id', 'answer_id', 'attempt'
  ];

  public function question(){
    return $this->belongsTo('App\Question');
  }

  public function student(){
    return $this->belongsTo('App\Student');
  }
}
