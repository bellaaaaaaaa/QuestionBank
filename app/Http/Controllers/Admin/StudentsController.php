<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\StudentServices;
use App\Student;
use App\User;
use Session;

class StudentsController extends Controller
{
  protected $path = 'admin.students.';
	protected $studentServices;

	public function __construct(StudentServices $studentServices){
		$this->studentServices = $studentServices;
	}
  public function index(Request $request){
		if ($request->isJson()) {
      return $this->studentServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(User $user){
    return view($this->path . 'create', ['user'=> $user]);
  }

  public function store(Request $request, Student $student){
		$this->validate($request, [
      "name" => "required",
			"email" => "required|email|unique:users",
      "nric" => "required|unique:students",
      "age" => "required"
    ]);
    
    $student = Student::create([
      'nric' => $request->nric,
      'age' => $request->age
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email
    ]);
      
    $student->owner()->save($user);
   
    Session::flash('success','Successfully saved!');
		return redirect()->route('students.index');
  }

  public function edit(Student $student, User $user){
		return view($this->path . 'edit', ['student'=> $student, 'user'=>$user]);
  }
  
  public function update(Student $student, Request $request){
    $user = $student->owner;
    $user->name = $request->name;
    $user->email = $request->email;
    $student->nric = $request->nric;
    $student->age = $request->age;
    $student->save();
    $user->save();

	Session::flash('success','Successfully saved!');
  return redirect()->route('students.index');  
  }
 
  public function destroy(Student $student){
    $student->delete();

		return success();
  }
}
