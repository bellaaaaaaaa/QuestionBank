<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\User;

class RegisterAccess{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next){
    $admin = User::where('role', 1)->first();

    
    if($admin) { // has a value or true
      if(current_user()) {
        return redirect()->route('admin.dashboard');
      }else {
        return redirect()->route('admin.login.show');
      }
    }

		return $next($request);
  }
}
