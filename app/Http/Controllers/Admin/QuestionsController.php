<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\QuestionServices;
use App\Question;
use App\Topic;
use App\Subject;
use Session;

class QuestionsController extends Controller{
  protected $path = 'admin.questions.';
  protected $questionServices;

  public function __construct(QuestionServices $questionServices){
    $this->questionServices = $questionServices;
  }

  public function index(Request $request){ 
    if ($request->isJson()) {
      return $this->questionServices->all($request);
    }
    return view($this->path . 'index');
  }
  
  public function create(){
    $topics = Topic::pluck('name','id');

    return view($this->path . 'create', ['topics' => $topics]);
  }

  public function store(Request $request) {
    return $this->questionServices->create($request);
  }  

  public function edit(Question $question){
    $question = $this->questionServices->getAttributes($question);

    return view($this->path . 'edit',['question' => $question]);
  }
  
  public function update(Request $request, Question $question){
    $this->questionServices->update($request, $question);
    Session::flash('success', 'Question updated.');
    return route('questions.edit',['question' => $question]);
  }

  public function destroy(Question $question){

    $question->delete();

    return success();
  }

  public function import(Request $request, Subject $subject){
    return $this->questionServices->import($request, $subject);  
  }
}
