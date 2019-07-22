<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionServices;
use App\Question;
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
      return view($this->path . 'create');
    }

    public function store(Request $request) {
      $this->validate($request, [
        "name" => "required"
      ]);

      $question = new Question();
      $question->name = $request->name;
      $question->explanation = $request->explanation;
      $question->save();

    Session::flash('success','This question has been successfully saved!');

      return redirect()->route('questions.index');
    }


    public function destroy(Question $question){
      $question->delete();

      return success();
    }
  }
