<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
  protected $fillable = [
    'question_id', 'name'
  ];

  public function question() {
    return $this->belongsTo('App\Question');
  }
}
