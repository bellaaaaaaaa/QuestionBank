<?php

namespace App\Services\Admin;

use App\Subject;

use Illuminate\Http\Request;
use App\Services\TransformerService;

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
  
  public function create(Request $request) {
    $request->validate([
      'teacher_id'=>'required|max:255|unique:teachers,id',
      'name'=>'required|max:255|unique:subjects',
      'description' => 'required',
      'one_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
      'two_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
      'three_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
    ]);
    
    Subject::create([
      'teacher_id' => 1, //$request->teacher,
      'name' => $request->name,
      'description' => $request->description,
      'one_month_price' => $request->one_month_price,
      'two_month_price' => $request->two_month_price,
      'three_month_price' => $request->three_month_price
    ]);

    return redirect()->route('subjects.index');
  }

  public function update(Request $request, Subject $subject) {
    $request->validate([
      'teacher_id'=>'required|max:255|unique:teachers,id,' . $subject->teacher_id,
      'name'=>'required|max:255|unique:subjects,id,' . $subject->id,
      'description' => 'required',
      'one_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
      'two_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
      'three_month_price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
    ]);
    
    $subject->teacher_id = $request->teacher_id;
    $subject->name = $request->name;
    $subject->description = $request->description;
    $subject->one_month_price = $request->one_month_price;
    $subject->two_month_price = $request->two_month_price;
    $subject->three_month_price = $request->three_month_price;
    $subject->save();

    return redirect()->route('subjects.index');
  }

	public function transform($subject){
		return [
			'id' => $subject->id,
			'name' => $subject->name
		];
	}
}
