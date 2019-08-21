<?php

namespace App\Services\Client;

use App\Subject;
use Illuminate\Http\Request;

class StripeServices {
  public function create(Request $request, Subject $subject) {    
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
      if($request->paymentMethodId) {
        $intent = \Stripe\PaymentIntent::create([
          'payment_method' => $request->paymentMethodId,
          // 'amount' => (string) round($month->total) . '00',
          'amount' => (string) 5000 . '00',
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

      return $this->generatePaymentResponse($intent, $subject);
    
    } catch (\Stripe\Error\Base $e) {
      return errorResponse('An error has occured. Please try again.');
    }
  }

  function generatePaymentResponse($intent, $subject) {
    if ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
      return json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
      ]);
    } else if ($intent->status == 'succeeded') {
      // create purcahse record

      return route('root');
    } else {
      return errorResponse('An error has occured. Please try again.');
    }
  }
}
