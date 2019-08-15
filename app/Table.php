<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {
  protected $fillable = [
    'content'
  ];

  public function item() {
    return $this->morphOne('App\Content', 'item');
  }
}
