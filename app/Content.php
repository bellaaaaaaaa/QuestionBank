<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Model;

Relation::morphMap([
  'Table' => 'App\Table',
  'Image' => 'App\Image',
  'Paragraph' => 'App\Paragraph'
]);

class Content extends Model {

  protected $fillable = [
    'question_id', 'item_id', 'item_type', 'order'
  ];

  public function question() {
    return $this->belongsTo('App\Question');
  }

  public function item() {
    return $this->morphTo();
  }
}
