<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AnswerServices;
use App\Answer;
use Session;

class AnswerController extends Controller
{
    protected $path = 'admin.answers.';
    protected $answerServices;

    public function __construct(AnswerServices $answerServices){
      $this->answerServices = $answerServices;
    }

  public function index(Request $request){
		if ($request->isJson()) {
			return $this->answerServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }


  public function store(Request $request){
    $this->validate($request, [
        'name'=>'required|max:255'
    ]);
    
		$answer = new Answer();
		$answer->name = $request->name;
		
		$answer->save();

    Session::flash('success','Successfully saved!');
		return redirect()->route('answers.index');
  }

  public function edit(Answer $answer) {
  return view($this->path . 'edit', ['answer' => $answer]);
  }

  public function update(Answer $answer, Request $request) {
  
    $answer->name = $request->name;
    $answer->save();
    Session::flash('success','Successfully saved!');
  return redirect()->route('answers.index');
  }

  public function destroy(Answer $answer){
    $answer->delete();

		return success();
  }
}
