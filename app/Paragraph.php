<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model {
  protected $fillable = [
    'description'
  ];

  public function item() {
    return $this->morphOne('App\Content', 'item');
  }
}
