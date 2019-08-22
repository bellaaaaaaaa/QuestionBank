<?php

namespace App\Http\Controllers\Client;

use App\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\PaymentServices;

class PaymentsController extends Controller {
  protected $path = 'client.payments.';
  protected $paymentServices;

  public function __construct(PaymentServices $paymentServices) {
    $this->paymentServices = $paymentServices;
  }

  public function viewPayment(Request $request, Subject $subject) {
    return view($this->path . 'payment', ['subject' => json_encode($subject)]);
  }

  public function handlePayment(Request $request, Subject $subject, $type) {
    return $this->paymentServices->handle($request, $subject, $type);
  }
}
