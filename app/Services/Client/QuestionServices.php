<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use App\Services\Client\AnswerServices;
use App\Services\Client\AnswerStudentServices;

class QuestionServices extends TransformerService{
  protected $answerServices;

  public function __construct(AnswerServices $answerServices, AnswerStudentServices $answerStudentServices) {
    $this->answerServices = $answerServices;
    $this->answerStudentServices = $answerStudentServices;
  }

	public function transform($question){
		return [
      'id' => $question->id,
      'description' => $question->description,
      'explanation' => $question->explanation,
      'answers' => $this->answerServices->transformCollection($question->answers),
      'totalAnswers' => $this->answerStudentServices->getTotalStudents($question->answers)
		];
	}
}
