<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function guardian(){
        return $this->belongsToMany('App\Guardian', 'guardian_student');
    }
    public function subject(){
        return $this->belongsToMany('App\Subject','student_subject');
    }
}

