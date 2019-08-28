<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageOptimizationServices;

class AccountSettingsController extends Controller
{
    protected $imageOptimizationServices;
    function __construct(ImageOptimizationServices $imageOptimizationServices){
		$this->imageOptimizationServices = $imageOptimizationServices;
    }
    
    public function updateAccount(Request $request){
        $student = current_user();
        if ($request->email != $student->email){
            $this->validate($request, array(
                'email' => 'required|email|unique:users'
            ));
        } else {
            $this->validate($request, array(
              'name' => 'required|string',
              'nric' => 'required|string'
            ));
        }
        $student->update($request->all());
    
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()){
          if ( $student->avatar ) {
            if (avatar_picture_exists($student->piavatarcture)) {
              Storage::delete( avatar_storage_path() . $student->avatar );
            }
          }
          $file_unique_name = $this->imageOptimizationServices->optimize('avatars', $request->avatar, 'thumbnail');
          $student->update(['avatar' => $file_unique_name]);
        }
    
    
        return redirect()->back()->with("success", "Account Has Been Updated Successfully!");
    }
}
