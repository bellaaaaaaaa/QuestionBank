<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
  protected $fillable = [
    'teacher_id', 'name', 'description', 'one_month_price', 'two_month_price', 'three_month_price'
  ];

  public function students(){
    return $this->belongsToMany('App\Student', 'student_subject');
  }

  public function topics(){
    return $this->hasMany('App\Topic');
  }
}

