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

  public function attempts(){
    return $this->belongsToMany('App\Question', 'question_subject');
  }

  public function loginTo(){
    return $this->belongsTo('App\Subject', 'login_to');
  }
}

