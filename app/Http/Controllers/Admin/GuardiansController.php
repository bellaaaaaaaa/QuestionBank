<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Guardian;
use App\Services\Admin\GuardianServices;
use Session;

class GuardiansController extends Controller
{
	protected $path = 'admin.guardians.';
	protected $guardianServices;

	public function __construct(GuardianServices $guardianServices){
		$this->guardianServices = $guardianServices;
	  }

  public function index(Request $request){
		if ($request->isJson()) {
			return $this->guardianServices->all($request);
		}
		return view($this->path . 'index');
  }

  public function create(){
		return view($this->path . 'create');
  }


  public function store(Request $request){
		$this->validate($request, [
			"email" => "required|email|unique:guardians",
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
	public function edit(Guardian $guardian){
		return view($this->path . 'edit',['guardian'=>$guardian]);
	}
	public function update(Guardian $guardian, Request $request){
		$guardian->name = $request->name;
		$guardian->email = $request->email;
		$guardian->save();
	
	Session::flash('success','Successfully saved!');
		return redirect()->route('guardians.index');

	}
 	public function destroy(Guardian $guardian){
    $guardian->delete();

		return success();
  }
}
