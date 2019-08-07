<?php

namespace App\Services\Client;

use App\Topic;

use Illuminate\Http\Request;

use App\Services\Client\TopicServices;
use App\Services\Client\QuestionServices;
use App\Services\Client\AnswerStudentServices;
use App\Services\TransformerService;

class QuizServices extends TransformerService{
  protected $topicServices;

  public function __construct(TopicServices $topicServices, QuestionServices $questionServices, AnswerStudentServices $answerStudentServices) {
    $this->topicServices = $topicServices;
    $this->questionServices = $questionServices;
    $this->answerStudentServices = $answerStudentServices;
  }

  public function getTopics($subject) {
    return $this->topicServices->transformCollection($subject->topics);
  }

  public function getQuestions(Topic $topic) {
    return $this->questionServices->transformCollection($topic->questions);
  }

  public function saveAnswer(Request $request) {
    $request->validate([
	    "answer_id" => "required"
    ]);

    $answerStudent = $this->answerStudentServices->save($request);
    
    return success();
  }

	public function transform($topic){
		return [
      'id' => $topic->id,
      'name' => $topic->name
		];
	}
}
