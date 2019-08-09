<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {
  protected $fillable = [
    'question_id', 'description', 'correct'
  ];

  public function question(){
    return $this->belongsTo('App\Question');
  }

  public function students(){
    return $this->belongsToMany('App\Student', 'answer_student');
  }
}
