<?php

namespace App\Services\Client;

use App\Subject;
use App\Question;
use App\Exam;

use Illuminate\Http\Request;

use App\Services\Client\QuestionServices;
use App\Services\Client\AnswerStudentServices;
use App\Services\TransformerService;

class ExamServices extends TransformerService{
  protected $questionServices;
  protected $answerStudentServices;

  public function __construct(QuestionServices $questionServices, AnswerStudentServices $answerStudentServices) {
    $this->questionServices = $questionServices;
    $this->answerStudentServices = $answerStudentServices;
  }

  public function getQuestions(Subject $subject) {
    $questions = Question::whereHas('topic.subject', function($query) use ($subject) {
      $query->where('id', $subject->id);
    })->get();

    if($questions) {
      $length = count($questions);

      $questions = $length >= 100 ? $questions->random(100) : $questions->random(3);
     
      return $this->questionServices->transformCollection($questions); 
    }

    return null;
  }

  public function saveAnswer(Request $request) {
    $request->validate([
	    "question_id" => "required",
	    "answer_id" => "required"
    ]);
    
    $student = current_user()->owner;
    
    $exam = Exam::where('question_id', $request->question_id)->where('student_id', $student->id)->where('attempt', 1)->first();

    if($exam) {
      $exam->answer_id = $request->answer_id;
      $exam->save();
    }else {
      Exam::create([
        'question_id' => $request->question_id,
        'student_id' => $student->id,
        'answer_id' => $request->answer_id,
        'attempt' => 1
      ]);
    }

    return success();
  }

	public function transform($topic){
		return [
      'id' => $topic->id,
      'name' => $topic->name
		];
	}
}
