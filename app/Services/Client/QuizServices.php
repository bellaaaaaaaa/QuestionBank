<?php

namespace App\Services\Client;

use App\Topic;

use Illuminate\Http\Request;

use App\Services\Client\TopicServices;
use App\Services\Client\QuestionServices;
use App\Services\TransformerService;

class QuizServices extends TransformerService{
  protected $topicServices;

  public function __construct(TopicServices $topicServices, QuestionServices $questionServices) {
    $this->topicServices = $topicServices;
    $this->questionServices = $questionServices;
  }

  public function getTopics($subject) {
    return $this->topicServices->transformCollection($subject->topics);
  }

  public function getQuestions(Topic $topic) {
    return $this->questionServices->transformCollection($topic->questions);
  }

	public function transform($topic){
		return [
      'id' => $topic->id,
      'name' => $topic->name,
      'subject_name' => $topic->subject ? $topic->subject->name : '-'
		];
	}
}
