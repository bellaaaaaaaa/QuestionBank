<?php

namespace App\Http\Middleware\Client;

use App\Purchase;
use Closure;
use Illuminate\Support\Facades\Auth;

class PurchasedCourse {
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

    $coursePurchase = Purchase::where('student_id', $student->id)->where('subject_id', $subject->id)->first();

    if($coursePurchase) {
      return $next($request);
    } else {
      return redirect()->route('client.payment');
    }
  }
}
