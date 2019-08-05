<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Services\TransformerService;

class AnswerServices extends TransformerService{
	public function transform($answer){
		return [
      'id' => $answer->id,
      'description' => $answer->description,
      'correct' => $answer->correct
		];
	}
}
