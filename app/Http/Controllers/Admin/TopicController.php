<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TopicServices;
use App\Topic;
use Session;

class TopicController extends Controller
{
    protected $path = 'admin.topics.';
    protected $topicServices;

    public function __construct(TopicServices $topicServices){
        $this->topicServices = $topicServices;
      }

    public function index(Request $request){
        if ($request->isJson()) {
			return $this->topicServices->all($request);
		}
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

  public function edit(Topic $topic) {
      return view($this->path . 'edit', ['topic' => $topic]);
  }

  public function update(Topic $topic, Request $request) {
    
    $topic->name = $request->name;
    $topic->save();
    
    Session::flash('success','This topic has been successfully saved!');
    return redirect()->route('topics.index');
  }

    

    public function destroy(Topic $topic){
        $topic->delete();

		return success();
    }
}
