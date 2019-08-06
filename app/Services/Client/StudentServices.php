<?php

namespace App\Services\Client;

use App\Student;

use Illuminate\Http\Request;
use App\Services\TransformerService;

class StudentServices extends TransformerService{

	public function transform($student){
		return [
      'id' => $student->id,
      'name' => $student->owner->name,
      'email' => $student->owner->email,
      'email' => $student->nric,
      'age' => $student->age
		];
	}
}
