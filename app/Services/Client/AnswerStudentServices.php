<?php

namespace App\Services\Client;

use App\Answer;
use App\AnswerStudent;

use Illuminate\Http\Request;
use App\Services\TransformerService;

class AnswerStudentServices extends TransformerService{

  public function getTotalStudents($answers) {
    $total = 0;

    foreach($answers as $answer) {
      if($answer->students) {
        $total += count($answer->students);
      }
    }

    return $total;
  }

  public function save(Request $request) {
    $student = current_user()->owner;

    $answerStudentExist = AnswerStudent::where('answer_id', $request->answer_id)->where('student_id', $student->id)->first();

    if($answerStudentExist) {
      return $answerStudentExist;
    }

    return AnswerStudent::create([
      'answer_id' => $request->answer_id,
      'student_id' => current_user()->owner->id
    ]);
  }

	public function transform($answer){
		return [
      'id' => $answer->id,
      'description' => $answer->description,
      'correct' => $answer->correct
		];
	}
}
