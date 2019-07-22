<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Guardian;
use Session;

class GuardianController extends Controller
{
    protected $path = 'admin.guardians.';

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
		$this->validate($request, [
			"email" => "required|email|unique:users",
			"name" => "required",
		]);

		$guardian = new Guardian();
		$guardian->name = $request->name;
		$guardian->email = $request->email;
		$guardian->password = bcrypt('secret');;
		$guardian->save();

        Session::flash('success','Successfully saved!');
		return redirect()->route('guardians.index');
  }

  public function destroy(Guardian $guardian){
    $guardian->delete();

		return success();
  }
}
