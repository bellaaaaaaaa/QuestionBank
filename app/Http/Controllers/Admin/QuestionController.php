<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionServices;
use App\Question;
use App\Topic;
use Session;

class QuestionController extends Controller
{
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
      $this->validate($request, [
        "name" => "required"
      ]);

      $question = new Question();
      $question->name = $request->name;
      $question->explanation = $request->explanation;
      $question->topic_id = $request->topic_id;
      $question->save();

    Session::flash('success','This question has been successfully saved!');

      return redirect()->route('questions.index');
    }
    public function edit(Question $question){
      $topics = Topic::pluck('name','id');

      return view($this->path . 'edit',['question'=>$question,'topics'=>$topics]);
    }
    
    public function update(Request $request, Question $question){

      $question->name = $request->name;
      $question->explanation = $request->explanation;
      $question->topic_id = $request->topic_id;
      $question->save();

      Session::flash('success','This question has been successfully saved!');
      return redirect()->route('questions.index');
    }
  
    public function destroy(Question $question){
      $question->delete();

      return success();
    }
  }
