<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null){
		if (Auth::guard($guard)->check()) {
      if(current_user()->isAdmin()) {
        return $next($request);
      } else {
        return redirect()->route('home');
      }
    }
    
		return redirect()->route('admin.login.show');
  }
}
