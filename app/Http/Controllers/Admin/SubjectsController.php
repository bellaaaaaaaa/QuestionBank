<?php

namespace App\Http\Controllers\Admin;

use App\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\SubjectServices;

class SubjectsController extends Controller{
    protected $path = 'admin.subjects.';
    protected $subjectServices;

    public function __construct(SubjectServices $subjectServices){
      $this->subjectServices = $subjectServices;
    }

  public function index(Request $request){
    if ($request->isJson()) {
      return $this->subjectServices->all($request);
    }
    
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }

  public function store(Request $request){
    return $this->subjectServices->create($request);
  }

	public function edit(Subject $subject){
    return view($this->path . 'edit',['subject'=>$subject]);
  }

  public function update(Subject $subject, Request $request){
    return $this->subjectServices->update($request, $subject);
  }

  public function destroy(Subject $subject){
    $subject->delete();
		return success();
  }
}
