<?php

namespace App\Http\Controllers\Client;

use App\Topic;
use App\Purchase;
use App\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Client\QuizServices;

class QuizzesController extends Controller {
  protected $path = 'client.quizzes.'; 
  protected $quizServices;
  
  public function __construct(QuizServices $quizServices) {
    $this->quizServices = $quizServices;
  }

  public function showTopics(Student $student) {
    $subject = get_student_subject();
    $topics = $this->quizServices->getTopics($subject);
    $student = current_user()->owner;

    return view($this->path . 'topics', ['subject' => $subject, 'topics' => $topics]);
  }

  public function showQuestions(Topic $topic) {
    $subject = get_student_subject();
    $questions = $this->quizServices->getQuestions($topic);
    $topic = $this->quizServices->transform($topic);
    $student = current_user()->owner;
    
    $coursePurchase = Purchase::where('student_id', $student->id)->where('subject_id', $subject->id)->first();

    return view($this->path . 'question', ['subject' => json_encode($subject), 'topic' => json_encode($topic), 'questions' => json_encode($questions)]);
  }

  public function showTrials() {
    $subject = get_student_subject();
   
    $firstTopic = $subject->topics->first();

    return $this->showQuestions($firstTopic);
  }

  public function answer(Request $reqeust) {
    return $this->quizServices->saveAnswer($reqeust);
  }
}
