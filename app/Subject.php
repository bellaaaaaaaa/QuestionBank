<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function student(){
        return $this->belongsToMany('App\Student', 'student_subject');
    }
    public function topic(){
        return $this->hasMany('App\Topic');
    }
}

