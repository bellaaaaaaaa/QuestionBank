<?php

namespace App\Services\Client;

use App\Subject;

use App\Services\Client\PaypalServices;
use App\Services\Client\StripeServices;

use Illuminate\Http\Request;

class PaymentServices { 
  public function handle(Request $request, Subject $subject, $month, $type, $path, $complete) {
    switch($type) {
      case 'paypal':
      return $this->handlePaypal($request, $subject, $month, $complete);
      break;

      case 'stripe':
      // return $this->handleStripe($request, $subject, $complete);
      break;

      default:
      // return route('show.payment', $token);
      break;
    }
  }

  public function handlePaypal(Request $request, Subject $subject, $month, $complete) {
    $paypalServices = new PaypalServices();
      
    if($complete) {
      return $paypalServices->complete($request, $subject, $month);
    } 

    return $paypalServices->create($request, $subject, $month);
  }

  public function handleStripe(Request $request, $subject, $path, $complete) {
    if($complete == 'create') {
      $stripeServices = new StripeServices();
      return $stripeServices->create($request);
    }

    if($complete == 'complete') {
      return view('dashboard.payments.complete', ['success' => 'Payment successful! Generating excel form now.']);
    } 

    return view($path . 'stripe');
  }
}
