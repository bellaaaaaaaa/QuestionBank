<?php

namespace App\Services\Admin;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class StudentServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
		$order = $request->order ? $request->order : 'desc';
		$limit = $request->limit ? $request->limit : 10;
		$offset = $request->offset ? $request->offset : 0;
		$query = $request->search ? $request->search : '';

		$students = Student::whereHas('owner', function($student) use ($query) { 
			$student->where('name', 'like', "%{$query}%");
		})->orderBy($sort, $order);

		// $students = Student::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
		$listCount = $students->count();

		$students = $students->limit($limit)->offset($offset)->get();

    return respond(['rows' => $this->transformCollection($students), 'total' => $listCount]);
	}

	public function transform($student){

		// if($student instanceof User){
		// 	$student = $student->owner;
		// }
		return [
			'id' => $student->id,
			'name' =>$student->owner->name,
			'email'=> $student->owner->email,
			'nric' => $student->nric,
			'age' => $student->age
		];
	}
}