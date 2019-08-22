<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use App\Services\Client\AnswerServices;
use App\Services\Client\AnswerStudentServices;
use App\Services\Client\ContentServices;

class QuestionServices extends TransformerService{
  protected $answerServices;

  public function __construct(AnswerServices $answerServices, AnswerStudentServices $answerStudentServices, ContentServices $contentServices) {
    $this->answerServices = $answerServices;
    $this->answerStudentServices = $answerStudentServices;
    $this->contentServices = $contentServices;
  }

	public function transform($question){
		return [
      'id' => $question->id, 
      'description' => $question->description,
      'explanation' => $question->explanation,
      'answers' => $this->answerServices->transformCollection($question->answers),
      'totalAnswers' => $this->answerStudentServices->getTotalStudents($question->answers),
      'submitted' => false,
      'selected' => false,
      'contents' => $question->image ? $this->contentServices->getContents($question) : null
		];
	}
}
