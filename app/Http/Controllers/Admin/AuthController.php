<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class AuthController extends Controller{

	public function viewRegister(){
    return view('admin.auth.register');
  	}

 	public function register(Request $request){
	  $this->validate($request, [
	    "email" => "required|email|unique:users",
	    "name" => "required",
	    "password" => "required|confirmed"
	  ]);

	  $user = User::create($request->all());

	  Auth::login($user);

	  return redirect()->route('admin.dashboard');
	}

	public function viewLogin(){
	  return view('admin.auth.login');
	}

	public function login(Request $request){
	  $this->validate($request, [
	    "email" => "required|email",
	    "password" => "required"
	  ]);

	  if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'owner_type' => null])) {
	    return redirect()->route('admin.dashboard');
	  }else{
	    return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);
	  }
	}

	public function logout(){
	  Auth::logout();

	  return redirect()->route('admin.login.show');
	}
}