<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {
  protected $fillable = [
    'question_id', 'content'
  ];

  public function question() {
    return $this->belongsTo('App\Question');
  }
}
