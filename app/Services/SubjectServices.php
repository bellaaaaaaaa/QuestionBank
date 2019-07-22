<?php

namespace App\Services;

use App\Subject;
use Illuminate\Http\Request;

class SubjectServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
		$order = $request->order ? $request->order : 'desc';
		$limit = $request->limit ? $request->limit : 10;
		$offset = $request->offset ? $request->offset : 0;
		$query = $request->search ? $request->search : '';

    $subjects = Subject::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
    $listCount = $subjects->count();

    $subjects = $subjects->limit($limit)->offset($offset)->get();

    return respond(['rows' => $subjects, 'total' => $listCount]);
	}

	public function transform($subject){
		return [
			'id' => $subject->id,
			'name' => $subject->name
		];
	}
}
