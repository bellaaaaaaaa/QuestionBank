<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
  protected $fillable = [
    'path', 'name'
  ];

  public function item() {
    return $this->morphOne('App\Content', 'item');
  }
}
