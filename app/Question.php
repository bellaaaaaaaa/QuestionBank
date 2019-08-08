<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
  protected $fillable = [
    'topic_id', 'description'
  ];

  public function topic() {
    return $this->belongsTo('App\Topic');
  }
  
  public function answers() {
    return $this->hasMany('App\Answer');
  }

  public function students(){
    return $this->belongsToMany('App\Student', 'exams', 'question_id', 'student_id');
  }
}
