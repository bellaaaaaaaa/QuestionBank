<?php

namespace App\Services\Admin;

use App\Answer;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class AnswerServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
        $order = $request->order ? $request->order : 'desc';
        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->offset ? $request->offset : 0;
        $query = $request->search ? $request->search : '';

        $answers =  Answer::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
        $listCount = $answers->count();

        $answers = $answers->limit($limit)->offset($offset)->get();

        // return respond(['rows' => $questions, 'total' => $listCount]);
        return respond(['rows' => $this->transformCollection($answers), 'total' => $listCount]);
	}

    // public function transformDate($date) {

        
    //     return $date;
    // }

	public function transform($answer){
		return [
            'id' => $answer->id,
            'name' => $answer->name,
            // 'name' => $this->transformDate($question->created_at),
            'correct' =>  $answer->correct,
            'question' => $answer->question ? $answer->question->name:'-',
            'content' => $answer->name,
            'isAnswer' => $answer->correct
		];
	}
}
