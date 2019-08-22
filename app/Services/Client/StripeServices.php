<?php

namespace App\Services\Client;

use App\Subject;

use App\Rate;
use App\Purchase;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Services\Client\PurchaseServices;

class StripeServices {
  protected $purchaseServices;

  public function __construct() {
    $this->purchaseServices = new PurchaseServices();
  }

  public function create(Request $request, Subject $subject) {    
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
      if($request->paymentMethodId) {
        $price = $this->purchaseServices->getPrice($request, $subject);

        $intent = \Stripe\PaymentIntent::create([
          'payment_method' => $request->paymentMethodId,
          'amount' => (string) round($price) . '00',
          'currency' => $request->currency,
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

      return $this->generatePaymentResponse($request, $intent, $subject);
    
    } catch (\Stripe\Error\Base $e) {
      return errorResponse('An error has occured. Please try again.');
    }
  }

  function generatePaymentResponse($request, $intent, $subject) {
    if ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
      return json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
      ]);
    } else if ($intent->status == 'succeeded') {
      $this->purchaseServices->handle($request, $subject);
      return route('root');
    } else {
      return errorResponse('An error has occured. Please try again.');
    }
  }
}
