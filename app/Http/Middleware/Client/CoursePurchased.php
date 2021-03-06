<?php

namespace App\Http\Middleware\Client;

use App\Purchase;
use Carbon\Carbon;

use Closure;
use Illuminate\Support\Facades\Auth;

class CoursePurchased {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next){
    $student = current_user()->owner;
    $subject = get_student_subject();

    $coursePurchase = Purchase::where('student_id', $student->id)->where('subject_id', $subject->id)->whereDate('expiration_date', '>=', Carbon::now())->first();
    
    if($coursePurchase) {
      return redirect()->route('root');
    } else {
      return $next($request);
    }
  }
}
