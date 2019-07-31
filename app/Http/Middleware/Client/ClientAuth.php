<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientAuth{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null){
		if (Auth::guard($guard)->check()) {
            if(current_user()->role == 0) {
                return $next($request);
            } else {
                return redirect()->route('admin.dashboard');
            }
		}
		return redirect()->route('client.login.show');
  }
}
