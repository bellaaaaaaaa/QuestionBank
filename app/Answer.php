<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {
  protected $fillable = [
    'guardian_id', 'description', 'correct'
  ];

  public function question(){
    return $this->belongsTo('App\Question');
  }

  public function students(){
    return $this->belongsToMany('App\Student', 'answer_student');
  }
}
