<?php

namespace App\Services\Client;

use App\Subject;
use App\Rate;

use Carbon\Carbon;

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
use PayPal\Api\Item;
use PayPal\Api\ItemList;

use Illuminate\Http\Request;

class PaypalServices {
  protected $apiContext;

  public function __construct() {
    $paypal_conf = \Config::get('paypal');
    
    $this->apiContext = new ApiContext(new OAuthTokenCredential(
      $paypal_conf['client_id'],
      $paypal_conf['secret'])
    );

    $this->apiContext->setConfig($paypal_conf['settings']);
  }
 
  public function create(Request $request, Subject $subject) {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $price = $this->getPrice($request, $subject);
    
    $item1 = new Item();
    $item1->setName($subject->name . ' course purchase')
        ->setCurrency($request->currency)
        ->setQuantity(1) 
        ->setPrice($price);

    $itemList = new ItemList();
    $itemList->setItems([$item1]);
    
    $amount = new Amount();
    $amount->setCurrency($request->currency)->setTotal($price);

    $transaction = new Transaction();
    $transaction->setAmount($amount)->setItemList($itemList)->setDescription($subject->name . ' course (' . $request->month . 'month)');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(route('client.payment.handle', ['subject' => $subject, 'type' => 'paypal', 'month' => $request->month, 'currency' => $request->currency, 'complete' => 'complete']))->setCancelUrl(route('client.payment.show', $subject));
    
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

  public function complete(Request $request, Subject $subject) {
    $paymentId = $request->paymentId;
    $payment = Payment::get($paymentId, $this->apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($request->PayerID);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $price = $this->getPrice($request, $subject);

    $details->setSubtotal($price);
    $amount->setCurrency($request->currency);
    $amount->setTotal($price);
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);
    $result = $payment->execute($execution, $this->apiContext);

    if($result->getState() != 'approved') {
      return redirect()->route('client.payment.show', $subject)->with('error', 'Payment unsuccessful. Please try again.');
    }

    return redirect()->route('root')->with('success', 'Course succesfully purchased!');
  }

  public function getPrice($request, $subject) {
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
