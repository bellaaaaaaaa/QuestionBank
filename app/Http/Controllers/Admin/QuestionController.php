<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use Session;

class QuestionController extends Controller
{
    protected $path = 'admin.questions.';

    public function index(Request $request){
      if ($request->isJson()) {
        return $this->teamServices->all($request);
      }
      
      return view($this->path . 'index');
    }
    public function create(){
      return view($this->path . 'create');
    }

    public function store(Request $request){
        $this->validate($request,array(
          'question'=>'required|max:255')
      );

    $question = new Question();
    $question->question = $request -question;
    $question->save();

    Session::flash('success','This question has been successfully saved!');

      return redirect()->route('questions.index');
    }


    public function destroy(Question $question){
      $question->delete();

      return success();
    }
  }
