<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use Session;
use App\Services\StudentServices;

class StudentController extends Controller
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

  public function create(){
		return view($this->path . 'create');
  }


  public function store(Request $request){
		$this->validate($request, [
			"email" => "required|email|unique:users",
			"name" => "required",
		]);

		$student = new Student();
		$student->name = $request->name;
		$student->email = $request->email;
		$student->password = bcrypt('secret');;
		$student->save();

        Session::flash('success','Successfully saved!');
		return redirect()->route('students.index');
  }

  public function destroy(Student $student){
    $student->delete();

		return success();
  }
}
