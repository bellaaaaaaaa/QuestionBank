<?php

namespace App\Services\Client;

use App\Subject;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Illuminate\Http\Request;

class PaypalServices {
  protected $apiContext;
  protected $successRedirect;
  protected $failRedirect;

  public function __construct() {
    $paypal_conf = \Config::get('paypal');
    
    $this->apiContext = new ApiContext(new OAuthTokenCredential(
      $paypal_conf['client_id'],
      $paypal_conf['secret'])
    );

    $this->apiContext->setConfig($paypal_conf['settings']);
  }
 
  public function create(Request $request, Subject $subject, $month) {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    
    $amount = new Amount();
    $amount->setCurrency('MYR')->setTotal(5000);

    $transaction = new Transaction();
    $transaction->setAmount($amount)->setDescription('monthly invoice');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(route('client.payment.handle', ['subject' => $subject, 'month' => $month, 'type' => 'paypal', 'complete' => 'complete']))->setCancelUrl(route('client.payment.show', $subject));
    
    $payment = new Payment();
    $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
    
    try {
      $payment->create($this->apiContext);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
      return redirect()->route('client.payment.show', $subject)->with('error', 'Something went wrong. Please try again.');
    }

    foreach($payment->getLinks() as $link) {
      if ($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
        break;
      }
    }
    
    if(isset($redirect_url)) {
      return redirect()->away($redirect_url);
    }

    return redirect()->route('client.payment.show', $subject)->with('error', 'Something went wrong. Please try again.');
  }

  public function complete(Request $request, Subject $subject, $month) {
    $paymentId = $request->paymentId;
    $payment = Payment::get($paymentId, $this->apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($request->PayerID);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $details->setSubtotal(5000);
    $amount->setCurrency('MYR');
    $amount->setTotal(5000);
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);
    $result = $payment->execute($execution, $this->apiContext);

    if($result->getState() != 'approved') {
      return redirect()->route('client.payment.show', $subject)->with('error', 'Payment unsuccessful. Please try again.');
    }

    return redirect()->route('root')->with('success', 'Course succesfully purchased!');
  }
}
