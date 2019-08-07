<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Student;
use App\Subject;
use Auth;

class AuthController extends Controller{

	public function viewRegister(){
    return view('client.auth.register');
  }

 	public function register(Request $request){
    $this->validate($request, [
	    "email" => "required|email|unique:users",
      "name" => "required",
      "nric" => "required|numeric",
      "age" => "required|numeric",
	    "password" => "required|confirmed",
	    "subject" => "required"
    ]);
    
    $subject = $this->getSubject($request->subject);

    if(!$subject) {
      return redirect()->back()->withInput()->with('error', 'Subject not found.');
    }

	  $user = User::create([
      'email' => $request->email,
      'name' => $request->name,
      'password' => $request->password
    ]);

    $student = Student::create([
      'login_to' => $subject->id,
      'nric' => $request->nric,
      'age' => $request->age 
    ]);
    
    $student->owner()->save($user);

	  Auth::login($user);
		
	  return redirect()->route('home');
	}

	public function viewLogin(){
	  return view('client.auth.login');
	}

	public function login(Request $request){
	  $this->validate($request, [
	    "email" => "required|email",
	    "password" => "required",
	    "subject" => "required"
    ]);
    
    $subject = $this->getSubject($request->subject);

    if(!$subject) {
      return redirect()->back()->withInput()->with('error', 'Subject not found.');
    }
    
	  if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'owner_type' => 'Student'])) {
      $student = current_user()->owner;
      $student->login_to = $subject->id;
      $student->save();

      // Auth::logoutOtherDevices($request->password);
	    return redirect()->route('home');
	  }else{
	    return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);
	  }
	}

	public function logout(){
	  Auth::logout();

	  return redirect()->route('client.login.show');
  }
  
  public function getSubject($subject) {
    return Subject::find($subject);
  }
}
