<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use App\Services\Client\AnswerServices;

class QuestionServices extends TransformerService{
  protected $answerServices;

  public function __construct(AnswerServices $answerServices) {
    $this->answerServices = $answerServices;
  }

	public function transform($question){
		return [
      'id' => $question->id,
      'description' => $question->description,
      'explanation' => $question->explanation,
      'answers' => $this->answerServices->transformCollection($question->answers)
		];
	}
}
