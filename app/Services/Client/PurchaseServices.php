<?php

namespace App\Services\Client;

use App\Subject;
use App\Rate;
use App\Purchase;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PurchaseServices {
  public function handle(Request $request, $subject) {
    $student = current_user()->owner;
    $purchase = Purchase::where('student_id', $student->id)->where('subject_id', $subject->id)->first();
    $expirationDate = Carbon::now()->addMonths($request->month);
    if($purchase) {
      $purchase->expiration_date = $expirationDate;
      $purchase->save();
    }else {
      Purchase::create([
        'student_id' => $student->id, 
        'subject_id' => $subject->id,
        'package_duration' => $request->month, 
        'expiration_date' => $expirationDate
      ]);
    }
  }
  
  public function getPrice(Request $request, $subject) {
    switch($request->month) {
      case 1:
      $price = $subject->one_month_price;
      break;

      case 2:
      $price = $subject->two_month_price;
      break;

      case 3:
      $price = $subject->three_month_price;
      break;

      default:
      $price = $subject->one_month_price;
      break;
    }
    
    if($request->currency != 'MYR') {
      $rate = Rate::where('currency', $request->currency)->where('month', $request->month)->first();
      
      return round($price / $rate->amount, 2);
    }

    return $price;
  }
}
