<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    public function student(){
        return $this->belongsToMany('App\Student', 'guardian_student');
    }
}
