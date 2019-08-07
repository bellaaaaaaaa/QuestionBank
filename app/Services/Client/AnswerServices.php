<?php

namespace App\Services\Client;

use Illuminate\Http\Request;

use App\Services\TransformerService;
use App\Services\Client\StudentServices;

class AnswerServices extends TransformerService{
  protected $studentServices;

  public function __construct(StudentServices $studentServices) {
    $this->studentServices = $studentServices;
  }

  public function getStudents($answer) {
    $students =  $this->studentServices->transformCollection($answer->students);

    if(!$students) {
      return [];
    }

    return $students;
  }

	public function transform($answer){
		return [
      'id' => $answer->id,
      'description' => $answer->description,
      'correct' => $answer->correct,
      'students' => $this->getStudents($answer)
		];
	}
}
