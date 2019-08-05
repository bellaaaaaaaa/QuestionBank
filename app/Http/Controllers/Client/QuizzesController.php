<?php

namespace App\Http\Controllers\Client;

use App\Topic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Client\QuizServices;

class QuizzesController extends Controller {
  protected $path = 'client.quizzes.'; 
  protected $quizServices;
  
  public function __construct(QuizServices $quizServices) {
    $this->quizServices = $quizServices;
  }

  public function showTopics() {
    $subject = get_student_subject();
    $topics = $this->quizServices->getTopics();

    return view($this->path . 'topics', ['subject' => $subject, 'topics' => $topics]);
  }

  public function showQuestions(Topic $topic) {
    $subject = json_encode(get_student_subject());
    $questions = json_encode($this->quizServices->getQuestions($topic));

    return view($this->path . 'question', ['subject' => $subject, 'questions' => $questions]);
  }
}
