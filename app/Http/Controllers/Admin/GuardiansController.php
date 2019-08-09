<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Guardian;
use App\GuardianStudent;
use App\Services\Admin\GuardianServices;
use App\User;
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
    return $this->guardianServices->store($request);
  }  
  

	public function edit(Guardian $guardian){
    return view($this->path . 'edit', ['guardian' => $guardian]);
  }
  
	public function update(Guardian $guardian, Request $request){
		return $this->guardianServices->update($request, $guardian);
  }
  
 	public function destroy(Guardian $guardian){
    $guardian->delete();
		return success();
  }
}
