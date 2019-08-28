<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Mail\GuardianPurchaseRequest;

class MailController extends Controller
{
    public function index(Request $request){
        // $url = $this->hex_encode($request->url);
        Mail::to($request->email)->send(new GuardianPurchaseRequest($request->url));
    }

    function hex_encode($input) {
        return bin2hex($input);
    }
}
