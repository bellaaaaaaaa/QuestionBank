<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
  protected $fillable = [
    'login_to', 'nric', 'age'
  ];

  public function owner() {
    return $this->morphOne('App\User', 'owner');
  }
  
  public function guardians(){
    return $this->belongsToMany('App\Guardian', 'guardian_student');
  }

  public function subjects(){
    return $this->belongsToMany('App\Subject', 'student_subject');
  }

  public function questions(){
    return $this->belongsToMany('App\Question', 'exams', 'student_id', 'question_id');
  }

  public function loginTo(){
    return $this->belongsTo('App\Subject', 'login_to');
  }

  public function answers(){
    return $this->belongsToMany('App\Answer', 'answer_student');
  }
}

