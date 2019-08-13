<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model {
  protected $fillable = [
    'question_id', 'description'
  ];

  public function question() {
    return $this->belongsTo('App\Question');
  }
}
