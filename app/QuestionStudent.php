<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionStudent extends Pivot {
  protected $fillable = [
    'question_id', 'student_id', 'num_of_attempts_left'
  ];
}
