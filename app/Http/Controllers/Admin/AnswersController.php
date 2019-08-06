<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AnswerServices;
use App\Question;
use App\Answer;
use Session;

class AnswersController extends Controller
{
    protected $path = 'admin.answers.';
    protected $answerServices;

    public function __construct(AnswerServices $answerServices){
      $this->answerServices = $answerServices;
    }

  public function index(Request $request){
		if ($request->wantsJson()) {
			return $this->answerServices->all($request);
    }
    
		return view($this->path . 'index');
  }

  public function create(){
    $questions = Question::pluck('name','id');

		return view($this->path . 'create',['questions' => $questions]);
  }


  public function store(Request $request){
    $this->validate($request, [
        'name'=>'required|max:255'
    ]);
    
		$answer = new Answer();
		$answer->name = $request->name;
		$answer->question_id = $request->question_id;
		$answer->save();

    Session::flash('success','Successfully saved!');
		return redirect()->route('answers.index');
  }

  public function edit(Answer $answer) {
    $questions = Question::pluck('name','id');

    return view($this->path . 'edit', ['answer' => $answer,'questions' => $questions]);
  }

  public function update(Answer $answer, Request $request) {
    $answer->name = $request->name;
    $answer->question_id = $request->question_id;
    $answer->save();

    Session::flash('success','Successfully saved!');
    return redirect()->route('answers.index');
  }

  public function destroy(Answer $answer){
    $answer->delete();

		return success();
  }
}
