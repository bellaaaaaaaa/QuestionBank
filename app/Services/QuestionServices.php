<?php

namespace App\Services;

use App\Question;
use Illuminate\Http\Request;

class QuestionServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
        $order = $request->order ? $request->order : 'desc';
        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->offset ? $request->offset : 0;
        $query = $request->search ? $request->search : '';

        $questions =  Question::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
        $listCount = $questions->count();

        $questions = $questions->limit($limit)->offset($offset)->get();

        // return respond(['rows' => $questions, 'total' => $listCount]);
        return respond(['rows' => $this->transformCollection($questions), 'total' => $listCount]);
	}

    // public function transformDate($date) {

        
    //     return $date;
    // }

	public function transform($question){
		return [
            'id' => $question->id,
            'name' => $question->name,
            // 'name' => $this->transformDate($question->created_at),
            'correct_attempts' =>  $question->number_of_correct_attempts,
            'explanation' => $question->explanation
		];
	}
}
