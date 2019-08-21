<?php

namespace App\Services\Client;

use App\Subject;

use Illuminate\Http\Request;
use App\Services\Client\PaypalServices;
use App\Services\Client\StripeServices;

class PaymentServices { 
  public function handle(Request $request, Subject $subject, $type) {
    switch($type) {
      case 'paypal':
      return $this->handlePaypal($request, $subject);
      break;

      case 'stripe':
      return $this->handleStripe($request, $subject);
      break;

      default:
      return redirect()->route('client.payment.show', $subject)->with('error', 'Something went wrong. Please try again.');
      break;
    }
  }

  public function handlePaypal(Request $request, Subject $subject) {
    $paypalServices = new PaypalServices();
      
    if($request->complete) {
      return $paypalServices->complete($request, $subject);
    } 

    return $paypalServices->create($request, $subject);
  }

  public function handleStripe(Request $request, $subject) {
    if($request->complete) {
      $stripeServices = new StripeServices();
      return $stripeServices->create($request, $subject);
    }

    return redirect()->route('client.payment.show', $subject)->with('error', 'Something went wrong. Please try again.');
  }
}
