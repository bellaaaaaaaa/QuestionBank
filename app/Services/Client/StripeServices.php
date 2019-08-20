<?php

namespace App\Services\Client;

use App\Month;
use App\Payslip;

use Illuminate\Http\Request;

class StripeServices {
  public function create(Request $request, $token) {
    $month = Month::where('token', $token)->where('approved', 0)->first();

    if(!$month) {
      return abort(401);
    }
    
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
      if($request->paymentMethodId) {
        $intent = \Stripe\PaymentIntent::create([
          'payment_method' => $request->paymentMethodId,
          'amount' => (string) round($month->total) . '00',
          'currency' => 'myr',
          'confirmation_method' => 'manual',
          'confirm' => true
        ]);
      }

      if($request->paymentIntentId) {
        $intent = \Stripe\PaymentIntent::retrieve(
          $request->paymentIntentId
        );

        $intent->confirm(); 
      }

      return $this->generatePaymentResponse($intent, $month, $token);
    
    } catch (\Stripe\Error\Base $e) {
      return errorResponse('An error has occured. Please try again.');
    }
  }

  function generatePaymentResponse($intent, $month, $token) {
    if ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
      return json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
      ]);
    } else if ($intent->status == 'succeeded') {
      $payslips = Payslip::where('month_id', $month->id)->get();

      foreach($payslips as $payslip) {
        $payslip->approved = true;
        $payslip->save();
      }

      return route('handle.payment', ['type' => 'stripe', 'token' => $token, 'complete' => 'complete']);
    } else {
      return errorResponse('An error has occured. Please try again.');
    }
  }
}
