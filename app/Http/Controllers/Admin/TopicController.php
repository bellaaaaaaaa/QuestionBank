<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Topic;
use Session;

class TopicController extends Controller
{
    protected $path = 'admin.topics.';
    
    public function index(Request $request){
    return view($this->path . 'index');
    }

    public function create(){
    return view($this->path . 'create');
    }

    public function store(Request $request){
        $this->validate($request, [
			"name" => "required",
		]);

        $topic = new Topic();
		$topic->name = $request->name;
		// $topic->subject_id = $request->subject_id;
        $topic->save();

        Session::flash('success','This topic has been successfully saved!');

		return redirect()->route('topics.index');
  }
    

    public function destroy(Topic $topic){
    }
}
