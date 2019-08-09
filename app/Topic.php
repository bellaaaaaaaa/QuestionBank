<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
  protected $fillable = [
    'subject_id', 'name', 'abbreviation'
  ];

  public function subject(){
    return $this->belongsTo('App\Subject');
  }
  
  public function questions(){
    return $this->hasMany('App\Question');
  }
}