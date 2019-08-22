<?php

namespace App\Http\Controllers\Client;

use App\Rate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatesController extends Controller {
  public function getRates(Request $request, $currency) {
    $rate = Rate::where('currency', $request->currency)->get();
    return $rate;
  }
}
