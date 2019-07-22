<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use Session;

class SubjectsController extends Controller{
    protected $path = 'admin.subjects.';
	//protected $teamServices;

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
      //this validates the data
      $this->validate($request,array(
        'name'=>'required|max:255')
       
      );
      //then store in the database
      $subject = new Subject();
      $subject->name = $request->name;
      $subject->save();

      Session::flash('success','This subject has been successfully saved!');
      //then redirect the user to another page
      return redirect()->route('subjects.index');
	
	
  }
  public function destroy(Subject $subject){
    $subject->delete();

		return success();
  }
}