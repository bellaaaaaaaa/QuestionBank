<?php

namespace App\Services\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class StudentServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
		$order = $request->order ? $request->order : 'desc';
		$limit = $request->limit ? $request->limit : 10;
		$offset = $request->offset ? $request->offset : 0;
		$query = $request->search ? $request->search : '';

    $students = Student::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
    $listCount = $students->count();

    $students = $students->limit($limit)->offset($offset)->get();

    return respond(['rows' => $students, 'total' => $listCount]);
	}

	public function transform($student){
		return [
			'id' => $student->id,
			'name' => $student->name,
			'email' => $student->email,
		];
	}
}
