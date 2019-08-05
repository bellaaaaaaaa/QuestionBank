<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
  protected $fillable = [
    'teacher_id', 'name', '1_month_price', '2_month_price', '3_month_price'
  ];

  public function students(){
    return $this->belongsToMany('App\Student', 'student_subject');
  }

  public function topics(){
    return $this->hasMany('App\Topic');
  }
}

