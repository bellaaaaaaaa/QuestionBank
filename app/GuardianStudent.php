<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuardianStudent extends Model
{
    public function guardian(){
        return $this->belongsTo('App\Guardian');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
