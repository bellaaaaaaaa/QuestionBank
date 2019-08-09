<?php

namespace App\Services\Admin;

use App\Guardian;
use App\GuardianStudent;
use App\User;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class GuardianServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
      $order = $request->order ? $request->order : 'desc';
      $limit = $request->limit ? $request->limit : 10;
      $offset = $request->offset ? $request->offset : 0;
      $query = $request->search ? $request->search : '';

      $guardians = Guardian::whereHas('owner',function($guardian) use ($query){
        $guardian->where('name','like',"%{$query}%");
      })->orderBy($sort, $order);
      
      $listCount = $guardians->count();

      $guardians = $guardians->limit($limit)->offset($offset)->get();

      // return respond(['rows' => $questions, 'total' => $listCount]);
      return respond(['rows' => $this->transformCollection($guardians), 'total' => $listCount]);
	}

  public function store(Request $request){
    $request->validate([
      "name" => "required",
      "email" => "required|email|unique:users",
      "password" => "required"
    ]);

    $guardian = new Guardian();
    $guardian->save();

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password
    ]);

    // $guardianStudent = GuardianStudent::create([
    //   'guardian_id' => $guardian->id,
    //   'student_id' => $student->id,
    //   'relationship' => $request->relationship
    // ]);

    $guardian->owner()->save($user);
  
    return redirect()->route('guardians.index');
  }

  public function update(Request $request, Guardian $guardian){
    $request->validate([
      'name' => "required",
      'email' => "required|email|unique:users",
      'password' => "required"
    ]);

    $user = $guardian->owner;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

    return redirect()->route('guardians.index', ['']);
  }

	public function transform($guardian){
		return [
      'id' => $guardian->id,
      'name' => $guardian->owner->name,
      'email' => $guardian->owner->email,
      
    ];  
	}
}
