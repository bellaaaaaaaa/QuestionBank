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

	public function transform($answer){
		return [
      'id' => $answer->id,
      'description' => $answer->description,
      'correct' => $answer->correct
		];
	}
}
