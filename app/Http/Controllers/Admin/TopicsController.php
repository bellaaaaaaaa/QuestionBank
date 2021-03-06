<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use App\Subject;

use Session;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\TopicServices;

class TopicsController extends Controller {
  protected $path = 'admin.topics.';
  protected $topicServices;

  public function __construct(TopicServices $topicServices) {
    $this->topicServices = $topicServices;
  }

  public function index(Request $request){
    if ($request->isJson()) {
      return $this->topicServices->all($request);
    }
    
    return view($this->path . 'index');
  }
  
  public function create(){
    $subjects = Subject::pluck('name','id');

    return view($this->path . 'create', ['subjects' => $subjects]);
  }

  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required|unique:topics',
    ]);

    $topic = new Topic;
    $topic->name = $request->name;
    $topic->subject_id = $request->subject_id;
    $topic->save();

    Session::flash('success','This topic has been successfully saved!');

    return redirect()->route('topics.index');
  }

  public function edit(Topic $topic) {
    $subjects = Subject::pluck('name','id');

    return view($this->path . 'edit', ['topic' => $topic,'subjects' => $subjects]);
  }

  public function update(Topic $topic, Request $request) {
    $this->validate($request, [
      'name' => 'required|max:255|unique:topics,id,' . $topic->id
    ]);
    
    $topic->name = $request->name;
    $topic->subject_id = $request->subject_id;
    $topic->save();
    
    Session::flash('success','This topic has been successfully saved!');
    return redirect()->route('topics.index');
  }

  public function destroy(Topic $topic){
    $topic->delete();

    return success();
  }

  public function import(Request $request, Subject $subject){
    return $this->topicServices->import($request, $subject);  
  }

  public function search(Request $request){
    return $this->topicServices->search($request);  
  }
}
