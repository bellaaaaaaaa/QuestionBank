<?php

namespace App\Services\Admin;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class QuestionServices extends TransformerService{
 
	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
    $order = $request->order ? $request->order : 'desc';
    $limit = $request->limit ? $request->limit : 10;
    $offset = $request->offset ? $request->offset : 0;
    $query = $request->search ? $request->search : '';

    $questions =  Question::where('description', 'like', "%{$query}%")->orderBy($sort, $order);
    $listCount = $questions->count();

    $questions = $questions->limit($limit)->offset($offset)->get();

    // return respond(['rows' => $questions, 'total' => $listCount]);
    return respond(['rows' => $this->transformCollection($questions), 'total' => $listCount]);
	}

    // public function transformDate($date) {

        
    //     return $date;
    // }

  public function create(Request $request){
    $request->validate([
      'description' => 'required|unique:questions',
      'answers' => 'required|array|min:2',
      'answers.*.correct' => 'required',
      // 'topic' => 'required|numeric'
    ]);
             
    $question = new Question();
    $question->description = $request->description;
    // $question->id = $request->id;
    $question->topic_id = 1;
    $question->save();
        
    foreach($request->answers as $answer){
      $newAnswer = new Answer();
      $newAnswer->description = $answer['description'];
      $newAnswer->correct = $answer['correct'];
      $newAnswer->question_id = $question->id;
      $newAnswer->save();
    }

    return route('questions.index');
}

  public function update(Request $request, Question $question){
    $request->validate([
      'description'=> 'unique:questions,id,' . $question->id,
      'answers' => 'required|array|min:2',
      'answers.*.correct' => 'required',
    ]);

    $question->description = $request->description;
    $question->topic_id = 1;
    $question->save();

    foreach($request->answers as $answer){
      $answer = (object) $answer;
      $answerExist = Answer::find($answer->id);
      //find only needs one parameter!
      if($answerExist && isset($answer->deleted)){
        $this->deleteAnswer($answer);
      } elseif ($answerExist) {
        $this->updateAnswer($answerExist, $answer);
      } else {
        $this->createAnswer($answer, $question);
      }     
    }

    return route('questions.index');  
  }
  
  public function updateAnswer($answerExist, $answer){
    
    $answerExist->description = $answer->description;
    $answerExist->correct = $answer->correct;
    $answerExist->save();
  }

  public function createAnswer($answer, $question){
    $newAnswer = new Answer();
    $newAnswer->description = $answer->description;
    $newAnswer->correct = $answer->correct;
    $newAnswer->question_id = $question->id;
    $newAnswer->save();
  }

  public function deleteAnswer($answer) {
    $answer = Answer::find($answer->id);
    $answer->delete();
  }
    
	public function transform($question){
        
		return [
      'id' => $question->id,
      'description' => $question->description,
      // 'name' => $this->transformDate($question->created_at),
      'correct_attempts' =>  $question->number_of_correct_attempts,
      // 'explanation' => $question->explanation,
      'topic' => $question->topic ? $question->topic->name:'-',
		];
	}
}
