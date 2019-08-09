<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Client\ExamServices;

class ExamsController extends Controller {
  protected $path = 'client.exams.'; 
  protected $examServices;
  
  public function __construct(ExamServices $examServices) {
    $this->examServices = $examServices;
  }

  public function showMCQ(Request $request) {
    $subject = get_student_subject();
   
    if($request->wantsJson()) {
      return $this->examServices->getQuestions($subject);
    }
    
    $questions = $this->examServices->getQuestions($subject);
    
    return view($this->path . 'exam', ['subject' => json_encode($subject), 'questions' => json_encode($questions)]);
  }

  public function answer(Request $reqeust) {
    return $this->examServices->saveAnswer($reqeust);
  }
}
